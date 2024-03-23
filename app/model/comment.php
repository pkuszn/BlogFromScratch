<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/blog/BlogFromScratch/app/lib/connection.php');

function showComments($PostID){
    $conn = establishConnection();
    $query = "Select * from comment where Post_ID = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $query)){
        echo "<script type='text/javascript'>alert('SQL statement failed!)</script>";
    }
    else{
        mysqli_stmt_bind_param($stmt, "i", $PostID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($result)){
            echo "<div class='user-comment-container'>";
                echo "<div class='user-avatar-container'>";
                    displayImage($_SERVER['DOCUMENT_ROOT'].'/blog/BlogFromScratch/app/icons/user-comment.png', false);
                echo "</div>";
                echo "<div class='user-text-container'>";
                     echo $row['Comment_date_created'] . "\t" . "<b>" . $row['Comment_author'] . "</b>" . "\t" . ' says: ';
                    echo "<div class='user-comment'>";
                        echo $row['Comment_text'] . "\t";
                     echo "</div>";
                echo "</div>";
            echo "</div>";
        }
    }
}