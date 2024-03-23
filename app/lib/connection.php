<?php

function establishConnection()
{
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $conn = new mysqli('127.0.0.1', 'root', 'my#@3y17;database', 'mydb');
    // Check connection
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $_SESSION['connection-status'] = "Connected successfully";
    return $conn;
}
?>