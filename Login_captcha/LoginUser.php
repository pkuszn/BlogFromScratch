<?php
session_start();

if(isset($_POST['login']) and isset($_POST['password'])){
    $_SESSION['user'] = $_POST['login'];
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" media="screen" href="style-log.css"/>
    <title>Log in a website</title>
</head>
<body>

<h1 id="header">Log in</h1>
<div class="frame" style="horiz-align: center">
    <form action="LoginUser.php" method="POST">
    <div class="row">
        <p>Login</p>
        <input type="text" class="input-border" name="login"  placeholder="Enter your login" required/>
    </div>
    <div class="row">
        <p>Password</p>
        <input type="password" class="input-border" name="password" placeholder="Enter your password" required/>
    </div>
        <div class="output">
            <?php
            if(isset($_SESSION['user'])){
                echo "Logged in";
                echo $_SESSION['user'];
                sleep(3);
                header("Location: ../Index.php");
            }

            ?>
        </div>
        <div id="row-button">
            <button type="button" class="buttons" id="cancel-button"><a href="../Index.php"/>Main page</button>
            <button type="submit" class="buttons" id="send-button" value="send">Send</button>
        </div>
    </form>

</div>

</body>
</html>


