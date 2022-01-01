<?php
$title = "siema byku ;)";

require ("connection.php");
function selectPosts() {
$conn = establishConnection();
    try {
        $PostsTitle = "";
        $PostsText = "";
        $PostsCreatedDate = "";
        $sql = "select * from posts";
        $rs = mysqli_query($conn, $sql);

        while ($row = $rs->fetch_assoc()) {
            $PostsTitle = $row['Post_title'];
            $PostsText = $row['Post_message'];
            $PostsCreatedDate = $row['Post_created_date'];
            $PostAuthor = $row['Post_Author'];
        }

        if (isset($PostsTitle) and isset($PostsText) and isset($PostsCreatedDate)) {
            echo "<h2 class='post-header'>" . $PostsTitle . "</h2>";
            echo "<hr>";
            echo "</hr>";
            echo "<p class='post-text'>" . $PostsText . "</p>";
            echo "<p class='post-author' class='right-corner'>"  . $PostAuthor .   "</p>";
            echo "</hr>";
            echo "<p class='post-date' class='right-corner'>"  . $PostsCreatedDate .   "</p>";
        }

    } catch (mysqli_sql_exception $e) {
        echo $e . mysqli_stmt_error($rs);
        $conn . mysqli_rollback($rs);
    }
}


function addNewPost()
{
    if (isset($_POST['add'])) {
        if (isset($_POST['title']) and isset($_POST['post'])) {
            try {
                $conn = establishConnection();
                $author = isset($_POST['author']) ? mysqli_real_escape_string($conn, $_REQUEST['author']) : null;
                $title = mysqli_real_escape_string($conn, $_REQUEST['title']);
                $post = mysqli_real_escape_string($conn, $_REQUEST['post']);
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

            } catch (mysqli_sql_exception $e) {
                echo "<script type='text/javascript'>alert('SQL statement failed')</script>";
            }
        } else {
            echo 'Create a new post';
        }
    }
}