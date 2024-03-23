<?php
if (isset ($_POST['action']) == 'math' and $_REQUEST['A'] = 'A' and $_REQUEST['B'] = 'B' and $_REQUEST['C'] = 'C') {
    quadraticEquation($_REQUEST['A'], $_REQUEST['B'], $_REQUEST['C']);
}

function quadraticEquation($A, $B, $C)
{

    // a*x^2 + b * x + c
    $x1 = 0;
    $x2 = 0;
    $delta = ($B * $B) - 4 * $A * $C;

    if ($delta < 0) {
        echo "No answer";
    } else if ($delta == 0) {
        $x1 = -$B / (2 * $A);
        echo "The equation has one solution: " . $x1;
    } else if ($delta > 0) {
        $x1 = (-$B - (sqrt($delta))) / (2 * $A);
        $x2 = (-$B + (sqrt($delta))) / (2 * $A);
        echo "The equation has two solutions: " . "x1: " . $x1 . " x2: " . $x2;
    }
}
?>