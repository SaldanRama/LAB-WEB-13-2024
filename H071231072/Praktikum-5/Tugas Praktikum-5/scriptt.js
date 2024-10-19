if (window.location.href.includes("dashboard.html")) {
    const btnStart = document.getElementsByClassName('btn')[0]; // Select the first element with class 'btn'

    // Ensure the element exists
    btnStart.addEventListener('click', () => {
        window.location.href = "blackJack.html";
    });


}if (window.location.href.includes("dashboard.html")) {
    // Mengecek jika halaman saat ini adalah 'dashboard.html'
    const btnStart = document.getElementsByClassName('btn')[0]; 
    // Ambil elemen tombol pertama yang memiliki class 'btn'

    btnStart.addEventListener('click', () => {
        // Menambahkan event listener ke tombol, ketika di-click
        window.location.href = "blackJack.html";
        // Pindah ke halaman 'blackJack.html'
    });
}
else if (window.location.href.includes("blackJack.html")) {
    // Jika halaman saat ini adalah 'blackJack.html'
    shuffleDeck(); 
    // Memanggil fungsi untuk mengacak deck

    // let deck = [{ src: 'assets/card_1.png', value: 2 }, ...];
    // Inisialisasi array deck kartu dengan gambar dan nilai masing-masing

    let playerMoney = 5000;
    // Inisialisasi uang pemain dengan $5000
    let currentBet = 0;
    // Taruhan saat ini diinisialisasi dengan 0
    let playerCards = [], dealerCards = [];
    // Inisialisasi array untuk kartu pemain dan kartu dealer

    const betSection = document.querySelector('.bet-section');
    // Ambil elemen dengan class 'bet-section' untuk area taruhan
    const playerMoneySpan = document.getElementById('player-money');
    // Ambil elemen dengan id 'player-money' untuk menampilkan uang pemain
    const betAmountInput = document.getElementById('bet-amount');
    // Ambil elemen input untuk jumlah taruhan
    const placeBetButton = document.getElementById('place-bet');
    // Ambil tombol untuk memasang taruhan
    const gameArea = document.getElementById('game-area');
    // Ambil elemen area permainan
    const dealerCardsDiv = document.getElementById('dealer-cards');
    // Ambil elemen untuk menampilkan kartu dealer
    const playerCardsDiv = document.getElementById('player-cards');
    // Ambil elemen untuk menampilkan kartu pemain
    const dealerScoreDiv = document.getElementById('dealer-score');
    // Ambil elemen untuk menampilkan skor dealer
    const playerScoreDiv = document.getElementById('player-score');
    // Ambil elemen untuk menampilkan skor pemain
    const hitButton = document.getElementById('hit');
    // Ambil tombol untuk aksi 'Hit'
    const stayButton = document.getElementById('stay');
    // Ambil tombol untuk aksi 'Stay'
    const resultDiv = document.getElementById('result');
    // Ambil elemen untuk menampilkan hasil permainan
    const gameOverDiv = document.getElementById('game-over');
    // Ambil elemen untuk layar 'Game Over'
    const restartButton = document.getElementById('restart');
    // Ambil tombol untuk restart game
    const lanjutkanButton = document.getElementById('lanjutkan');
    // Ambil tombol untuk melanjutkan ke putaran berikutnya

    function shuffleDeck() {
        // Fungsi untuk mengacak deck kartu
        const deckElement = document.createElement('div');
        deckElement.classList.add('deck-shuffle');
        // Buat elemen div untuk menampilkan animasi shuffle
        document.body.appendChild(deckElement);
        // Tambahkan elemen animasi ke body
        setTimeout(() => {
            document.body.removeChild(deckElement);
            // Hapus animasi shuffle setelah selesai
            for (let i = deck.length - 1; i > 0; i--) {
                let j = Math.floor(Math.random() * (i + 1));
                [deck[i], deck[j]] = [deck[j], deck[i]];
                // Algoritma Fisher-Yates untuk mengacak kartu
            }
        }, 3000); // Animasi berjalan selama 3 detik
    }

    function drawCard() {
        return deck.pop();
        // Ambil kartu terakhir dari deck
    }

    function displayCards(cards, div, hideFirst = false) {
        // Fungsi untuk menampilkan kartu di layar
        div.innerHTML = '';
        cards.forEach((card, index) => {
            const cardImg = document.createElement('img');
            cardImg.classList.add('card', 'card-deal');
            // Tambahkan animasi dealCard untuk kartu
            if (hideFirst && index === 0) {
                cardImg.src = 'assets/cover.png';
                // Tampilkan kartu tertutup (belakang) untuk dealer
            } else {
                cardImg.src = card.src;
                // Tampilkan gambar kartu asli
            }
            div.appendChild(cardImg);
        });
    }

    function calculateScore(cards) {
        // Menghitung skor dari kartu
        let score = 0, aceCount = 0;
        cards.forEach(card => {
            if (card.value === 11) aceCount += 1;
            score += card.value;
        });
        while (score > 21 && aceCount > 0) {
            score -= 10;
            aceCount -= 1;
            // Jika ada As dan skor lebih dari 21, ubah nilai As jadi 1
        }
        return score;
    }

    function startGame() {
        // Memulai permainan setelah taruhan
        shuffleDeck();
        playerCards.push(drawCard(), drawCard());
        // Bagikan 2 kartu ke pemain
        dealerCards.push(drawCard(), drawCard());
        // Bagikan 2 kartu ke dealer
        displayCards(dealerCards, dealerCardsDiv, true);
        // Tampilkan kartu dealer, satu tertutup
        displayCards(playerCards, playerCardsDiv);
        // Tampilkan kartu pemain
        playerScoreDiv.textContent = `Skor: ${calculateScore(playerCards)}`;
        dealerScoreDiv.textContent = 'Skor Dealer: ?';
        hitButton.style.display = 'block';
        stayButton.style.display = 'block';
        lanjutkanButton.style.display = 'none';
    }

    placeBetButton.addEventListener('click', () => {
        // Event listener untuk tombol taruhan
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
        resetGame();
        betSection.style.display = 'none';
        gameArea.style.display = 'block';
        startGame();
    });

    hitButton.addEventListener('click', () => {
        // Event listener untuk tombol 'Hit'
        playerCards.push(drawCard());
        displayCards(playerCards, playerCardsDiv);
        playerScoreDiv.textContent = `Skor: ${calculateScore(playerCards)}`;
        if (calculateScore(playerCards) > 21) {
            endRound('Anda bust! Anda kalah.');
        }
    });

    stayButton.addEventListener('click', () => {
        // Event listener untuk tombol 'Stay'
        displayCards(dealerCards, dealerCardsDiv);
        dealerScoreDiv.textContent = `Skor Dealer: ${calculateScore(dealerCards)}`;
        while (calculateScore(dealerCards) < 17) {
            dealerCards.push(drawCard());
            displayCards(dealerCards, dealerCardsDiv);
            dealerScoreDiv.textContent = `Skor Dealer: ${calculateScore(dealerCards)}`;
        }
        const dealerScore = calculateScore(dealerCards);
        const playerScore = calculateScore(playerCards);
        if (dealerScore > 21) endRound('Dealer bust! Anda menang.');
        else if (playerScore > dealerScore) endRound('Anda menang!');
        else if (dealerScore > playerScore) endRound('Dealer menang!');
        else endRound('Push! Seri.');
    });

    function endRound(result) {
        // Mengakhiri putaran dan menampilkan hasil
        resultDiv.textContent = result;
        if (result === 'Anda menang!' || result === 'Dealer bust! Anda menang.') {
            playerMoney += currentBet * 2;
        } else if (result === 'Push! Seri.') {
            playerMoney += currentBet;
        }
        playerMoneySpan.textContent = playerMoney;
        if (playerMoney < 100) {
            gameArea.style.display = 'none';
            gameOverDiv.style.display = 'block';
        } else {
            hitButton.style.display = 'none';
            stayButton.style.display = 'none';
            lanjutkanButton.style.display = 'block';
        }
    }

    restartButton.addEventListener('click', () => {
        // Event listener untuk restart game
        alert('Rafly Influence $5000');
        playerMoney = 5000;
        playerMoneySpan.textContent = playerMoney;
        gameOverDiv.style.display = 'none';
        betSection.style.display = 'block';
    });

    function resetGame() {
        // Mengatur ulang state permainan
        playerCards = [];
        dealerCards = [];
        displayCards([], playerCardsDiv);
        displayCards([], dealerCardsDiv);
        playerScoreDiv.textContent = '';
        dealerScoreDiv.textContent = '';
        resultDiv.textContent = '';
    }
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

    // Mengambil kartu dari deck
    function drawCard(cards, div, hideFirst = false) {
        return deck.pop();
    }

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