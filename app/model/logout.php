<?php
session_start();
if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    unset($_SESSION['id']);
    unset($_SESSION['email']);
    unset($_SESSION['pass']);
    unset($_SESSION['access']);
    unset($_SESSION['posts']);
    unset($_SESSION['date-created']);
    unset($_SESSION['birth_date']);
    unset($_SESSION['city']);
    unset($_SESSION['first_name']);
    unset($_SESSION['last_name']);
    unset($_SESSION['avatar']);
}
$message = "Logout...";
sleep(2);
header("location:index.php?page=home");
?>