<?php
$_SESSION['pageNow'] = isset($_GET['pagination']) ? $_GET['pagination'] : 1;
require_once($_SERVER['DOCUMENT_ROOT'] . '/blog/BlogFromScratch/app/lib/connection.php');
//
//if (isset($_POST['functionName']) == "action") {
//    $input = json_decode($_POST['post']);
//    echo "<script>alert(" . $input . ")</script>";
//    $conn = establishConnection();
//    echo "<meta http-equiv='refresh' content='1;url=index.php?page=articles'>";
//    $sql = "select * from posts WHERE Post_title = ? OR Post_message = ? OR Post_author = ?;";
//    $stmt = mysqli_stmt_init($conn);
//    if (!mysqli_stmt_prepare($stmt, $sql)) {
//        echo "<script type='text/javascript'>alert('SQL error')</script>";
//    } else {
//        mysqli_stmt_bind_param($stmt, "s", $input);
//        mysqli_stmt_execute($stmt);
//        $result = mysqli_stmt_get_result($stmt);
//        while ($row = mysqli_fetch_assoc($result)) {
//            $PostsTitle = $row['Post_title'];
//            $PostsText = $row['Post_message'];
//            $PostsCreatedDate = $row['Post_created_date'];
//            $PostAuthor = $row['Post_Author'];
//            echo "<div class='card'>";
//            echo "<h2 class='post-header'>" . $PostsTitle . "</h2>";
//            echo "<hr>";
//            echo "</hr>";
//            echo "<p class='post-text'>" . $PostsText . "</p>";
//            echo "<div class='author-info'>";
//            echo "<p class='post-author'>" . $PostAuthor . "</p>";
//            echo "</hr>";
//            echo "<p class='post-date'>" . $PostsCreatedDate . "</p>";
//            echo "</div>";
//            echo "<div class='commentary'>";
//
//            echo "</div>";
//            echo "</div>";
//
//        }
//    }
//    mysqli_stmt_close($stmt);
//    mysqli_close($conn);
//}


$result = "";
if (isset($_POST['functionName']) == 'equation')  {
        echo ("<script>alert('test')</script>");

        $A = intval(json_decode($_POST['a']));
        $B = intval(json_decode($_POST['b']));
        $C = intval(json_decode($_POST['c']));
        var_dump($C);
        echo ($a .  $b . $c);
        echo ("<script>alert('test')</script>");
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


if (isset($_POST['functionName']) == 'insertComments'){
    $conn = establishConnection();
    $CommentAuthor = isset($_POST['author']) ? $_POST['author'] : null;
    $CommentText = isset($_POST['message']) ? $_POST['message'] : null;
    $PostID = isset($_POST['postID']) ? json_decode($_POST['postID']) : null;
    echo $PostID . "<br>" . $CommentAuthor . "<br>" . $CommentText;
    $query = "INSERT INTO comment (Comment_text, Comment_author, Post_ID) VALUES (?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        echo "<script type='text/javascript'>alert('SQL statement failed!)</script>";
    } else {
        mysqli_stmt_bind_param($stmt, "ssi", $CommentText, $CommentAuthor, $PostID);
        mysqli_stmt_execute($stmt);
        echo "podwojnie";
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
            $PostAuthor = $row['Post_Author'];
            echo "<div class='card'>";
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
                            echo "<form method='POST'>";
                                echo "<div class='commentary'>";
            require_once($_SERVER['DOCUMENT_ROOT'] . '/blog/BlogFromScratch/app/model/comment.php');

            showComments($PostID);
                                    require($_SERVER['DOCUMENT_ROOT'] . '/blog/BlogFromScratch/app/view/comment.phtml');
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
    if (isset($_POST['add'])) {
        if (isset($_POST['title']) and isset($_POST['post'])) {

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
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
    }

}

