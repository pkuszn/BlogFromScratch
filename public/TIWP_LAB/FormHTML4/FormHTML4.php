<?php

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" media="screen" href="/Blackjack/style-blackjack.css"/>
    <title>HTML4 Form</title>
</head>
<body style="background-color: white"onafterprint="" >
<img src="/Icons/previous.png" id="prev" class="top" onclick="backToMain()" />
<script>
    function backToMain(){
        window.location.replace("/index.php");
    }
</script>


<script type="text/javascript">
alert("Ala ma kota. " + "\n" + "\n" + "Natomiast Ola ma psa imieniem 'Burek'. ");
</script>

<form name="form1" action="https://www.tomaszx.pl/materialy/test_przesylania.php" onsubmit="checkIfInputsEmpty(document.form1.nick, document.form1.email, document.form1.message)" method="POST">
    <p>Nick</p>
    <input type="text" name="nick" size="50" onchange="bannedChars(document.form1.nick)"/>
    <p>E:mail</p>
    <input type="text" name="email" size="50" onchange="emailValidator(document.form1.email)"/>
    <p>Message</p>
    <textarea name="message" rows="10" cols="60" maxlength="1000"/>
    </textarea>
    <br>
    <input type="submit" value="send"/>
    <input type="reset" value="reset"/>
    <hr>


</form>
<script type="text/javascript" src="FormHandler.js"></script>
</body>
</html>
