<?php
function getInfoAboutUser($param)
{
    $conn = establishConnection();
    $sql = "SELECT * from user where User_name = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "<script type='text/javascript'>alert('SQL statement failed')</script>";
    } else {
        mysqli_stmt_bind_param($stmt, "s", $param);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['id'] = $row['User_ID'];
            $_SESSION['user'] = $row['User_name'];
            $_SESSION['email'] = $row['User_email'];
            $_SESSION['pass'] = ($row['User_password']);
            $_SESSION['access'] = $row['User_access'];
            $_SESSION['posts'] = $row['User_amount_of_posts'];
            $_SESSION['date-created'] = $row['User_created_date_account'];
            $_SESSION['birth_date'] = $row['User_birthdate'];
            $_SESSION['city'] = $row['User_city'];
            $_SESSION['first_name'] = $row['User_first_name'];
            $_SESSION['last_name'] = $row['User_last_name'];
            $_SESSION['avatar'] = $row['User_Avatar'];
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>