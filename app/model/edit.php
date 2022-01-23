<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/blog/BlogFromScratch/app/lib/connection.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/blog/BlogFromScratch/app/model/edit.php');


if(isset($_POST['functionEdit']) == "edit"){
    $postID = $_POST['post'];
    echo $postID;
    $conn = establishConnection();
    $PostTitle = $_POST['edit-title'];
    $PostMessage = $_POST['edit-message'];
    $sql = "UPDATE posts SET Post_title = ?, Post_message = ? WHERE Post_ID = ?";
    $stmt = mysqli_stmt_init($conn);
    echo "<script>alert('test')";
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "<script type='text/javascript'>alert('SQL statement failed')</script>";
    } else {
        mysqli_stmt_bind_param($stmt, "ssi", $PostTitle, $PostMessage, $postData);
        mysqli_stmt_execute($stmt);
        echo "<meta http-equiv='refresh' content='1;url=index.php?page=home'>";

    }
}
