<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/blog/BlogFromScratch/app/lib/connection.php');

if (isset ($_POST['functionDesc']) == 'selectPost' and isset ($_POST['postID'])) {
    $conn = establishConnection();
    $Post_ID = json_decode($_POST['postID']);
    $query = "Select * from posts where Post_ID = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        echo "<script type='text/javascript'>alert('SQL statement failed!)</script>";
    }
    mysqli_stmt_bind_param($stmt, "i", $Post_ID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        $PostID = $row['Post_ID'];
        $PostsTitle = $row['Post_title'];
        $PostsText = $row['Post_message'];
        $PostsCreatedDate = $row['Post_created_date'];
        $PostAuthor = $row['Post_Author'];
        echo "<div class='card'>";
        echo "<h2 class='post-header'>" . $PostsTitle . "</h2>";
        echo "<hr>";
        echo "</hr>";
        echo "<p class='post-text'>" . $PostsText . "</p>";
        echo "<div class='author-container'>";
        echo "<div class='author-info'>";
        echo "<p class='post-author'>" . "<b>" . $PostAuthor . "</b>" . "</p>";
        echo "<p class='post-date'>" . $PostsCreatedDate . "</p>";
        echo "</div>";
    }
}

if (isset ($_POST['functioDesc']) == "searchPost") {
    $input = json_decode($_POST['searchInput']);
    echo "<script>alert(" . $input . ")</script>";
    $conn = establishConnection();
    $sql = "select * from posts WHERE Post_title = ? OR Post_message = ? OR Post_author = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "<script type='text/javascript'>alert('SQL error')</script>";
    } else {
        mysqli_stmt_bind_param($stmt, "s", $input);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $PostsTitle = $row['Post_title'];
            $PostsText = $row['Post_message'];
            $PostsCreatedDate = $row['Post_created_date'];
            $PostAuthor = $row['Post_Author'];
            echo "<div class='card'>";
            echo "<h2 class='post-header'>" . $PostsTitle . "</h2>";
            echo "<hr>";
            echo "</hr>";
            echo "<p class='post-text'>" . $PostsText . "</p>";
            echo "<div class='author-info'>";
            echo "<p class='post-author'>" . $PostAuthor . "</p>";
            echo "</hr>";
            echo "<p class='post-date'>" . $PostsCreatedDate . "</p>";
            echo "</div>";
            echo "<div class='commentary'>";

            echo "</div>";
            echo "</div>";

        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}