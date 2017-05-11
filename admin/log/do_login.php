<?php
    session_start();
    require_once '../../src/dbutils.php';
    $username= $_POST['username'];
    $password= $_POST['password'];
    $password= md5($password);
    $loginAdmin=adminLogin($username, $password);
    if($loginAdmin){
        $_SESSION['loginAdmin']= $loginAdmin;
        header('Location:../index.php');
        exit();
    }else{
        header("Location:login.php?errorStr=You are not admin");
        exit();
    }
?>