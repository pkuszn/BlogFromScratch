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
            $userInput = displayCaptcha();

        ?>
    </div>

    <div class="row">
        <input type="text" name="Captcha"/>
    </div>
    <div class="row">
        <input type="submit" name="veryfiCaptcha"/>
    </div>

</div>



</body>
</html>
