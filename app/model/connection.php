<?php

function establishConnection(){
    define('HOST', '127.0.0.1');
    define('DATABASE', 'mydb');
    define('USER', 'root');
    define('PASS', 'my#@3y17;database');
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $conn = new mysqli(HOST, USER, PASS, DATABASE);

// Check connection
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $_SESSION['connection-status'] = "Connected successfully";
    return $conn;
}







?>