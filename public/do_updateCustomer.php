<?php
    session_start();
    require_once '../src/dbutils.php';

    $id= $_POST["idUp"];
    $username= $_POST["usernameUp"];
    $password= $_POST["passwordUp"];
    $fullname= $_POST["fullnameUp"];
    $gender= $_POST["genderUp"];
    $dateOfBirth= $_POST["dateOfBirthUp"];

    //update session
    $obj= new Object();
    $obj->__set("id",$id);
    $obj->__set("username",$username);
    $obj->__set("password",$password);
    $obj->__set("fullName",$fullname);
    $obj->__set("gender",$gender);
    $obj->__set("dateOfBirth",$dateOfBirth);
    $_SESSION['loginUser'] = $obj;
    // header('Location:index.php');
     if(executeStatement("update user_acc set username='$username',password='$password', fullName='$fullname', gender='$gender', dateOfBirth='$dateOfBirth' where id=$id")){
        echo "SUCCESS:Update successful:".htmlspecialchars($obj->cols["fullName"]);
        exit();
    }else{
        echo "ERROR:Update failed";
        exit();
    }

?>