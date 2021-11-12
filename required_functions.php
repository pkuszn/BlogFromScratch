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

function emailValidation($param1){
    $value = preg_match('/^([a-z|A-Z|0-9]{4,22})@([a-z|A-Z|0-9]{2,12})\\.(pl|com)$/', $param1);
    if($value) {
        return true;
    }
    else {
        return false;
    }
}

function randomCharacter(){
    return rand(0,3);
}

function displayCaptcha(){
    $opr1 = rand(1,9);
    $opr2 = rand(1,9);
    $temp = randomCharacter();
    $str = "";
    $result = 0;
    switch($temp){
        case 0:
            $result = $opr1 + $opr2;
            $str = "+";
            break;
        case 1:
            $result = $opr1 - $opr2;
            $str = "-";
            break;
        case 2:
            $result = $opr1 * $opr2;
            $str = "*";
            break;
        case 3:
            $result = $opr1 / $opr2;
            $str = "/";
            break;
    }
    echo "Captcha: $opr1 $str $opr2";
    return $result;

}



?>

