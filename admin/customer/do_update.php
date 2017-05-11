<?php
    session_start();
    require_once '../../src/dbutils.php';
    
    if(!isset($_SESSION['loginAdmin'])){
        header("Location: ../log/login.php?errorStr=Please log in");
        exit();
    }

    $id= $_POST["id"];
    $username= $_POST["username"];
    $fullName= $_POST["fullName"];
    $gender= $_POST["gender"];
    $dateOfBirth= $_POST["dateOfBirth"];

    if(usernameIsExist($id, $username)){
        echo "ERROR:$username already exist";
        exit();
    }

    if(executeStatement("update user_acc set username='$username', fullName='$fullName', gender='$gender', dateOfBirth='$dateOfBirth' where id=$id")){
        echo "SUCCESSFUL:Update successful";
        exit();
    }else{
        echo "ERROR:Update failed";
        exit();
    }
?>