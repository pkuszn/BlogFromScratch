<?php

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
<img src="blog/BlogFromScratch/Icons/previous.png" id="prev" class="top" onclick="backToMain()" />
<script>
    function backToMain(){
        window.location.replace("../index.php");
    }
</script>

<canvas id="linia" style="border: 1px solid;" width="200" height="200"/>

<script>
    function rysujLinie() {
        var canvas = document.getElementById(linia');
        var context = canvas.getContext('2d');
// Zapisz aktualny stan
        context.save();
// Przesuń kontekst w prawo i w dół
        context.translate(70, 140);
// Narysuj linię, ale odnosząc się do punktu (0,0)
        context.beginPath();
        context.moveTo(0, 0);
        context.lineTo(70, -70);
        context.stroke();
// Przywróć zapamiętany stan
        context.restore();
    }
    window.addEventListener("load", rysujLinie, true);
</script>


</body>
</html>
