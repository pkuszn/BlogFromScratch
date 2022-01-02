<?php
require ("connection.php");
$_SESSION['pageNow'] = isset($_GET['pagination']) ? $_GET['pagination'] : 1;


function selectPosts()
{
    $conn = establishConnection();
    $perPage = 10;
    $entries = getAmountOfEntries($conn, 'posts');
    $_SESSION['amountOfPages'] = calculateArticlesPerPage($entries['COUNT(*)'], $perPage);
    $offset = Offset($_SESSION['pageNow'], $perPage);

    //echo $perPage;
    try {
        //0 - OFFSET
        //1 - ROW COUNT
        $sql = "select * from posts ORDER BY Post_ID DESC LIMIT ?, ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "<script type='text/javascript'>alert('SQL error')</script>";
        } else {
            mysqli_stmt_bind_param($stmt, "ii", $offset, $perPage);
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
                echo "<p class='post-author' class='right-corner'>" . $PostAuthor . "</p>";
                echo "</hr>";
                echo "<p class='post-date' class='right-corner'>" . $PostsCreatedDate . "</p>";
                echo "</div>";
            }
        }
    } catch
    (mysqli_sql_exception $e) {
        echo $e . mysqli_stmt_error($result);
        $conn . mysqli_rollback($result);
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