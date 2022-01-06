<?php

// SQL Statements
//Link this statement with AJAX execute
require $config['LIB_PATH'] . 'connection.php';
$conn = establishConnection();



$statement = null;
if(empty($_POST['code'])){
 // do nothing
}
else{
    if(isset($_POST['code'])){
        $data = json_decode(stripslashes($_POST['code']));
        $statement = checkCaptcha($data);
    }
}


$_SESSION['captcha'] = mt_rand(10000, 99999);

function checkCaptcha($param)
{
    if ($param == $_SESSION['captcha']) {
        return true;
    } else {
        echo "<script>alert('Captcha is invalid')</script>";
        return false;
    }
    $_SESSION['captcha'] = mt_rand(10000, 99999);
}


function registerProcess()
{
    if (isset($_POST['submit']) and $_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['nickname']) and isset($_POST['email']) and isset($_POST['password']) and isset($_POST['confirmpassword'])) {
//User_ID	User_name	User_email	User_password	User_amount_of_posts	User_created_date_account	User_birthdate	User_city	User_avatar	User_first_name	User_last_name	Images_Images_ID	Statistics_Statistics_ID
            $conn = establishConnection();
            $UserNick = mysqli_real_escape_string($conn, $_REQUEST['nickname']);
            $UserEmail = mysqli_real_escape_string($conn, $_REQUEST['email']);
            $UserPassword = mysqli_real_escape_string($conn, $_REQUEST['password']);
            $UserConfirmPassword = mysqli_real_escape_string($conn, $_REQUEST['confirmpassword']);
            $UserFirstName = mysqli_real_escape_string($conn, $_REQUEST['firstname']);
            $UserLastName = mysqli_real_escape_string($conn, $_REQUEST['lastname']);
            $UserCity = mysqli_real_escape_string($conn, $_REQUEST['city']);
            $UserBirthday = mysqli_real_escape_string($conn, $_REQUEST['birthday']);

            $query = "INSERT INTO user (User_name, User_email, User_password, User_birthdate, User_city, User_first_name, User_last_name)
                            VALUES (?, ?, ?, ?, ?, ?, ?);";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $query)) {
                echo "<script type='text/javascript'>alert('SQL error')</script>";
                echo mysqli_stmt_error($stmt);
            } else {
                if ($UserPassword === $UserConfirmPassword) {
                    if(IsEmailExists > 0){
                        echo "<script type='text/javascript'>alert('Email EXISST!!')</script>";

                    }
                    else {
                        mysqli_stmt_bind_param($stmt, "sssssss", $UserNick, $UserEmail, $UserPassword, $UserBirthday, $UserCity, $UserFirstName, $UserLastName);
                        mysqli_stmt_execute($stmt);
                        mysqli_debug("d:t:o,/tmp/client.trace");
                        $_SESSION['user'] = $UserNick;
                        echo "<meta http-equiv='refresh' content='1;url=index.php?page=home'>";
                    }
                } else {
                    echo "<script type='text/javascript'>alert('Passwords does not match')</script>";
                }
            }
        } else {
            echo "";
        }
    }
}

function IsEmailExists()
{
    if (!empty($_POST['email'])) {
        if (isset($_POST['email'])) {
            $NonExistEmail = $_POST['email'];
            $query = "SELECT * from user where User_email = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $query)) {
                echo "<script type='text/javascript'>alert('SQL error')</script>";
                echo mysqli_stmt_error($stmt);
            } else {
                mysqli_stmt_bind_param($stmt, "s", $NonExistEmail);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($result);
                mysqli_close();
                return (is_array($row) and count($row) > 0);
            }
        }
    } else {
        echo "";
    }
}







