<?php

function IsExist($login, $pass){
    $pass = sha1($pass);
    include("Connection.php");
    $conn = establishConnection();
    $stmt = "";
    try{
        $stmt = mysqli_stmt_init($conn);
        $query = "
        SELECT 
            CASE WHEN EXISTS
            (
                SELECT * FROM user WHERE User_name = ?
            )
            THEN 'TRUE'
            ELSE 'FALSE'
        END";

        $stmt = mysqli_stmt_prepare($stmt, $query);
        if(!mysqli_stmt_prepare($stmt, $query)){
            echo "SQL statement failed";
            return false;
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $login);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            while($row = mysqli_fetch_assoc($result)){
                echo $row['User_name'] . "<br>";
                return $row['User_name'];
            }
        }
    }
    catch(mysqli_sql_exception $ex){
        echo $ex.mysqli_stmt_error($stmt);
        return false;
    }
}

function emailValidation($param1){
    $value = preg_match('/^([a-z|A-Z|0-9]{4,22})@([a-z|A-Z|0-9]{2,12})\\.(pl|com)$/', $param1);
    if($value) {
        return true;
    }
    else {
        return false;
    }
}

function arePasswordsEquals($password, $confirmPassword){
    if(strcmp($password, $confirmPassword) == 0){
        return true;
    }
    else{
        return false;
    }
}

function birthdayValidation($birthday){
    $value = preg_match('^(?:(?:1[6-9]|[2-9]\d)?\d{2})(?:(?:(\/|-|\.)(?:0?[13578]|1[02])\1(?:31))|(?:(\/|-|\.)(?:0?[13-9]|1[0-2])\2(?:29|30)))$|
^(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00)))(\/|-|\.)0?2\3(?:29)$|
^(?:(?:1[6-9]|[2-9]\d)?\d{2})(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:0?[1-9]|1\d|2[0-8])$', $birthday);
if($value){
    return true;
}
else{
    return false;
}
}



?>