if (window.location.href.includes("dashboard.html")) {
    const btnStart = document.getElementsByClassName('btn')[0]; // Select the first element with class 'btn'

    // Ensure the element exists
    btnStart.addEventListener('click', () => {
        window.location.href = "blackJack.html";
    });


}

else if (window.location.href.includes("blackJack.html")) {
    shuffleDeck(); 
    let deck = [{ src: 'assets/card_1.png', value: 2 },
    { src: 'assets/card_2.png', value: 3 },
    { src: 'assets/card_3.png', value: 4 },
    { src: 'assets/card_4.png', value: 5 },
    { src: 'assets/card_5.png', value: 6 },
    { src: 'assets/card_6.png', value: 7 },
    { src: 'assets/card_7.png', value: 8 },
    { src: 'assets/card_8.png', value: 9 },
    { src: 'assets/card_9.png', value: 10 },
    { src: 'assets/card_10.png', value: 10 },
    { src: 'assets/card_11.png', value: 10 },
    { src: 'assets/card_12.png', value: 10 },
    { src: 'assets/card_13.png', value: 11 },
    { src: 'assets/card_14.png', value: 2 },
    { src: 'assets/card_15.png', value: 3 },
    { src: 'assets/card_16.png', value: 4 },
    { src: 'assets/card_17.png', value: 5 },
    { src: 'assets/card_18.png', value: 6 },
    { src: 'assets/card_19.png', value: 7 },
    { src: 'assets/card_20.png', value: 8 },
    { src: 'assets/card_21.png', value: 9 },
    { src: 'assets/card_22.png', value: 10 },
    { src: 'assets/card_23.png', value: 10 },
    { src: 'assets/card_24.png', value: 10 },
    { src: 'assets/card_25.png', value: 10 },
    { src: 'assets/card_26.png', value: 11 },
    { src: 'assets/card_27.png', value: 2 },
    { src: 'assets/card_28.png', value: 3 },
    { src: 'assets/card_29.png', value: 4 },
    { src: 'assets/card_30.png', value: 5 },
    { src: 'assets/card_31.png', value: 6 },
    { src: 'assets/card_32.png', value: 7 },
    { src: 'assets/card_33.png', value: 8 },
    { src: 'assets/card_34.png', value: 9 },
    { src: 'assets/card_35.png', value: 10 },
    { src: 'assets/card_36.png', value: 10 },
    { src: 'assets/card_37.png', value: 10 },
    { src: 'assets/card_38.png', value: 10 },
    { src: 'assets/card_39.png', value: 11 },
    { src: 'assets/card_40.png', value: 2 },
    { src: 'assets/card_41.png', value: 3 },
    { src: 'assets/card_42.png', value: 4 },
    { src: 'assets/card_43.png', value: 5 },
    { src: 'assets/card_44.png', value: 6 },
    { src: 'assets/card_45.png', value: 7 },
    { src: 'assets/card_46.png', value: 8 },
    { src: 'assets/card_47.png', value: 9 },
    { src: 'assets/card_48.png', value: 10 },
    { src: 'assets/card_49.png', value: 10 },
    { src: 'assets/card_50.png', value: 10 },
    { src: 'assets/card_51.png', value: 10 },
    { src: 'assets/card_52.png', value: 11 }]; // Menggunakan cardDeck yang Anda miliki

    let playerMoney = 5000;
    let currentBet = 0;
    let playerCards = [];
    let dealerCards = [];

    const betSection = document.querySelector('.bet-section');
    const playerMoneySpan = document.getElementById('player-money');
    const betAmountInput = document.getElementById('bet-amount');
    const placeBetButton = document.getElementById('place-bet');
    const gameArea = document.getElementById('game-area');
    const dealerCardsDiv = document.getElementById('dealer-cards');
    const playerCardsDiv = document.getElementById('player-cards');
    const dealerScoreDiv = document.getElementById('dealer-score');
    const playerScoreDiv = document.getElementById('player-score');
    const hitButton = document.getElementById('hit');
    const stayButton = document.getElementById('stay');
    const resultDiv = document.getElementById('result');
    const gameOverDiv = document.getElementById('game-over');
    const restartButton = document.getElementById('restart');
    const lanjutkanButton = document.getElementById('lanjutkan');
    const backgroundMusic = document.getElementById('background-music');

    // Shuffle deck (acak deck) dengan animasi yang lebih smooth
    function shuffleDeck() {
        const deckElement = document.createElement('div');
        deckElement.classList.add('deck-shuffle');
        document.body.appendChild(deckElement);

        // Simulate shuffle animation for 3 seconds (lebih lama untuk efek halus)
        setTimeout(() => {
            document.body.removeChild(deckElement); // Hapus animasi setelah shuffle selesai
            for (let i = deck.length - 1; i > 0; i--) {
                let j = Math.floor(Math.random() * (i + 1));
                [deck[i], deck[j]] = [deck[j], deck[i]];
            }
        }, 3000); // 3 detik untuk simulasi shuffle
    }
    function drawCard() {
        return deck.pop();
    }
    // Mengambil kartu dari deck
    // function drawCard(cards, div, hideFirst = false) {
    //     return deck.pop();
    // }

    // Menampilkan kartu menggunakan gambar dengan animasi yang lebih smooth
    function displayCards(cards, div, hideFirst = false) {
        div.innerHTML = '';
        cards.forEach((card, index) => {
            const cardImg = document.createElement('img');
            cardImg.classList.add('card', 'card-deal'); // Tambahkan kelas animasi dealCard
            if (hideFirst && index === 0) {
                cardImg.src = 'assets/cover.png'; // Gambar kartu tertutup (back)
            } else {
                cardImg.src = card.src; // Gambar kartu asli
            }
            div.appendChild(cardImg);
        });
    }


    // Menghitung skor
    function calculateScore(cards) {
        let score = 0;
        let aceCount = 0;
        cards.forEach(card => {
            if (card.value === 11) aceCount += 1; // Hitung As terpisah
            score += card.value;
        });

        // Jika skor lebih dari 21 dan ada As, kurangi nilai As menjadi 1
        while (score > 21 && aceCount > 0) {
            score -= 10;
            aceCount -= 1;
        }

        return score;
    }


    // Memulai permainan setelah taruhan
    // Fungsi untuk memulai permainan setelah taruhan
    backgroundMusic.play(); // Memulai musik saat permainan dimulai
    function startGame() {
        shuffleDeck();

        // Bagikan 2 kartu ke pemain dan dealer
        playerCards.push(drawCard());
        playerCards.push(drawCard());

        dealerCards.push(drawCard());
        dealerCards.push(drawCard());

        displayCards(dealerCards, dealerCardsDiv, true); // Satu kartu dealer tertutup
        displayCards(playerCards, playerCardsDiv);

        playerScoreDiv.textContent = `Skor: ${calculateScore(playerCards)}`;
        dealerScoreDiv.textContent = `Skor Dealer: ?`;

        // Tampilkan tombol "Hit" dan "Stay"
        hitButton.style.display = 'block';
        stayButton.style.display = 'block';
        lanjutkanButton.style.display = 'none';
    }

    // Event listener untuk tombol taruhan
    placeBetButton.addEventListener('click', () => {
        const bet = parseInt(betAmountInput.value);
        if (isNaN(bet) || bet < 100) {
            alert('Taruhan minimal adalah $100');
            return;
        }
        if (bet > playerMoney) {
            alert('Taruhan melebihi uang yang Anda miliki');
            return;
        }
        currentBet = bet;
        playerMoney -= bet;
        playerMoneySpan.textContent = playerMoney;
        betAmountInput.value = '';
        resetGame(); // Atur ulang game sebelum memulai putaran baru
        betSection.style.display = 'none'; // Sembunyikan area taruhan
        gameArea.style.display = 'block'; // Tampilkan area permainan
        startGame();
    });


    // Event listener untuk tombol "Hit"
    hitButton.addEventListener('click', () => {
        playerCards.push(drawCard());
        displayCards(playerCards, playerCardsDiv);
        playerScoreDiv.textContent = `Skor: ${calculateScore(playerCards)}`;

        if (calculateScore(playerCards) > 21) {
            endRound('Anda bust! Anda kalah.');
        }
    });

    // Menangani aksi "Stay"
    // Event listener untuk tombol "Stay"
    stayButton.addEventListener('click', () => {
        displayCards(dealerCards, dealerCardsDiv);
        dealerScoreDiv.textContent = `Skor Dealer: ${calculateScore(dealerCards)}`;

        while (calculateScore(dealerCards) < 17) {
            dealerCards.push(drawCard());
            displayCards(dealerCards, dealerCardsDiv);
            dealerScoreDiv.textContent = `Skor Dealer: ${calculateScore(dealerCards)}`;
        }

        const dealerScore = calculateScore(dealerCards);
        const playerScore = calculateScore(playerCards);

        if (dealerScore > 21) {
            endRound('Dealer bust! Anda menang.');
            playerMoney += betAmount *2;
        } else if (playerScore > dealerScore) {
            endRound('Anda menang!');
            playerMoney += betAmount *2;
        } else if (dealerScore > playerScore) {
            endRound('Dealer menang!');
            playerMoney -= betAmount;
        } else {
            endRound('Push! Seri.');
        }
        updateMoney();
    });   
    // Mengakhiri putaran
    function endRound(result) {
        const backgroundMusic = document.getElementById('background-music');
        backgroundMusic.pause(); // Hentikan musik
        // Tampilkan hasil
        resultDiv.textContent = result;

        // Penyesuaian uang pemain
        if (result === 'Anda menang!' || result === 'Dealer bust! Anda menang.') {
            playerMoney += currentBet * 2; // Pemain mendapatkan 2x lipat taruhan
        } else if (result === 'Push! Seri.') {
            playerMoney += currentBet; // Taruhan dikembalikan
        }
        // Jika kalah, uang sudah dikurangi saat memasang taruhan

        // Update tampilan uang pemain
        playerMoneySpan.textContent = playerMoney;

        // Cek apakah game over
        if (playerMoney < 100) {
            gameArea.style.display = 'none';
            gameOverDiv.style.display = 'block'; // Tampilkan layar Game Over
        } else {
            hitButton.style.display = 'none';
            stayButton.style.display = 'none';
            lanjutkanButton.style.display = 'block';
            lanjutkanButton.addEventListener('click', () => {
                gameArea.style.display = 'none'; // Sembunyikan area permainan
                betSection.style.display = 'block'; // Tampilkan area taruhan
            })
            // Kembali ke tahap taruhan
        }
    }

    // Reset game state
    function resetGame() {
        playerCards = [];
        dealerCards = [];

        displayCards([], playerCardsDiv);
        displayCards([], dealerCardsDiv);
        playerScoreDiv.textContent = '';
        dealerScoreDiv.textContent = '';
        resultDiv.textContent = '';
    }

    // Menangani restart game
    // Event listener untuk tombol restart saat game over
    restartButton.addEventListener('click', () => {
        alert('Rafly Influence $5000')
        playerMoney = 5000;
        playerMoneySpan.textContent = playerMoney;
        gameOverDiv.style.display = 'none';
        betSection.style.display = 'block'; // Tampilkan area taruhan
    });

}