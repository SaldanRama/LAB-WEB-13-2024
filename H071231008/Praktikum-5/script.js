const modal = document.getElementById("bet-modal");
let betAmount = 0;
const submitBetButton = document.getElementById("submit-bet");
const allBetButton = document.getElementById("all-bet");
const betAmountInput = document.getElementById("bet-amount");
var hitCard = document.getElementById("hit-card").getElementsByTagName("img")[0];
//button
var startbutton = document.getElementById("start-button");
var closebutton = document.getElementsByClassName("close")[0];
var standButton = document.getElementById("stand-button");
var hitButton = document.getElementById("hit-button");
//amount
var moneyAmount = document.getElementById("money-amount")
var dealerCardAmount = document.getElementById("dealer-card-count");
var playerCardAmount = document.getElementById("player-card-count");


submitBetButton.onclick = function () { 
    betAmount = (betAmountInput.value);


    if (betAmount <= 99) {
        alert("You Need At Least  100$ To Start Playing");
        return;
    }
    if (betAmount > parseFloat(moneyAmount.textContent)) {
        alert("You don't have enough money for this bet");
        return;
    }
    moneyAmount.textContent = parseFloat(moneyAmount.textContent) - betAmount;
    document.getElementById("info-bet").textContent = betAmount;
    document.getElementById("info-prize").textContent = betAmount * 2;

    modal.style.display = "none";
    startGames(betAmount);
}
allBetButton.onclick = function () {
    betAmount = parseFloat(moneyAmount.textContent);

    if (parseFloat(moneyAmount.textContent) <= 99) {
        alert("Dont Have Enough Money To bet");
        return;
    }
    moneyAmount.textContent = parseFloat(moneyAmount.textContent) - betAmount;
    document.getElementById("info-bet").textContent = betAmount;
    document.getElementById("info-prize").textContent = betAmount * 2;

    modal.style.display = "none";
    startGames(betAmount);
}
let gameState = {
    turn: true,
    round: 0,
    gameOver: false,
    playerStand: false,
    currentBet: 0
}
function resetGame() {
    gameState.turn = true;
    gameState.round = 0;
    gameState.gameOver = false;
    gameState.playerStand = false;
    gameState.currentBet = 0;
    hitButton.disabled = true;
    standButton.disabled = true;
    dealerCardAmount.innerHTML = "0";
    playerCardAmount.innerHTML = "0";
    clearCards();
}
function clearCards() {
    const dealerItems = document.querySelectorAll('#dealer-section .dealer-item');
    for (let i = 2; i < dealerItems.length; i++) {
        dealerItems[i].remove();
    }

    changeCardDealer(0, cards.spadeBack.picLink);
    changeCardDealer(1, cards.spadeBack.picLink);

    const playerItems = document.querySelectorAll('#player-section .player-item');
    for (let i = 2; i < playerItems.length; i++) {
        playerItems[i].remove();
    }
    changeCardPlayer(0, cards.spadeBack.picLink);
    changeCardPlayer(1, cards.spadeBack.picLink);
}
function startGames(bet) {
    if (gameState.gameOver) {
        resetGame();
    }

    if (gameState.round === 0) {
        
        changeCardDealer(0, getRandomCard().picLink);
        changeCardPlayer(0, getRandomCard().picLink);
        changeCardPlayer(1, getRandomCard().picLink);

        hitButton.disabled = false;
        standButton.disabled = false;

        gameState.round = 1;
    }

    updateCardCounts();

}
function hitPress() {
    if (gameState.gameOver || !gameState.turn) {
        return;
    }

    let ranca = getRandomCard().picLink;
    hitCard.src = ranca;
    document.getElementById("show-hit").style.display = "flex";
    setTimeout(function() {
        const showhit = document.getElementById("show-hit");
        showhit.style.opacity = "0"; 
        setTimeout(function() {
            showhit.style.display = "none";
            showhit.style.opacity = "1"; 
            addCardPlayer(ranca);
            updateCardCounts();
            const playerScore = calculatePlayerCard();
            if (playerScore > 21) {
                endGame("dealer");
            }
        }, 100); 
    }, 1000);
}
function dealerPlay() {
    let dealerScore = calculateDealerCard();

    while (dealerScore < 17 && !gameState.gameOver) {
        setTimeout(addCardDealer(getRandomCard().picLink), 1000);
        dealerScore = calculateDealerCard();
        updateCardCounts();

        if (dealerScore > 21) {
            endGame("player");
            return;
        }
    }

    const playerScore = calculatePlayerCard();
    if (dealerScore > playerScore) {
        endGame("dealer");
    } else if (dealerScore < playerScore) {
        endGame("player");
    } else {
        endGame("tie");
    }
}
function standPress() {
    if (gameState.gameOver || !gameState.turn) {
        return;
    }

    gameState.turn = false;
    gameState.playerStand = true;

    const dealerItems = document.querySelectorAll('#dealer-section .dealer-item');
    for (let i = 1; i < dealerItems.length; i++) {
        dealerItems[i].remove();
    }
    addCardDealer(getRandomCard().picLink);
    updateCardCounts();
    setTimeout(dealerPlay, 1000);

}
function updateCardCounts() {
    dealerCardAmount.innerHTML = calculateDealerCard();
    playerCardAmount.innerHTML = calculatePlayerCard();
}
function endGame(winner) {
    gameState.gameOver = true;
    hitButton.disabled = true;
    standButton.disabled = true;

    const currentMoney = (moneyAmount.textContent);

    if (winner === "player") {
        document.getElementById("win-sound").play();
        setTimeout(function() {
            document.getElementById("win-celebration").style.display = "flex";
        }, 500);
        setTimeout(function() {
            const wincelebration = document.getElementById("win-celebration");
            wincelebration.style.opacity = "0"; 
            setTimeout(function() {
                wincelebration.style.display = "none";
                wincelebration.style.opacity = "1"; 
                resetGame();
            }, 600); 
        }, 4000);
        
        const winnings = betAmount * 2;
        moneyAmount.textContent = parseFloat(currentMoney) + parseFloat(winnings);
    } else if (winner === "dealer") {

        if (parseInt(moneyAmount.textContent) <= 0) {
            setTimeout(function() {
                document.getElementById("outofmoney-celebration").style.display = "flex";
            }, 500);
            setTimeout(function() {
                const outofmoneycelebration = document.getElementById("outofmoney-celebration");
                outofmoneycelebration.style.opacity = "0";
                setTimeout(function() {
                    outofmoneycelebration.style.display = "none"; 
                    outofmoneycelebration.style.opacity = "1"; 
                    location.reload();
                }, 600); 
            }, 4000);
            return;
        }



        document.getElementById("lose-sound").play();
        setTimeout(function() {
            document.getElementById("lose-celebration").style.display = "flex";
        }, 500);
        setTimeout(function() {
            const losecelebration = document.getElementById("lose-celebration");
            losecelebration.style.opacity = "0";
            setTimeout(function() {
                losecelebration.style.display = "none"; 
                losecelebration.style.opacity = "1";
                resetGame();
            }, 600); 
        }, 4000);
    } else {
        playerCardAmount.innerHTML = "TIE";
        setTimeout(function() {
            resetGame();
        }, 3000); 
        moneyAmount.textContent = parseFloat(currentMoney) + parseFloat(betAmount);
    }
    
    

    gameState.currentBet = 0;
}
var cards = {
    // Spades
    spadeBack: {
        type: "Spade",
        price1: 0,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/zback.jpg"
    },
    spadeA: {
        type: "Spade",
        price1: 1,
        price2: 11,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/S01.jpg"
    },
    spade2: {
        type: "Spade",
        price1: 2,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/S02.jpg"
    },
    spade3: {
        type: "Spade",
        price1: 3,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/S03.jpg"
    },
    spade4: {
        type: "Spade",
        price1: 4,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/S04.jpg"
    },
    spade5: {
        type: "Spade",
        price1: 5,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/S05.jpg"
    },
    spade6: {
        type: "Spade",
        price1: 6,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/S06.jpg"
    },
    spade7: {
        type: "Spade",
        price1: 7,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/S07.jpg"
    },
    spade8: {
        type: "Spade",
        price1: 8,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/S08.jpg"
    },
    spade9: {
        type: "Spade",
        price1: 9,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/S09.jpg"
    },
    spade10: {
        type: "Spade",
        price1: 10,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/S10.jpg"
    },
    spadeJ: {
        type: "Spade",
        price1: 10,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/SC1J.jpg"
    },
    spadeQ: {
        type: "Spade",
        price1: 10,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/SC2Q.jpg"
    },
    spadeK: {
        type: "Spade",
        price1: 10,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/SC3K.jpg"
    },

    // Hearts
    heartA: {
        type: "Heart",
        price1: 1,
        price2: 11,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/H01.jpg"
    },
    heart2: {
        type: "Heart",
        price1: 2,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/H02.jpg"
    },
    heart3: {
        type: "Heart",
        price1: 3,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/H03.jpg"
    },
    heart4: {
        type: "Heart",
        price1: 4,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/H04.jpg"
    },
    heart5: {
        type: "Heart",
        price1: 5,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/H05.jpg"
    },
    heart6: {
        type: "Heart",
        price1: 6,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/H06.jpg"
    },
    heart7: {
        type: "Heart",
        price1: 7,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/H07.jpg"
    },
    heart8: {
        type: "Heart",
        price1: 8,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/H08.jpg"
    },
    heart9: {
        type: "Heart",
        price1: 9,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/H09.jpg"
    },
    heart10: {
        type: "Heart",
        price1: 10,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/H10.jpg"
    },
    heartJ: {
        type: "Heart",
        price1: 10,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/HC1J.jpg"
    },
    heartQ: {
        type: "Heart",
        price1: 10,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/HC2Q.jpg"
    },
    heartK: {
        type: "Heart",
        price1: 10,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/HC3K.jpg"
    },

    // Clubs
    clubA: {
        type: "Club",
        price1: 1,
        price2: 11,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/C01.jpg"
    },
    club2: {
        type: "Club",
        price1: 2,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/C02.jpg"
    },
    club3: {
        type: "Club",
        price1: 3,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/C03.jpg"
    },
    club4: {
        type: "Club",
        price1: 4,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/C04.jpg"
    },
    club5: {
        type: "Club",
        price1: 5,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/C05.jpg"
    },
    club6: {
        type: "Club",
        price1: 6,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/C06.jpg"
    },
    club7: {
        type: "Club",
        price1: 7,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/C07.jpg"
    },
    club8: {
        type: "Club",
        price1: 8,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/C08.jpg"
    },
    club9: {
        type: "Club",
        price1: 9,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/C09.jpg"
    },
    club10: {
        type: "Club",
        price1: 10,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/C10.jpg"
    },
    clubJ: {
        type: "Club",
        price1: 10,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/CC1J.jpg"
    },
    clubQ: {
        type: "Club",
        price1: 10,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/CC2Q.jpg"
    },
    clubK: {
        type: "Club",
        price1: 10,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/CC3K.jpg"
    },

    // Diamonds
    diamondA: {
        type: "Diamond",
        price1: 1,
        price2: 11,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/D01.jpg"
    },
    diamond2: {
        type: "Diamond",
        price1: 2,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/D02.jpg"
    },
    diamond3: {
        type: "Diamond",
        price1: 3,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/D03.jpg"
    },
    diamond4: {
        type: "Diamond",
        price1: 4,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/D04.jpg"
    },
    diamond5: {
        type: "Diamond",
        price1: 5,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/D05.jpg"
    },
    diamond6: {
        type: "Diamond",
        price1: 6,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/D06.jpg"
    },
    diamond7: {
        type: "Diamond",
        price1: 7,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/D07.jpg"
    },
    diamond8: {
        type: "Diamond",
        price1: 8,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/D08.jpg"
    },
    diamond9: {
        type: "Diamond",
        price1: 9,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/D09.jpg"
    },
    diamond10: {
        type: "Diamond",
        price1: 10,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/D10.jpg"
    },
    diamondJ: {
        type: "Diamond",
        price1: 10,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/DC1J.jpg"
    },
    diamondQ: {
        type: "Diamond",
        price1: 10,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/DC2Q.jpg"
    },
    diamondK: {
        type: "Diamond",
        price1: 10,
        picLink: "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/DC3K.jpg"
    }
};
//Main Funtion
function addCardDealer(imageLink) {
    let divInisial = document.createElement("div")
    divInisial.classList.add("dealer-item");
    let picInDiv = document.createElement("img")
    picInDiv.setAttribute("src", imageLink);
    divInisial.appendChild(picInDiv);

    document.getElementById("dealer-section").appendChild(divInisial)
}
function changeCardDealer(index, imageLink) {

    let cardDealer = document.getElementsByClassName("dealer-item")[index].getElementsByTagName("img")[0];
    cardDealer.setAttribute("src", imageLink);
}
function addCardPlayer(imageLink) {
    let divInisial = document.createElement("div")
    divInisial.classList.add("player-item");
    let picInDiv = document.createElement("img")
    picInDiv.setAttribute("src", imageLink);
    divInisial.appendChild(picInDiv);

    document.getElementById("player-section").appendChild(divInisial)
}
function changeCardPlayer(index, imageLink) {

    let cardDealer = document.getElementsByClassName("player-item")[index].getElementsByTagName("img")[0];
    cardDealer.setAttribute("src", imageLink);
}
function calculatePlayerCard() {
    let total = 0;
    let numAces = 0;
    let allPlayeritem = document.querySelectorAll('#player-section .player-item img');
    
    allPlayeritem.forEach(function (img) {
        let card = getCardByPicLink(img.src);
        total += card.price1;
        if (card.price1 === 1 && card.price2 === 11) {
            numAces += 1;
        }
    });

    // Adjust for Aces
    while (numAces > 0 && total <= 11) {
        total += 10; // Adjust Ace from 1 to 11
        numAces -= 1;
    }

    return total;
}
function calculateDealerCard() {
    let total = 0;
    let numAces = 0;
    let allDealeritem = document.querySelectorAll('#dealer-section .dealer-item img');
    
    allDealeritem.forEach(function (img) {
        let card = getCardByPicLink(img.src);
        total += card.price1;
        if (card.price1 === 1 && card.price2 === 11) {
            numAces += 1;
        }
    });

    while (numAces > 0 && total <= 11) {
        total += 10; 
        numAces -= 1;
    }

    return total;
}
function getRandomCard() {

    while (true) {
        let cardKeys = Object.keys(cards);
        let indexran = Math.floor(Math.random() * cardKeys.length);
        let randomCard = cardKeys[indexran];
        if (cards[randomCard].picLink != "http://www.marytcusack.com/maryc/decks/Images/Cards/OrderElectus/zback.jpg") {

            return cards[randomCard];
        }
    }
    return null;

}
function getCardByPicLink(picLink) {
    for (let card in cards) {
        if (cards[card].picLink === picLink) {
            return cards[card];
        }
    }
    return null;
}
//modal
document.getElementById("dealer-section")
startbutton.onclick = function () {
    const currentMoney = (moneyAmount.textContent);
    // aman
    if (currentMoney <= 0) {
        alert("You don't have any money left to bet!");
        return;
    }
    modal.style.display = "block";
}


closebutton.onclick = function () {
    modal.style.display = "none";
}


window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

standButton.onclick = standPress;
hitButton.onclick = hitPress;

window.onload = function () {
    resetGame();
};



