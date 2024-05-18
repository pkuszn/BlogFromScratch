<?php

function establishConnection()
{
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $config = include($_SERVER['DOCUMENT_ROOT'].'/app/config/consts.php');
    $conn = new mysqli($config['host'], $config['user'], $config['password'], $config['db']);
    // Check connection
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $_SESSION['connection-status'] = "Connected successfully";
    return $conn;
}
?>
