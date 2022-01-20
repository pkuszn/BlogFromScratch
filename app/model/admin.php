<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/blog/BlogFromScratch/app/lib/connection.php');

$main_subview =  $_SERVER['DOCUMENT_ROOT'].'/blog/BlogFromScratch/app/view/subview/info.phtml';
if(isset($_POST['admin'])){
    $main_subview = $_SERVER['DOCUMENT_ROOT'].'/blog/BlogFromScratch/app/view/subview/users.phtml';
}
if(isset($_POST['user'])){
    $main_subview = $_SERVER['DOCUMENT_ROOT'].'/blog/BlogFromScratch/app/view/subview/info.phtml';
}
if(isset($_POST['admin'])){
    $main_subview = $_SERVER['DOCUMENT_ROOT'].'/blog/BlogFromScratch/app/view/subview/users.phtml';
}
if(isset($_POST['admin'])){
    $main_subview = $_SERVER['DOCUMENT_ROOT'].'/blog/BlogFromScratch/app/view/subview/users.phtml';
}
if(isset($_POST['admin'])){
    $main_subview = $_SERVER['DOCUMENT_ROOT'].'/blog/BlogFromScratch/app/view/subview/users.phtml';
}


if (isset($_POST['functionName']) == "action") {
    $conn = establishConnection();
    $json = json_decode($_POST['userID']);
    echo $json;
    $sql = "DELETE FROM user WHERE User_ID = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "<script type='text/javascript'>alert('SQL statement failed')</script>";
    } else {
        mysqli_stmt_bind_param($stmt, "i", $json);
        mysqli_stmt_execute($stmt);
    }
}


function getInfoAboutUser($param)
{
    $conn = establishConnection();
    $sql = "SELECT * from user where User_name = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "<script type='text/javascript'>alert('SQL statement failed')</script>";
    } else {
        mysqli_stmt_bind_param($stmt, "s", $param);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['id'] = $row['User_ID'];
            $_SESSION['user'] = $row['User_name'];
            $_SESSION['email'] = $row['User_email'];
            $_SESSION['pass'] = ($row['User_password']);
            $_SESSION['access'] = $row['User_access'];
            $_SESSION['posts'] = $row['User_amount_of_posts'];
            $_SESSION['date-created'] = $row['User_created_date_account'];
            $_SESSION['birth_date'] = $row['User_birthdate'];
            $_SESSION['city'] = $row['User_city'];
            $_SESSION['first_name'] = $row['User_first_name'];
            $_SESSION['last_name'] = $row['User_last_name'];
            $_SESSION['avatar'] = $row['User_Avatar'];
        }
    }
}

function displayUsers(){
    $conn = establishConnection();
    $sql = "SELECT * from user ORDER BY User_created_date_account DESC";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "<script type='text/javascript'>alert('SQL statement failed')</script>";
    }
    else{
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $image = displayImage( $_SERVER['DOCUMENT_ROOT'].'/blog/BlogFromScratch/app/icons/rubbish.png', true);
        while($row = mysqli_fetch_assoc($result)){
            echo  "<img src = 'data:image/png;base64,$image' alt='" . $row['User_ID'] . "' class='userID' '/>" .  "\t" . $row['User_name'] . "\t" . $row['User_email']  . "\t" . $row['User_access']  . "\t" . $row['User_amount_of_posts']  . "\t" . $row['User_created_date_account']  . "\t" . $row['User_birthdate']  . "\t" . $row['User_first_name']  . "\t" . $row['User_last_name'] . "<br>";
            echo "<hr>";
        }
    }
}








?>