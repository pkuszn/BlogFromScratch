<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" media="screen" href="style-captcha.css"/>
    <title>Log in a website</title>
</head>
<body>

<h1 id="header">Captcha</h1>
<div class="frame" style="horiz-align: center">
    <?php
    session_start();

    if (isset($_POST['code'])) {
        if ($_POST['code'] == $_SESSION['captcha']) {
            echo "Captcha valid";
            redirect("login.php");
        }
        else {
            echo "Captcha NOT valid";
        }
    }

    $_SESSION['captcha'] = mt_rand(10000, 99999);


    function redirect($url) {
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
    }
    ?>
    <form action="" method="post">
        <p>Enter this number: <?php echo $_SESSION['captcha']; ?></p>
        <p><input type="text" name="code" /> <input type="submit" value="Submit" />
    </form>
</div>
<?php

?>



</body>
</html>
