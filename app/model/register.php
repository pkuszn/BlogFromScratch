<?php

// SQL Statements
//Link this statement with AJAX execute




function registerProcess(){
    if (isset($_POST['submit']) AND $_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "eluwina";
        if (isset($_POST['nickname']) and isset($_POST['email']) and isset($_POST['password']) and isset($_POST['confirmpassword'])) {
            try {
                require('connection.php');
                $conn = establishConnection();
//User_ID	User_name	User_email	User_password	User_amount_of_posts	User_created_date_account	User_birthdate	User_city	User_avatar	User_first_name	User_last_name	Images_Images_ID	Statistics_Statistics_ID
                $UserNick = mysqli_real_escape_string($conn, $_REQUEST['nickname']);
                $UserEmail = mysqli_real_escape_string($conn, $_REQUEST['email']);
                $UserPassword = mysqli_real_escape_string($conn, $_REQUEST['password']);
                $UserConfirmPassword = mysqli_real_escape_string($conn, $_REQUEST['confirmpassword']);
                $UserFirstName = mysqli_real_escape_string($conn, $_REQUEST['firstname']);
                $UserLastName = mysqli_real_escape_string($conn, $_REQUEST['lastname']);
                $UserCountry = mysqli_real_escape_string($conn, $_REQUEST['country']);
                $UserBirthday = mysqli_real_escape_string($conn, $_REQUEST['birthday']);

                $query = "INSERT INTO user (User_name, User_email, User_password, User_birthdate, User_city, User_first_name, User_last_name)
                            VALUES (?, ?, ?, ?, ?, ?, ?);";
                echo $UserNick;
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $query)) {
                    echo "SQL error";
                    echo mysqli_stmt_error($stmt);
                } else {
                    if($UserPassword === $UserConfirmPassword){
                        mysqli_stmt_bind_param($stmt, "sssssss", $UserNick, $UserEmail, $UserPassword, $UserBirthday, $UserCountry, $UserFirstName, $UserLastName);
                        mysqli_stmt_execute($stmt);
                        mysqli_debug("d:t:o,/tmp/client.trace");
                        sleep(2);
                        $_SESSION['user'] = $UserNick;

                        header("Location: index.php?page=home");
                    }
                    else{
                        echo "<script type='text/javascript'>alert('Passwords does not match')</script>";
                    }
                }
            } catch (mysqli_sql_exception $e) {
                echo "<script type='text/javascript'>alert('Failed to register user')</script>";
                //echo $e.mysqli_stmt_error($stmt);
                $conn . mysqli_rollback($conn);
            }
        }
    } else {
        echo "<script type='text/javascript'>alert('Couldnt add user to website database')</script>";
    }
}


/*
 function IsExist(){
    $email = $_POST['email'];
    $conn = establishConnection();
    $stmt = "";
    try{
        $stmt = mysqli_stmt_init($conn);
        $query = "SELECT User_email FROM user WHERE User_email = ?";

        $stmt = mysqli_stmt_prepare($stmt, $query);
        if(!mysqli_stmt_prepare($stmt, $query)){
            echo "<script type='text/javascript'>alert('SQL STATEMENT FAILED')</script>";
            return false;
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            while($row = mysqli_fetch_assoc($result)){
                $action = !($row['User_email'] == 0 || $row['User_email'] == null) ? " User exist" : "User does not exist";
                echo $action;
            }
        }
    }
    catch(mysqli_sql_exception $ex){
        echo $ex.mysqli_stmt_error($stmt);
    }
}


function emailValidation($param1)
{
    $value = preg_match('/^([a-z|A-Z|0-9]{4,22})@([a-z|A-Z|0-9]{2,12})\\.(pl|com)$/', $param1);
    if ($value) {
        return true;
    } else {
        return false;
    }
}

function arePasswordsEquals($password, $confirmPassword)
{
    if (strcmp($password, $confirmPassword) == 0) {
        return true;
    } else {
        return false;
    }
}

function birthdayValidation($birthday)
{
    $value = preg_match('^(?:(?:1[6-9]|[2-9]\d)?\d{2})(?:(?:(\/|-|\.)(?:0?[13578]|1[02])\1(?:31))|(?:(\/|-|\.)(?:0?[13-9]|1[0-2])\2(?:29|30)))$|
^(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00)))(\/|-|\.)0?2\3(?:29)$|
^(?:(?:1[6-9]|[2-9]\d)?\d{2})(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:0?[1-9]|1\d|2[0-8])$', $birthday);
    if ($value) {
        return true;
    } else {
        return false;
    }

function checkCaptcha(){
    if (isset($_POST['code'])) {
        if ($_POST['code'] == $_SESSION['captcha']) {
            return true;
            $_SESSION['user'] = $_POST['nickname'];
            redirect("LoginUser.php");
    } else {
            return false;
        }
    }
    $_SESSION['captcha'] = mt_rand(10000, 99999);

}




}*/





