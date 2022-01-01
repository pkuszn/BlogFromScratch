<?php
require('connection.php');

if (isset($_POST['action'])) {
    select();
}

function foo(){
    echo "dupal";
}
/*
function select()
{
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
        }

        if (isset($PostsTitle) and isset($PostsText) and isset($PostsCreatedDate)) {
            echo "<h2 class='post-header'>" . $PostsTitle . "</h2>";
            echo "<hr>";
            echo "</hr>";
            echo "<p class='post-text'>" . $PostsText . "</p>";
            echo "<p class='post-date''>" . $PostsCreatedDate . "</p>";
        }

    } catch (mysqli_sql_exception $e) {
        echo $e . mysqli_stmt_error($rs);
        $conn . mysqli_rollback($rs);
    }

}
*/

?>