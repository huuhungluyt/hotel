<?php
    session_start();
    require_once '../src/dbutils.php';
    $username= $_POST['user'];
    $password= $_POST['pass'];
    $password= md5($password);
    $loginUser=loginUser($username, $password);
    if($loginUser){
        $_SESSION['loginUser']= $loginUser;
        header('Location:index.php');
        exit();
    }else{
        header("Location:index.php?errorStr=You are not customer");
        exit();
    }
?>