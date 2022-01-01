<?php
if(isset($_SESSION['user'])){
    $_SESSION['test'] = "ciula";
    getInfoAboutUser($_SESSION['user']);
}

//User_ID	User_name	User_email	User_password	User_amount_of_posts	User_created_date_account	User_birthdate	User_city	User_avatar	User_first_name	User_last_name	Images_Images_ID	Statistics_Statistics_ID
function IsExist()
{
    if (isset($_POST['submit']) and $_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['login']) and !empty($_POST['login'])) {
            require('connection.php');
            $conn = establishConnection();
            $login = $_POST['login'];
            $password = $_POST['password'];
            $sql = "SELECT User_password from user where User_name = ?;";
            //Create a prepared statement
            $stmt = mysqli_stmt_init($conn);
            //Prepare the prepared statement
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "<script type='text/javascript'>alert('SQL statement failed')</script>";
            } else {
                //bind parameters to the placeholder
                mysqli_stmt_bind_param($stmt, "s", $login);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while ($row = mysqli_fetch_assoc($result)) {
                    if($password !== $row['User_password']){
                        echo $password;
                        echo $row['User_password'];
                        echo "<script type='text/javascript'>alert('Password is invalid')</script>";
                    }
                    else{
                        echo "<meta http-equiv='refresh' content='1;url=index.php?page=home'>";
                        $_SESSION['user'] = $login;
                    }
                }
            }
        }
    }
}

function redirectIfLogged()
{
    if (isset($_POST['submit'])) {
        echo "Logged in: ";
        echo $_SESSION['user'];
        sleep(2);
        header("Location: ../index.php");
    }
}




?>