<?php

// SQL Statements
//Link this statement with AJAX execute
require ("connection.php");

function checkCaptcha(){
    $response = false;
    if (isset($_POST['code'])) {
        if ($_POST['code'] == $_SESSION['captcha']) {
            $response = true;
            return $response;
            $_SESSION['user'] = $_POST['nickname'];
        } else {
            return $response;
        }
    }
    $_SESSION['captcha'] = mt_rand(10000, 99999);
}







function registerProcess(){
    if (isset($_POST['submit']) AND $_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['nickname']) and isset($_POST['email']) and isset($_POST['password']) and isset($_POST['confirmpassword'])) {
            try {
                $conn = establishConnection();
//User_ID	User_name	User_email	User_password	User_amount_of_posts	User_created_date_account	User_birthdate	User_city	User_avatar	User_first_name	User_last_name	Images_Images_ID	Statistics_Statistics_ID
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
                    if($UserPassword === $UserConfirmPassword){
                        mysqli_stmt_bind_param($stmt, "sssssss", $UserNick, $UserEmail, $UserPassword, $UserBirthday, $UserCity, $UserFirstName, $UserLastName);
                        mysqli_stmt_execute($stmt);
                        mysqli_debug("d:t:o,/tmp/client.trace");
                        $_SESSION['user'] = $UserNick;
                        echo "<meta http-equiv='refresh' content='1;url=index.php?page=home'>";
                    }
                    else{
                        echo "<script type='text/javascript'>alert('Passwords does not match')</script>";
                    }
                }
            } catch (mysqli_sql_exception $e) {
                echo "<script type='text/javascript'>alert('Failed to register user')</script>";
                $conn . mysqli_rollback($conn);
            }
        }
    } else {
        echo "";
    }
}

function IsEmailExists(){
    if(!empty($_POST['email'])){
        if(isset($_POST['email'])){
            try{
                $NonExistEmail = $_POST['email'];
                $conn = establishConnection();
                $query = "SELECT * from user where User_email = ?";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $query)){
                    echo "<script type='text/javascript'>alert('SQL error')</script>";
                    echo mysqli_stmt_error($stmt);
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $NonExistEmail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $row = mysqli_fetch_assoc($result);
                    return (is_array($row) and count($row) > 0);
                }
            } catch (mysqli_sql_exception $e) {
                echo "<script type='text/javascript'>alert('Failed to find user' + $e)</script>";
                mysqli_rollback($conn);
            }
        }
   }
   else{
       echo "";
   }
}






