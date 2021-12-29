<?php

function establishConnection(){
    $host = "127.0.0.1";
    $user = "root";
    $pass =  "my#@3y17;database";
    $db = "mydb";
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
// Check connection
    if ($conn->connect_error) {
        function function_alert($msg) {
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }
        function_alert("Connection failed");
        die("Connection failed: " . $conn->connect_error);
    }
    $_SESSION['connection-status'] = "Connected successfully";
    return $conn;
}
?>