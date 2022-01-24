<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/blog/BlogFromScratch/app/lib/connection.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/blog/BlogFromScratch/app/model/edit.php');


//if(isset($_POST['functionEdit']) == "edit") {
//    $postID = $_POST['post'];
//    $PostTitle = $_POST['title'];
//    $PostMessage = $_POST['message'];
//    echo $postID . $PostTitle . $PostMessage;
//    echo var_dump($postID) . var_dump($PostTitle) . var_dump($PostMessage);
//    $conn = establishConnection();
//    $sql = "UPDATE `posts` SET Post_title = 'test' WHERE Post_ID = 19";
//    $stmt = mysqli_stmt_init($conn);
//    echo "<script>alert('test')";
//    if (!mysqli_stmt_prepare($stmt, $sql)) {
//        echo "<script type='text/javascript'>alert('SQL statement failed')</script>";
//    } else {
//        mysqli_stmt_execute($stmt);
//        echo "wykonane";
//    }
//}

if (isset($_POST['functionEdit']) == "edit") {
    $conn = establishConnection();
    $postData = json_decode($_POST['post']);
    echo $postData;
    $sql = "UPDATE `posts` SET Post_title = 'test' WHERE Post_ID = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "<script type='text/javascript'>alert('SQL statement failed')</script>";
    } else {
        mysqli_stmt_bind_param($stmt, "i", $postData);
        mysqli_stmt_execute($stmt);
    }
}
