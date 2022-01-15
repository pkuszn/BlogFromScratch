<?php
$_SESSION['pageNow'] = isset($_GET['pagination']) ? $_GET['pagination'] : 1;
include $config['MODEL_PATH'] . 'home.php';

if(isset($_GET['attribute'])){
    $var = $_GET['name'];
}



function filter($param){
    $conn = establishConnection();
    $perPage = 10;
    $entries = getAmountOfEntries($conn, 'posts');
    $_SESSION['amountOfPages'] = calculateArticlesPerPage($entries['COUNT(*)'], $perPage);
    $offset = Offset($_SESSION['pageNow'], $perPage);
    $sql = null;
    if($_POST['']){
        $sql = "select * from posts ORDER BY Post_created_date DESC LIMIT ?, ?;";
    }
    else if($param == 1){
        $sql = "select * from posts ORDER BY Post_created_date ASC LIMIT ?, ?;";
    }
    else if($param == 2){
        $sql = "select * from posts ORDER BY Post_title DESC LIMIT ?, ?;";
    }
    else if($param == 3){
        $sql = "select * from posts ORDER BY Post_title ASC LIMIT ?, ?;";
    }
    else if($param == 4){
        $sql = "select * from posts ORDER BY Post_message DESC LIMIT ?, ?;";
    }
    else if($param == 5){
        $sql = "select * from posts ORDER BY Post_message ASC LIMIT ?, ?;";
    }
    else if($param == 6){
        $sql = "select * from posts ORDER BY Post_created_date ASC LIMIT ?, ?;";
    }
    else if($param == 7){
        $sql = "select * from posts ORDER BY Post_created_date ASC LIMIT ?, ?;";
    }
    else if($param == 8){
        $sql = "select * from posts ORDER BY Post_created_date ASC LIMIT ?, ?;";
    }
    else if($param == 9){
        $sql = "select * from posts ORDER BY Post_created_date ASC LIMIT ?, ?;";
    }
    else if($param == 10){
        $sql = "select * from posts ORDER BY Post_created_date ASC LIMIT ?, ?;";
    }
    else if($param == 11){
        $sql = "select * from posts ORDER BY Post_created_date ASC LIMIT ?, ?;";
    }


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
            echo "<div class='author-info'>";
            echo "<p class='post-author'>" . $PostAuthor . "</p>";
            echo "</hr>";
            echo "<p class='post-date'>" . $PostsCreatedDate . "</p>";
            echo "</div>";
            echo "</div>";
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}




