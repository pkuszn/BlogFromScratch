<?php
$_SESSION['pageNow'] = isset ($_GET['pagination']) ? $_GET['pagination'] : 1;
require_once ($_SERVER['DOCUMENT_ROOT'] . '/app/lib/connection.php');

function displayLastEightArticles()
{
    $conn = establishConnection();
    $query = "Select Post_ID, Post_title from posts ORDER BY Post_created_date LIMIT 0,8";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        echo "<script type='text/javascript'>alert('SQL statement failed!)</script>";
    } else {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='title-post'>";
            $image = displayImage($_SERVER['DOCUMENT_ROOT'] . '/app/icons/click.png', true);
            $Post_ID = $row['Post_ID'];
            echo "<img src = 'data:image/png;base64,$image' class='image-title' alt='$Post_ID'/>" . "<p class='title'>" . $row['Post_title'] . "</p>";
            echo "</div>";
        }
    }
}

if (isset ($_POST['equation']) == 'equation') {
    $A = isset ($_POST['A']) ? intval(json_decode($_POST['A'])) : null;
    $B = isset ($_POST['B']) ? intval(json_decode($_POST['B'])) : null;
    $C = isset ($_POST['C']) ? intval(json_decode($_POST['C'])) : null;
    // a*x^2 + b * x + c
    $x1 = 0;
    $x2 = 0;
    $delta = ($B * $B) - 4 * $A * $C;

    if ($delta < 0) {
        echo "No answer";
    } else if ($delta == 0) {
        $x1 = -$B / (2 * $A);
        echo "The equation has one solution: " . $x1;
    } else if ($delta > 0) {
        $x1 = (-$B - (sqrt($delta))) / (2 * $A);
        $x2 = (-$B + (sqrt($delta))) / (2 * $A);
        echo "The equation has two solutions: " . "x1: " . $x1 . " x2: " . $x2;
    }
}

if (isset ($_POST['functionName']) == 'insertComments') {
    $conn = establishConnection();
    $CommentAuthor = isset ($_POST['author']) ? $_POST['author'] : null;
    $CommentText = isset ($_POST['message']) ? $_POST['message'] : null;
    $PostID = isset ($_POST['postID']) ? json_decode($_POST['postID']) : null;
    echo $PostID . "<br>" . $CommentAuthor . "<br>" . $CommentText;
    if ($CommentAuthor == null or $CommentText == null) {
        echo "<script type='text/javascript'>alert('Input cannot be empty!)</script>";
    } else {
        $query = "INSERT INTO comment (Comment_text, Comment_author, Post_ID) VALUES (?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $query)) {
            echo "<script type='text/javascript'>alert('SQL statement failed!)</script>";
        } else {
            mysqli_stmt_bind_param($stmt, "ssi", $CommentText, $CommentAuthor, $PostID);
            mysqli_stmt_execute($stmt);
        }
    }
}

function selectPosts()
{
    $conn = establishConnection();
    $perPage = 10;
    $entries = getAmountOfEntries($conn, 'posts');
    $_SESSION['amountOfPages'] = calculateArticlesPerPage($entries['COUNT(*)'], $perPage);
    $offset = Offset($_SESSION['pageNow'], $perPage);

    //echo $perPage;

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
            $PostID = $row['Post_ID'];
            $PostsTitle = $row['Post_title'];
            $PostsText = $row['Post_message'];
            $PostsCreatedDate = $row['Post_created_date'];
            $PostAuthor = $row['Post_author'];
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
            echo "<h4 style='text-align:left;margin: 20px;' >Comments</h4>";
            echo "<div class='commentbtn-container'>";
            echo "<div class='commentbtn'>";
            echo "<form method='POST'>";
            echo "<div class='commentary'>";
            require_once ($_SERVER['DOCUMENT_ROOT'] . '/app/model/comment.php');
            showComments($PostID);
            require ($_SERVER['DOCUMENT_ROOT'] . '/app/view/comment.phtml');
            echo "</div>";
            echo "</form>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

function addNewPost()
{
    if (isset ($_POST['add'])) {
        if (isset ($_POST['title']) and isset ($_POST['post'])) {

            $conn = establishConnection();
            $author = isset ($_POST['author']) ? mysqli_real_escape_string($conn, $_REQUEST['author']) : null;
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
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
    }
}