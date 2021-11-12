<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" media="screen" href="oczko.css"/>
    <title>Gra w oczko</title>
</head>
<body>
<div class="column">
    <div class="card">
        <p>Suma kart:</p>

    </div>
    <div class="card">
        <p></p>

    </div>

    <button name="dodaj-karte">Dodaj karte</button>
    <input type="submit">
    <?php
    $talia = array(
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7' => 7,
        '8' => 8,
        '9' => 9,
        '10' => 10,
        'Walet' => 2,
        'Dama' => 3,
        'Król' => 4,
        'As' => 11
    );

    $losKomputer = array();
    $losUżytkownik = array();


    $losUżytkownik = losujKarte($talia);
    $losKomputer = losujKarte($talia);

    print_r($losUżytkownik);
    print_r($losKomputer);


    ?>



</div>

</body>
</html>







<?php
/*
 *
 *
 * Karty 2 do 10 mają wartość równą wartości karty
walet – 2 pkt.
dama – 3 pkt.
król – 4 pkt.
As – 11 pkt.

 */




function losujKarte($array)
{
    $input = $array;
    $los = array_rand($input, 2);
    echo $los[0] . "\n";
    echo $los[1] . "\n";
}
?>