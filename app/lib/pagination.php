<?php

function getAmountOfEntries($conn, $param)
{
    try {
        $sql = null;
        switch ($param) {
            case 'posts':
                $sql = "SELECT COUNT(*) from posts";
                break;
            case 'user':
                $sql = "SELECT COUNT(*) from user";
                break;
        }
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "<script type='text/javascript'>alert('SQL error')</script>";
        } else {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            return $row;
        }
    } catch (mysqli_sql_exception $e) {
        echo "<script type='text/javascript'>alert('Failed to get info about numbers of $param')</script>";
        $conn . mysqli_rollback($conn);
    }
}

function calculateArticlesPerPage($entries, $perPage)
{
    $totalPages = ceil($entries / $perPage);
    return $totalPages;
}

function Offset($pageNow, $perPage){
    $offset = ($pageNow - 1) * $perPage;
    return $offset;
}

?>