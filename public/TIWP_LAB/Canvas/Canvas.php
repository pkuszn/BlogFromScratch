<?php

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" media="screen" href="/Blackjack/style-blackjack.css"/>
    <title>Document</title>
</head>
<body style="background-color: white"onafterprint="" >
<img src="/Icons/previous.png" id="prev" class="top" onclick="backToMain()" />
<script>
    function backToMain(){
        window.location.replace("/index.php");
    }
</script>
<canvas id="rysowanie" width="400" height="400" style="border: solid 1px black;">
    Twoja przeglądarka nie obsługuje elementu Canvas.
</canvas>
<button id="fioletowy">fioletowy</button>
<button id="zielony">zielony</button>
<button id="zolty">zolty</button>
<button id="brazowy">brazowy</button>

<button id="male">male</button>
<button id="srednie">srednie</button>
<button id="duze">duze</button>
<button id="ogromne">ogromne</button>
<button id="gumka">gumka</button>
<button id="zresetuj">reset</button>
<button id="pedzel">pedzel</button>
<button id="draw">draw-rectangle</button>
<input type="text" id="input"/>
<p>Input: x, y, width, height</p>

<script type="text/javascript">
    var clickX = new Array();
    var clickY = new Array();
    var clickDrag = new Array();
    var paint = false;
    var context = null;
    var canvas = null;

    const colorPurple = "#cb3594";
    const colorGreen = "#659b41";
    const colorYellow = "#ffcf33";
    const colorBrown = "#986928";
    const colorWhite = "white";
    var curColor = colorPurple;
    var clickColor = new Array();
    //nowość tablica rozmiarów
    var clickSize = new Array();
    var curSize = 5;

    canvas = document.getElementById('rysowanie');
    context = canvas.getContext("2d");
    male.onclick = function() {
        curSize = 3;
    }

    srednie.onclick = function() {
        curSize = 5;
    }

    duze.onclick = function() {
        curSize = 7;
    }

    ogromne.onclick = function() {
        curSize = 9;
    }

    fioletowy.onclick = function() {
        curColor = colorPurple;
    }

    zielony.onclick = function() {
        curColor = colorGreen;
    }

    zolty.onclick = function() {
        curColor = colorYellow;
    }

    brazowy.onclick = function() {
        curColor = colorBrown;
    }

    gumka.onclick = function(){
        curColor = colorWhite;
    }

    zresetuj.onclick = function(){
        reset();
    }

    pedzel.onclick = function() {
        curColor = colorPurple;
    }

    draw.onclick = function(){
        var array = getParametersFromInput()
        drawRectangle(array[0], array[1], array[2], array[3], context);
    }




    function drawRectangle(a, b, c, d, context) {
        context.fillRect(a,b,c,d);
        context.fillStyle(curColor);
    }

    function getParametersFromInput(){
        var numbers = document.getElementById('input').value;
        var comma = numbers.split(",");
        for(var i = 0; i<comma.length; i++){
            comma[i] = parseInt(comma[i], 10);
        }
        return comma;
    }

    canvas.onmousedown = function(e){
        paint = true;
        addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, false);
        redraw();
    }

    canvas.onmousemove = function(e){
        if(paint){
            addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
            redraw();
        }
    }

    canvas.onmouseup = function(){
        paint = false;
    }

    canvas.onmouseleave = function() {
        paint = false;
    }



    function addClick(x, y, dragging)
    {
        clickX.push(x);
        clickY.push(y);
        clickDrag.push(dragging);
        clickColor.push(curColor);
        //nowość zapamiętanie rozmiaru
        clickSize.push(curSize);
    }

    function redraw(){
        context.clearRect(0, 0, 400, 400);
        context.lineJoin = "round";
        // usunieto context.lineWidth = 5;

        for(var i=0; i < clickX.length; i++)
        {
            context.beginPath();
            if(clickDrag[i]){
                context.moveTo(clickX[i-1], clickY[i-1]);
            }else{
                context.moveTo(clickX[i], clickY[i]);
            }
            context.lineTo(clickX[i], clickY[i]);
            context.closePath();
            context.strokeStyle = clickColor[i];
            //ustaw grubość linii
            context.lineWidth = clickSize[i];
            context.stroke();
        }
    }

    function reset() {
        context.clearRect(0, 0, 400, 400);
        clickX = new Array();
        clickY = new Array();
        clickColor = new Array();
        clickSize = new Array();
        clickDrag = new Array();
    }

</script>

</body>
</html>
