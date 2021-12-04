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
<img src="../Blackjack/Icons/previous.png" id="back" class="top" onclick="backToMain()" />
<script>
    function backToMain(){
        window.location.replace("/blog/BlogFromScratch/Index.php");
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

        <div>
            <?php
            if(isset($_POST['register'])){
                echo $_SESSION['add-user-status'];
            }else{
                echo "";
            }
            ?>
        </div>
    <div class="buttons-container">
        <div>
            <button type="submit" value="Register" name='register' id="register">Register</button>
            <button type="button" value="Cancel" id="cancel" name="cancel" onclick="backToMain()">Cancel</button>
        </div>
    </div>
        <?php
        if(isset($_POST['register'])){
            if(isset($_POST['nickname']) and isset($_POST['e-mail']) and isset($_POST['password']) and isset($_POST['confirmpassword'])) {
                try {
                    include("../Connection.php");
                    $conn = establishConnection();
//User_ID	User_name	User_email	User_password	User_amount_of_posts	User_created_date_account	User_birthdate	User_city	User_avatar	User_first_name	User_last_name	Images_Images_ID	Statistics_Statistics_ID
                    $UserNick = mysqli_real_escape_string($conn, $_REQUEST['nickname']);
                    $UserEmail = mysqli_real_escape_string($conn, $_REQUEST['e-mail']);
                    $UserPassword = mysqli_real_escape_string($conn, $_REQUEST['password']);
                    $UserConfirmPassword = mysqli_real_escape_string($conn, $_REQUEST['confirmpassword']);
                    $UserFirstName = mysqli_real_escape_string($conn, $_REQUEST['firstname']);
                    $UserLastName = mysqli_real_escape_string($conn, $_REQUEST['lastname']);
                    $UserCountry = mysqli_real_escape_string($conn, $_REQUEST['country']);
                    $UserBirthday = mysqli_real_escape_string($conn, $_REQUEST['birthday']);

                    $query = "INSERT INTO user (User_name, User_email, User_password, User_birthdate, User_city, User_first_name, User_last_name)
                            VALUES (?, ?, ?, ?, ?, ?, ?);";

                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $query)) {
                        echo "SQL error";
                        echo mysqli_stmt_error($stmt);
                    } else {
                        mysqli_stmt_bind_param($stmt, "sssssss", $UserNick, $UserEmail, $UserPassword, $UserBirthday, $UserCountry, $UserFirstName, $UserLastName);
                        mysqli_stmt_execute($stmt);
                        sleep(2);
                        session_start();
                        $_SESSION['user'] = $UserNick;
                        header("Location: /blog/BlogFromScratch/index.php");
                    }

                } catch (mysqli_sql_exception $e) {
                    $_SESSION['db-status'] = "Failed adding a user";
                    //echo $e.mysqli_stmt_error($stmt);
                    $conn . mysqli_rollback($conn);
                }
            }
        }
        else{
            $_SESSION['db-status'] = "Could not add a user to website database";
        }
        ?>
    </form>
</div>

</body>
</html>

