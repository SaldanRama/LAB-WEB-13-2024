$(document).ready(function () {
    var suits = ['♠', '♥', '♣', '♦'];
    var ranks = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

    function Player() {
        this.hand = [];
        this.money = 5000;
        this.bet = 0;
    }

    Player.prototype.addCard = function (card) {
        this.hand.push(card);
    };

    Player.prototype.getHand = function () {
        return this.hand;
    };

    Player.prototype.setBet = function (amount) {
        this.bet = amount;
        $('#bet').val(this.bet);
    };

    Player.prototype.getBet = function () {
        return this.bet;
    };

    Player.prototype.setUang = function (amount) {
        console.log("Sebelum: " + this.money);
        this.money += amount; // uang berkurang atau bertambah
        console.log("Sesudah: " + this.money);
        $('#uang span').text(this.money);
    };

    Player.prototype.getScore = function () {
        var hand = this.getHand(),
            score = 0,
            aceCount = 0;

        hand.forEach(function (card) {
            score += card.value;
            if (card.rank === 'A') aceCount++;
        });

        while (score > 21 && aceCount > 0) {
            score -= 10;
            aceCount--;
        }

        return score;
    };

    Player.prototype.resetHand = function () {
        this.hand = [];
    };

    function Dealer() {
        this.hand = [];
    }

    Dealer.prototype.addCard = function (card) {
        this.hand.push(card);
    };

    Dealer.prototype.getHand = function () {
        return this.hand;
    };

    Dealer.prototype.flipCard = function () {
        $('#dhand .card.down').removeClass('down').addClass('up');
    };

    Dealer.prototype.getScore = function () {
        var hand = this.getHand(),
            score = 0,
            aceCount = 0;

        hand.forEach(function (card) {
            score += card.value;
            if (card.rank === 'A') aceCount++;
        });

        while (score > 21 && aceCount > 0) {
            score -= 10;
            aceCount--;
        }

        return score;
    };

    Dealer.prototype.resetHand = function () {
        this.hand = [];
    };

    function createCard(rank, suit) {
        var value;
        if (rank === 'J' || rank === 'Q' || rank === 'K') {
            value = 10;
        } else if (rank === 'A') {
            value = 11;
        } else {
            value = parseInt(rank);
        }
        return { rank: rank, suit: suit, value: value };
    }

    function renderCard(card, isUp) {
        var cardHtml = $('<div class="card"></div>');
        cardHtml.addClass(isUp ? 'up' : 'down');
        
        var suitSymbol = {
            '♠': 'S',
            '♥': 'H',
            '♣': 'C',
            '♦': 'D'
        };
    
        var imgSrc;
        if (isUp) {
            imgSrc = 'images/' + card.rank + '-' + suitSymbol[card.suit] + '.png'; 
        } else {
            imgSrc = 'images/back.png';
        }
    
        var imgElement = $('<img>').attr('src', imgSrc).attr('alt', card.rank + card.suit);
        cardHtml.append(imgElement);
    
        return cardHtml;
    }

    var player = new Player();
    var dealer = new Dealer();

    function dealCard(target, isDealer, isUp) {
        var rank = ranks[Math.floor(Math.random() * ranks.length)];
        var suit = suits[Math.floor(Math.random() * suits.length)];
        var card = createCard(rank, suit);
    
        target.addCard(card);
    
        var cardElement = renderCard(card, isUp);
        if (isDealer) {
            $('#dhand').append(cardElement);
        } else {
            $('#phand').append(cardElement);
        }
    }

    function newGame() {
        player.resetHand();
        dealer.resetHand();
        $('#phand').empty();
        $('#dhand').empty();
    
        var betAmount = parseInt($('#bet').val());
        if (isNaN(betAmount) || betAmount <= 0) {
            showAlert('Invalid bet amount.');
            return;
        }
    
        if (betAmount > player.money) {
            showAlert('Uang tidak cukup. Kamu sudah MISKIN!.');
            return;
        }
    
        player.setBet(betAmount);
        player.setUang(-betAmount);  
    
        dealCard(player, false, true);
        dealCard(player, false, true);
        
        dealCard(dealer, true, false); 
        dealCard(dealer, true, true);
    }

    function dealerPlay() {
        while (dealer.getScore() < 17) {
            dealCard(dealer, true, true); 
        }
        checkWinner();
    }

    function checkWinner() {
        var playerScore = player.getScore();
        var dealerScore = dealer.getScore();

        if (playerScore > 21) {
            showAlert('Kamu kalah!');
            player.setUang(-player.getBet()); 
        } else if (dealerScore > 21) {
            showAlert('Kamu menang! Dealer bust.');
            player.setUang(player.getBet() * 2); 
        } else if (playerScore === 21) {
            showAlert('Kamu menang!');
            player.setUang(player.getBet() * 2);
        } else if (dealerScore === 21) {
            showAlert('Dealer menang!');
            player.setUang(-player.getBet()); 
        } else if (playerScore > dealerScore) {
            showAlert('Kamu menang!');
            player.setUang(player.getBet() * 2); 
        } else if (playerScore < dealerScore) {
            showAlert('Dealer menang!');
            player.setUang(-player.getBet()); 
        } else {
            showAlert('Seri!'); 
        }

        if (player.money <= 0) {
            player.money = 0;
            showGameOver();
        }
    }

    $('#hit').on('click', function () {
        dealCard(player, false, true);
        if (player.getScore() > 21) {
            showAlert('Kamu kalah, skor lebih dari 21.');
            $('#hit').attr('disabled', 'disabled');
            $('#stay').attr('disabled', 'disabled');
            $('#deal').removeAttr('disabled');
        }
    });
    
    $('#stay').on('click', function () {
        dealer.flipCard(); 
        dealerPlay(); 
        $('#hit').attr('disabled', 'disabled');
        $('#stay').attr('disabled', 'disabled');
        $('#deal').removeAttr('disabled');
    });

    function showGameOver() {
        $('#gameOver').removeClass('hide').addClass('show');
        $('#deal, #hit, #stay').attr('disabled', 'disabled');
    }
    
    $('#restart').on('click', function() {
        player.money = 5000; 
        $('#uang span').text(player.money); 
        $('#gameOver').removeClass('show').addClass('hide'); 
    });
    
    function showAlert(message) {
        $('#alert span').text(message);
        $('#alert').removeClass('hide').addClass('show');
        setTimeout(function () {
            $('#alert').removeClass('show').addClass('hide');
        }, 2000);
    }

    $('#deal').on('click', function () {
        $('#hit, #stay').removeAttr('disabled');
        $('#deal').attr('disabled', 'disabled');
        newGame(); 
    });
});
