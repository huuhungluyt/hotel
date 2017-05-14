<?php
    session_start();
    require_once "../src/dbutils.php";

    $username = $_POST["regis_username"];
    $password = $_POST["regis_password"];
    $password = md5($password);
    $fullname = $_POST["regis_fullname"];
    $gender = $_POST["regis_gender"];
    $dateOfBirth = $_POST["regis_dateOfBirth"];

    if(usernameIsExist($id, $username)){
        echo "ERROR:$username already exist";
        exit();
    }

    if(executeStatement("insert into user_acc values ('0','$username','$password', '$fullname', '$gender', '$dateOfBirth')")){
        echo "SUCCESS:Register successfully!";
        exit();
    } else {
        echo "ERROR: Register fail!";
        exit();
    }

?>