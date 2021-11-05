<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" media="screen" href="style-log.css"/>
    <?php
    include('required_functions.php');
    ?>
    <title>Log in a website</title>
</head>
<body>

<h1 id="header">Send message to a blogger</h1>
<div class="frame" style="horiz-align: center">
    <form action="login.php" method="GET">
    <div class="row">
        <p>login: <input type="text" class="input-border" name="login"/></p>
    </div>
    <div class="row">
        <p>e-mail: <input type="text" class="input-border" name="email"/></p>
    </div>
    <div class="row">
        <p>message: <input id="message" type="text" class="input-border" name="message"/></p>
    </div>
    <div id="row-button">
        <div class="column-button">
            <button type="button" class="buttons" id="cancel-button"><a href="index.php"/>Cancel</button>
        </div>
        <div class="column-button">
            <button type="submit" class="buttons" id="send-button" value="send">Send</button>
        </div>
    </div>
    </form>
</div>
<div class="get">
<?php

if(empty($_GET['login']) AND empty($_GET['email']) AND empty($_GET['message'])){
    echo "Message: ";
}
else{
    if(isset($_GET['login']) AND isset($_GET['email']) AND isset($_GET['message'])) {

        $login = $_GET['login'];
        $email = $_GET['email'];
        $message = $_GET['message'];

        echo '<b>GET</b><br><br>';
        echo 'LOGIN: ';
        if (is_string($login)) {
            echo $_GET['login'];
        } else {
            echo "Login Failed. Couldn't recognize entered characters";
        }

        echo '<br></br>E-MAIL: ';
        if (emailValidation($email) == true) {
            echo $_GET['email'];
        }
    else{
            echo "Couldn't send message";
        }
    }
}
?>
</div>



</body>
</html>


