<?php
session_start();
if(isset($_SESSION['user'])){
    unset($_SESSION['user']);
}
$message = "Logout...";
sleep(2);
header("location:index.php?page=home");
?>