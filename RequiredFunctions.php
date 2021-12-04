<?php

function displayDate() {
    echo "Today is " . date('l jS \of F Y h:i:s A');
}

function quadraticEquation($A, $B, $C){

    // a*x^2 + b * x + c
    $x1 = 0;
    $x2 = 0;
    $delta = ($B * $B) - 4 * $A * $C;

    if($delta < 0) {
        echo "No answer";
    }
    else if($delta == 0){
        $x1 = -$B/(2 * $A);
        echo "The equation has one solution: " . $x1;
    }
    else if($delta > 0){
        $x1 = (-$B -(sqrt($delta)))/(2*$A);
        $x2 = (-$B +(sqrt($delta)))/(2*$A);
        echo "The equation has two solutions: " . "x1: " . $x1 . " x2: " . $x2;
    }
}



function getFile(){
    $file = basename(urldecode(($_GET['file'])));
    $fileDir = 'BlogFromScratch/icons/';

    if(file_exists($fileDir . $file)){
        $contents = file_get_contents($fileDir . $file);
        header('Content-type: image/png');

        echo $contents;

    }
}



?>

