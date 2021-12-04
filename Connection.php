<?php

function establishConnection(){
    $host = "localhost";
    $user = "root";
    $pass = "123456";
    $db = "mydb";
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $conn = mysqli_connect($host,$user,$pass, $db);

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