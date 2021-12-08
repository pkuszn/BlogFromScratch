<?php

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" media="screen" href="form-style.css"/>
    <title>HTML5 Form</title>
</head>
<body style="background-color: white" onafterprint="">
<div id="img">
    <img src="/blog/BlogFromScratch/Icons/previous.png" id="prev" class="top" onclick="backToMain()"/>
</div>
<script>
    function backToMain() {
        window.location.replace("/blog/BlogFromScratch/index.php");
    }
</script>

<form method="POST" action="Output.php" id="form-container">
    <div class="inputs-container">
        <label for="firstname">First name</label>
        <input class="inputs" type="text" name="firstname" placeholder="Enter your first name">
        <label for="lastname">Last name</label>
        <input class="inputs" type="text" name="lastname" placeholder="Enter your last name"/>
        <hr id="line">
        <label for="email">E-mail</label>
        <input class="inputs" type="email" name="email" placeholder="Enter your e-mail adress" required/>
        <label for="Age">Age</label>
        <input class="inputs" type="range" min="13" max="120" onchange="actualAge.value = value" name="firstname"/>
        <output id="actualAge">18</output>
        <label for="password">Password</label>
        <input class="inputs" type="password" name="password" placeholder="Enter your password"/>
        <label for="confirmpassword">Confirm Password</label>
        <input class="inputs" type="password" name="confirmpassword" placeholder="Confirm your password" required/>
        <label for="country">Country</label>
        <input class="inputs" type="text" name="country" placeholder="Enter your country"/>
    </div>
    <div class="buttons">
        <button class="buttons" class="inputs" type="submit" value="send">send</button>
        <button class="buttons" type="reset" value="reset">reset</button>
    </div>
</form>
<script type="text/javascript" src="FormHandler.js"></script>
</body>
</html>
