<?php


if(isset($_SESSION['user'])){
    $UserSession = $_SESSION['user'];
}
else{
    $UserSession = "Not logged in";
}

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
    echo $rand_key. "\n";
    $rand_value = $array[$rand_key];

    $output = $rand_value;
    return $output;
}


$_SESSION['userScore'] = drawCards($_SESSION['cards']) + drawCards($_SESSION['cards']);
if(isset($_POST['draw-card'])){
    $_SESSION['newCard'] = drawCards($_SESSION['cards']);
    $_SESSION['userScore'] += $_SESSION['newCard'];
}
else if(isset($_POST['pass'])){
    if($_SESSION['userScore'] <= 21 AND $_SESSION['userScore'] > $_SESSION['computerScore']){
        $_SESSION['Result'] = "User won";
        $_SESSION['userScore'] = 0;
    }
    else if($_SESSION['computerScore'] <= 21 AND $_SESSION['computerScore'] > $_SESSION['userScore']){
        $_SESSION['Result'] = "Computer won";
        $_SESSION['computerScore'] = 0;
    }
}

?>