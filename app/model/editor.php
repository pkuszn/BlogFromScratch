<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/app/lib/connection.php');

if (isset($_POST['functionEdit']) == "edit") {
    $postData = json_decode($_POST['post']);
    $conn = establishConnection();
    $PostTitle = $_POST['title'];
    $PostMessage = $_POST['post-message'];
    $sql = "UPDATE posts SET Post_title = ?, Post_message = ? WHERE Post_ID = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "<script type='text/javascript'>alert('SQL statement failed')</script>";
    } else {
        mysqli_stmt_bind_param($stmt, "ssi", $PostTitle, $PostMessage, $postData);
        mysqli_stmt_execute($stmt);
        echo "<meta http-equiv='refresh' content='1;url=index.php?page=home'>";

    }
}

function addNewPost()
{
    if (isset($_POST['submit'])) {
        if (isset($_POST['title']) and isset($_POST['post-message'])) {
            $conn = establishConnection();
            $author = isset($_POST['author']) ? mysqli_real_escape_string($conn, $_REQUEST['author']) : $_SESSION['user'];
            $title = mysqli_real_escape_string($conn, $_REQUEST['title']);
            $post = mysqli_real_escape_string($conn, $_REQUEST['post-message']);
            $query = "INSERT INTO posts (Post_title, Post_message, Post_author) VALUES(?,?,?);";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $query)) {
                echo "<script type='text/javascript'>alert('SQL error')</script>";
                echo mysqli_stmt_error($stmt);
            } else {
                mysqli_stmt_bind_param($stmt, "sss", $title, $post, $author);
                mysqli_stmt_execute($stmt);
                mysqli_debug("d:t:o,/tmp/client.trace");
                echo "<meta http-equiv='refresh' content='1;url=index.php?page=home'>";
            }
        }
    }
}
?>