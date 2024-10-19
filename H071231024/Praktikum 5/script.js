const deck = [];
const playerCards = [];
const dealerCards = [];
let playerScore = 0;
let dealerScore = 0;
let balance = 5000; // Pemain mulai dengan $5000
let currentBet = 0;

// Membuat deck tanpa kartu yang identik
const suits = ['hearts', 'diamonds', 'clubs', 'spades'];
const values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

function createDeck() {
    deck.length = 0;
    for (const suit of suits) {
        for (const value of values) {
            deck.push({ suit, value, img: `images/${value}_of_${suit}.png` });
        }
    }
    shuffle(deck);
}

function shuffle(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
}

function calculateScore(cards) {
    let score = 0;
    let aceCount = 0;
    for (const card of cards) {
        if (card.value === 'A') {
            score += 11;
            aceCount++;
        } else if (['K', 'Q', 'J'].includes(card.value)) {
            score += 10;
        } else {
            score += parseInt(card.value);
        }
    }
    while (score > 21 && aceCount > 0) {
        score -= 10;
        aceCount--;
    }
    return score;
}

function startGame() {
    createDeck();
    playerCards.length = 0;
    dealerCards.length = 0;
    playerScore = 0;
    dealerScore = 0;

    // Mengambil 2 kartu untuk pemain dan dealer
    for (let i = 0; i < 2; i++) {
        playerCards.push(deck.pop());
        dealerCards.push(deck.pop());
    }

    updateUI();
}

function updateUI() {
    document.getElementById('player-cards').innerHTML = playerCards.map(card => 
        `<div class="card"><img src="${card.img}" alt="${card.value}" style="width: 130px; height: 180px; object-fit: contain; margin: 0 10px;"></div>`
    ).join('');

    document.getElementById('dealer-cards').innerHTML = 
        `<div class="card"><img src="images/card_back.png" alt="Card Back" style="width: 130px; height: 180px; object-fit: contain; margin: 0 10px;"></div>` +
        dealerCards.slice(1).map(card => 
            `<div class="card"><img src="${card.img}" alt="${card.value}" style="width: 130px; height: 180px; object-fit: contain; margin: 0 10px;"></div>`
        ).join('');


    playerScore = calculateScore(playerCards);
    dealerScore = calculateScore(dealerCards.slice(1));

    if (playerScore === 21) {
        document.getElementById('result').innerText = 'Blackjack! You win!';
        processWin();
        disableGameButtons();
    } else if (playerScore > 21) {
        document.getElementById('result').innerText = 'You bust! Dealer wins!';
        processLoss();
        disableGameButtons();
    }
}

function hit() {
    if (playerScore < 21) {
        const newCard = deck.pop();
        playerCards.push(newCard);
        updateUI();

        if (playerScore > 21) {
            document.getElementById('result').innerText = 'You bust! Dealer wins!';
            processLoss();
            disableGameButtons();
        }
    }
}

function stand() {
    while (dealerScore < 17) {
        dealerCards.push(deck.pop());
        dealerScore = calculateScore(dealerCards);
    }

    updateUI();
    checkResult();
}

function checkResult() {
    const dealerFinalScore = calculateScore(dealerCards);

    document.getElementById('dealer-cards').innerHTML = dealerCards.map(card => 
        `<div class="card"><img src="${card.img}" alt="${card.value}" style="width: 130px; height: 180px; object-fit: contain; margin: 0 10px"></div>`
    ).join('');

    if (dealerFinalScore > 21 || playerScore > dealerFinalScore) {
        document.getElementById('result').innerText = 'You win!';
        processWin();
    } else if (dealerFinalScore > playerScore) {
        document.getElementById('result').innerText = 'Dealer wins!';
        processLoss();
    } else {
        document.getElementById('result').innerText = "It's a tie!";
    }

    // Menampilkan total skor pemain dan dealer
    document.getElementById('total-cards-played').innerText = `Dealer's Total Score : ${dealerFinalScore}\n Your Total Score : ${playerScore}`;

    disableGameButtons();
}


function processWin() {
    balance += currentBet * 2;
    updateBalance();
}

function processLoss() {
    updateBalance();
    if (balance <= 0) {
        gameOver();
    }
}

function disableGameButtons() {
    document.getElementById('hit').style.display = 'none';
    document.getElementById('stand').style.display = 'none';
    document.getElementById('restart').style.display = 'inline-block';
}

function updateBalance() {
    document.getElementById('balance').innerText = balance;
}

function placeBet() {
    const betInput = document.getElementById('bet').value;
    currentBet = parseInt(betInput);

    if (currentBet < 100 || currentBet > balance) {
        alert('Taruhan minimal $100 dan tidak boleh melebihi saldo!');
        return;
    }

    balance -= currentBet;
    updateBalance();
    document.getElementById('placeBet').style.display = 'none';
    document.getElementById('bet').style.display = 'none';
    document.getElementById('hit').style.display = 'inline-block';
    document.getElementById('stand').style.display = 'inline-block';

    startGame();
}

function gameOver() {
    document.getElementById('game-over').style.display = 'block';
    document.getElementById('hit').style.display = 'none';
    document.getElementById('stand').style.display = 'none';
    document.getElementById('placeBet').style.display = 'none';
}

document.getElementById('placeBet').addEventListener('click', placeBet);
document.getElementById('hit').addEventListener('click', hit);
document.getElementById('stand').addEventListener('click', stand);
document.getElementById('restart').addEventListener('click', () => {
    balance = 5000;
    updateBalance();
    document.getElementById('game-over').style.display = 'none';
    document.getElementById('placeBet').style.display = 'inline-block';
    document.getElementById('bet').style.display = 'inline-block';
    document.getElementById('result').innerText = '';
    // document.getElementById('restart').style.display = 'inline-block'; 
});
