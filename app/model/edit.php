<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/blog/BlogFromScratch/app/lib/connection.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/blog/BlogFromScratch/app/model/edit.php');

if (isset($_POST['functionEdit']) == "edit") {
    $conn = establishConnection();
    $postData = json_decode($_POST['post']);
    $PostTitle = $_POST['title'];
    $PostMessage = $_POST['message'];
    echo $postData;
    $sql = "UPDATE `posts` SET Post_title = ?, Post_message = ? WHERE Post_ID = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "<script type='text/javascript'>alert('SQL statement failed')</script>";
    } else {
        mysqli_stmt_bind_param($stmt, "ssi", $PostTitle, $PostMessage, $postData);
        mysqli_stmt_execute($stmt);
    }
}
