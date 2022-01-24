<?php

$deck = array(
    '2' => 2,
    '3' => 3,
    '4' => 4,
    '5' => 5,
    '6' => 6,
    '7' => 7,
    '8' => 8,
    '9' => 9,
    '10' => 10,
    'Jack' => 2,
    'Queen' => 3,
    'King' => 4,
    'Ace' => 11
);

$_SESSION['cards'] = $deck;

$computer = array();
$user = array();

/*
    Karty 2 do 10 mają wartość równą wartości karty
    walet – 2 pkt.
    dama – 3 pkt.
    król – 4 pkt.
    As – 11 pkt.
 */

function drawCards($array)
{
    $rand_key = array_rand($array);
    echo $rand_key . "\n";
    $rand_value = $array[$rand_key];

    $output = $rand_value;
    return $output;
}

?>