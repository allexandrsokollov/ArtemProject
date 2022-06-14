<?php
if (isset($_POST['word'])) {
    setcookie("word", $_POST['word'], time() + 3600 * 60, false);
}

if (isset($_POST['question'])) {
    setcookie("question", $_POST['question'], time() + 3600 * 60, false);
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<script>

    var wordLength = getCookie("word").toString().length;
    var unveiledLettersAndStars = new Array(wordLength);

    var bids = 0;

    var word = new Array(wordLength);
    let tempWord = getCookie("word").toString();

    for (let i = 0; i < wordLength; i++) {
        word[i] = tempWord[i].toUpperCase();
    }

    for (let i = 0; i < wordLength; i++) {
        unveiledLettersAndStars[i] = '*'
    }
    function startNewGame() {
        window.location.replace("startNewGame.php");
    }

    function getCookie(cName) {
        const name = cName + "=";
        const cDecoded = decodeURIComponent(document.cookie);
        const cArr = cDecoded.split('; ');
        let res;
        cArr.forEach(val => {
            if (val.indexOf(name) === 0) res = val.substring(name.length);
        })
        return res
    }

    function isWholeWordUnveiled() {
        for (let i = 0; i < wordLength; i++) {
            if (unveiledLettersAndStars[i] === '*') {
                return false;
            }
        }
        return true;
    }

    function checkInput() {
        bids++;
        var letterOfWord = document.getElementById("wrdInpt").value.toUpperCase();
        letterOfWord.trim();

        if (bids === 20 && !isWholeWordUnveiled()) {
            alert("you lose. you can start new game");
            bids = 0;
            startNewGame();
        }
        if (letterOfWord.length > 1) {

            if (wordLength === letterOfWord.length) {
                for (let i = 0; i < wordLength; i++) {
                    if (word[i] === letterOfWord[i]) {
                        unveiledLettersAndStars[i] = word[i];
                    } else {
                        break;
                    }
                }
            }
            endOfGame();
        } else {
            for (let i = 0; i < wordLength; i++) {
                if (word[i] === letterOfWord) {
                    unveiledLettersAndStars[i] = word[i];
                }
            }
        }
        document.getElementById("word").innerHTML = unveiledLettersAndStars.toString();
        if (isWholeWordUnveiled()) {
            endOfGame();
        }

        document.getElementById("wrdInpt").value = "";
    }

    function endOfGame() {
        if (isWholeWordUnveiled()) {
            document.getElementById("word").innerHTML = (unveiledLettersAndStars.toString().concat(" Congrats, you won"));
            bids = 0;
        } else {
            alert("you lose. you can start new game");
            bids = 0;
            startNewGame();
        }
    }
</script>


<h1 id="word"></h1><br>
<h1 id="question"></h1>

<script>
    document.getElementById("word").innerHTML = unveiledLettersAndStars.toString();
    document.getElementById("question").innerHTML = getCookie("question");
</script>

<form action="startNewGame.php" method="post" >
    <button >start new game</button>
</form>



<input name="wordLetter" id="wrdInpt" type="text" placeholder="letter or whole word"/>

<button onclick="checkInput()">check my input out</button>


</body>
</html>


