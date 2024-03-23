<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/blog/BlogFromScratch/app/lib/connection.php');

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
    $sql = "select * from posts ORDER BY Post_created_date DESC;";

    if (isset($_POST['name'])) {
        $sql = "select * from posts ORDER BY Post_author ASC;";
    } else if (isset($_POST['date'])) {
        $sql = "select * from posts ORDER BY Post_created_date ASC;";
    } else if (isset($_POST['alphabetic'])) {
        $sql = "select * from posts ORDER BY Post_message ASC";
    } else if (isset($_POST['date'])) {
        $sql = "select * from posts ORDER BY Post_created_date ASC;";
    }

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "<script type='text/javascript'>alert('SQL error')</script>";
    } else {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $PostID = $row['Post_ID'];
            $PostsTitle = $row['Post_title'];
            $PostsText = $row['Post_message'];
            $PostsCreatedDate = $row['Post_created_date'];
            $PostAuthor = $row['Post_Author'];
            echo "<div class='card'>";
            $imageDelete = displayImage($_SERVER['DOCUMENT_ROOT'] . '/blog/BlogFromScratch/app/icons/delete.png', true);
            $imageEdit = displayImage($_SERVER['DOCUMENT_ROOT'] . '/blog/BlogFromScratch/app/icons/edit.png', true);
            $action = (isset($_SESSION['access']) == "admin") ? "<img src = 'data:image/png;base64,$imageDelete' alt='$PostID' id='post-tools' class='delete-tool'/>" : "";
            $action2 =  (isset($_SESSION['access']) == "admin") ? "<img src = 'data:image/png;base64,$imageEdit' alt='$PostID' id='post-tools' name='edit-button' class='edit-tool'/>" : "";
            echo $action;
            echo $action2;
            echo "<h2 class='post-header'>" . $PostsTitle . "</h2>";
            echo "<hr>";
            echo "</hr>";
            echo "<p class='post-text'>" . $PostsText . "</p>";
            echo "<div class='author-container'>";
            echo "<div class='author-info'>";
                echo "<p class='post-author'>" . "<b>". $PostAuthor . "</b>" . "</p>";
                echo "<p class='post-date'>" . $PostsCreatedDate . "</p>";
            echo "</div>";
            echo "<h4 style='text-align:left;margin: 20px;' >Comments</h4>";
            echo "<div class='commentbtn-container'>";
                echo "<div class='commentbtn'>";
                        echo "<div class='commentary'>";
                        require_once($_SERVER['DOCUMENT_ROOT'] . '/blog/BlogFromScratch/app/model/comment.php');
                        showComments($PostID);
                        require($_SERVER['DOCUMENT_ROOT'] . '/blog/BlogFromScratch/app/view/comment.phtml');
                        echo "</div>";
                 echo "</div>";
            echo "<div class='edit-container'>";
                require($_SERVER['DOCUMENT_ROOT'] . '/blog/BlogFromScratch/app/view/edit.phtml');
            echo "</div>";
            echo "</div>";

            echo "</div>";
            echo "</div>";
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}