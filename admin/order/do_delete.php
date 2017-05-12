<?php
    session_start();
    require_once "../../src/dbutils.php";

    if(!isset($_SESSION['loginAdmin'])){
        header("Location: ../log/login.php?errorStr=Please log in");
        exit();
    }

    $id= $_POST["id"];

    $check = getData("select user_id from book where NOW()<=endTime and user_id='$id'");
    if($check->rowCount()){
        echo "ERROR:This user is using or booked room, so can not delete";
        exit();
    }

    executeStatement("delete from book where user_id=$id");
    if(executeStatement("delete from user_acc where id=$id")){
        echo "SUCCESS:User $id was deleted";
        exit();
    }
    else{
        echo "ERROR:User $id can not delete";
    }
?>