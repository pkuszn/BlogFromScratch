<!doctype html>
<?php
session_start();

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
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" media="screen" href="style-blackjack.css"/>
    <title>Gra w oczko</title>
</head>
<body>
<header class="top">
    <p id="session" class="top">
        <?php
        echo $UserSession;
        ?>
    </p>
    <img src="previous.png" id="prev" class="top" onclick="backToMain()" />
    <script>
        function backToMain(){
            window.location.replace("../index.php");
        }
    </script>
</header>
<h2 id="header">BlackJack</h2>
<div class="column">
    <div class="card">
        <form method="POST">
            <div class="card-column">
                <table>
                    <tr>
                        <th></th>
                        <th><img src="user.png"/th>
                        <th><img src="imac.png"</th>
                    </tr>
                    <tr>
                        <td>Cards</td>
                        <td>
                            <?php
                            $_SESSION['userScore'] = drawCards($_SESSION['cards']) + drawCards($_SESSION['cards']);
                            if(isset($_POST['draw-card'])){
                                $_SESSION['newCard'] = drawCards($_SESSION['cards']);
                                $_SESSION['userScore'] += $_SESSION['newCard'];
                            }
                            else if(isset($_POST['pass'])){
                                if($_SESSION['userScore'] <= 21 AND $_SESSION['userScore'] > $_SESSION['computerScore']){
                                    $GLOBALS['Result'] = "User won";
                                    $_SESSION['userScore'] = 0;
                                }
                                else if($_SESSION['computerScore'] <= 21 AND $_SESSION['computerScore'] > $_SESSION['userScore']){
                                    $GLOBALS['Result'] = "Computer won";
                                    $_SESSION['computerScore'] = 0;
                                }
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            $_SESSION['computerScore'] = drawCards($_SESSION['cards']) + drawCards($_SESSION['cards']);;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Sum of cards</td>
                        <td>
                            <?php
                            echo $_SESSION['userScore'];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $_SESSION['computerScore'];
                            ?></td>
                    </tr>
                </table>
            </div>
            <div class="output">
                <?php
                if(empty($_POST['pass']) AND empty($_POST['pass2']) AND empty($_POST))
                if(isset($_POST['pass'])){
                    echo "Results: " . $GLOBALS['Result'];
                }
                else {
                    echo "Results: ";
                }
                ?>
            </div>

    </div>
    <div class="button-div">
        <button name="draw-card" id="drawn" class=buttons">Draw a card</button>
        <input type="submit" class=buttons" id="pass" name="pass" value="Pass">

    </div>
    <!--
    <button type="start" name="start" value="Start"/>
    -->
    </form>

</div>

</body>
</html>