<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" media="screen" href="style-registeruser.css"/>
    <title>Register user</title>
</head>
<body>
<span id="back-to-main-button">
<img src="Blackjack/previous.png" id="back" class="top" onclick="backToMain()" />
<script>
    function backToMain(){
        window.location.replace("../BlogFromScratch/Index.php");
    }
</script>
</span>
<h1>Sign up</h1>
<div class="register-container">
    <form method="POST" id="form-container">
        <div class="register-sections">
            <h4>Obligatory</h4>
            <div class="input-container">
                <label for="nickname">Nickname</label>
                <input type="text" name="nickname" required/>
            </div>
            <div class="input-container">
                <label for="e-mail">E-mail address</label>
                <input type="text" name="e-mail" required/>
            </div>
            <div class="input-container">
                <label for="password">Password</label>
                <input type="text" name="password" required/>
            </div>
            <div class="input-container">
                <label for="confirmpassword">Confirm Password</label>
                <input type="text" name="confirmpassword" required/>
            </div>
            <div class="input-container">

            </div>
            <div class="input-container" id="terms">
                <label for="privacypolicy" class="terms-block"><a href="https://www.lipsum.com/privacy.pdf">Accept terms</a></label>
                <input type="checkbox"  class="terms-block" name="privacypolicy" />
            </div>
        </div>
        <h4>Optional</h4>
        <div class="register-sections">
            <div class="input-container">
                <label for="firstname">First Name</label>
                <input type="text" name="firstname" />
            </div>
            <div class="input-container">
                <label for="lastname">Last Name</label>
                <input type="text" name="lastname" />
            </div>
            <div class="input-container">
                <label for="birthday">Birthday</label>
                <input type="text" name="birthday" />
            </div>
            <div class="input-container">
                <label for="country">Country</label>
                <input type="text" name="country" />
            </div>
        </div>
    </form>
    <div class="buttons-container">
        <div>
            <button type="button" value="Register" id="register">Register</button>
            <button type="button" value="Cancel" id="cancel" name="cancel" onclick="backToMain()">Cancel</button>


        </div>



    </div>

</div>



</body>
</html>


<?php









?>