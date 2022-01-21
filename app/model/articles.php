<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/blog/BlogFromScratch/app/lib/connection.php');
$_SESSION['pageNow'] = isset($_GET['pagination']) ? $_GET['pagination'] : 1;

if(isset($_POST['functionDelete']) == "delete"){
    $conn = establishConnection();
    $postData = json_decode($_POST['post']);
    echo $postData;
    $sql = "DELETE FROM posts WHERE Post_ID = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "<script type='text/javascript'>alert('SQL statement failed')</script>";
    } else {
        mysqli_stmt_bind_param($stmt, "i", $postData);
        mysqli_stmt_execute($stmt);
    }
}

if(isset($_POST['search'])){
    if(!empty($_POST['search'])){

    }
}

function filter()
{
    $conn = establishConnection();
    $perPage = 10;
    $entries = getAmountOfEntries($conn, 'posts');
    $_SESSION['amountOfPages'] = calculateArticlesPerPage($entries['COUNT(*)'], $perPage);
    $offset = Offset($_SESSION['pageNow'], $perPage);
    $sql = "select * from posts ORDER BY Post_created_date DESC LIMIT ?, ?;";

    if (isset($_POST['name'])) {
        $sql = "select * from posts ORDER BY Post_author ASC LIMIT ?, ?;";
    } else if (isset($_POST['date'])) {
        $sql = "select * from posts ORDER BY Post_created_date ASC LIMIT ?, ?;";
    } else if (isset($_POST['alphabetic'])) {
        $sql = "select * from posts ORDER BY Post_message ASC LIMIT ?, ?;";
    } else if (isset($_POST['date'])) {
        $sql = "select * from posts ORDER BY Post_created_date ASC LIMIT ?, ?;";
    }
//    }
//    else if($param == 1){
//        $sql = "select * from posts ORDER BY Post_created_date ASC LIMIT ?, ?;";
//    }
//    else if($param == 2){
//    }
//    else if($param == 3){
//        $sql = "select * from posts ORDER BY Post_title ASC LIMIT ?, ?;";
//    }
//    else if($param == 4){
//        $sql = "select * from posts ORDER BY Post_message DESC LIMIT ?, ?;";
//    }
//    else if($param == 5){
//        $sql = "select * from posts ORDER BY Post_message ASC LIMIT ?, ?;";
//    }
//    else if($param == 6){
//        $sql = "select * from posts ORDER BY Post_created_date ASC LIMIT ?, ?;";
//    }
//    else if($param == 7){
//        $sql = "select * from posts ORDER BY Post_created_date ASC LIMIT ?, ?;";
//    }
//    else if($param == 8){
//        $sql = "select * from posts ORDER BY Post_created_date ASC LIMIT ?, ?;";
//    }
//    else if($param == 9){
//        $sql = "select * from posts ORDER BY Post_created_date ASC LIMIT ?, ?;";
//    }
//    else if($param == 10){
//        $sql = "select * from posts ORDER BY Post_created_date ASC LIMIT ?, ?;";
//    }
//    else if($param == 11){
//        $sql = "select * from posts ORDER BY Post_created_date ASC LIMIT ?, ?;";
//    }


    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "<script type='text/javascript'>alert('SQL error')</script>";
    } else {
        mysqli_stmt_bind_param($stmt, "ii", $offset, $perPage);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $PostID = $row['Post_ID'];
            $PostsTitle = $row['Post_title'];
            $PostsText = $row['Post_message'];
            $PostsCreatedDate = $row['Post_created_date'];
            $PostAuthor = $row['Post_Author'];
            echo "<div class='card'>";
            $image = (isset($_SESSION['access']) == "admin") ? displayImage($_SERVER['DOCUMENT_ROOT'] . '/blog/BlogFromScratch/app/icons/delete.png', true) : "";
            echo "<img src = 'data:image/png;base64,$image' alt='$PostID' id='post-tools' class='delete-tool'/>";
            $image2 = (isset($_SESSION['access']) == "admin") ? displayImage($_SERVER['DOCUMENT_ROOT'] . '/blog/BlogFromScratch/app/icons/edit.png', true) : "";
            echo "<img src = 'data:image/png;base64,$image2' alt='$PostID' id='post-tools' class='edit-tool'/>";
            echo "<h2 class='post-header'>" . $PostsTitle . "</h2>";
            echo "<hr>";
            echo "</hr>";
            echo "<p class='post-text'>" . $PostsText . "</p>";
            echo "<div class='author-info'>";
            echo "<p class='post-author'>" . $PostAuthor . "</p>";
            echo "</hr>";
            echo "<p class='post-date'>" . $PostsCreatedDate . "</p>";
            echo "<br>";
            echo "</div>";
            echo "</div>";
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}




