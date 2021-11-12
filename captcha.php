<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" media="screen" href="style-captcha.css"/>
    <?php
    include('required_functions.php');
    ?>
    <title>Log in a website</title>
</head>
<body>

<h1 id="header">Captcha</h1>
<div class="frame" style="horiz-align: center">
    <div class="random">
        <?php


        $computationResult = displayCaptcha();
        echo "<br>";
        echo $computationResult;
        echo "<br>";
        echo var_dump($computationResult);
        echo "<br>";

        echo "<br>";
        $temp = 0;
        if (isset($_GET['Captcha'])) {
            $temp = $_GET["Captcha"];
        }
        $userInput = intval($temp);
        $booleanExpression = captchaValidation($computationResult, $userInput);
        if($booleanExpression == true){
            echo "chujk";
            http_redirect("login.php");
        }

        ?>
    </div>
    <div class="row">
        <form method="GET" action="captcha.php">
            <input type="text" name="Captcha"/>
            <input type="submit" name="veryfiCaptcha"/>
        </form>
    </div>
    <div class="random">

    </div>

</div>
<?php

?>



</body>
</html>
