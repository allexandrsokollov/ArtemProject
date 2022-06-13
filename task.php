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

    for (i = 0; i < wordLength; i++) {
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

    function checkInput() {
    }
</script>


<h1 id="word"></h1>

<script>
    document.getElementById("word").innerHTML = getCookie('word');
</script>

<form action="startNewGame.php" method="post" >
    <button >start new game</button>
</form>



<input name="wordLetter" type="text" placeholder="letter or whole word"/>

<button onclick="">check my input out</button>


</body>
</html>


