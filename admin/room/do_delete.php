<?php
    session_start();
    require_once "../../src/dbutils.php";

    if(!isset($_SESSION['loginAdmin'])){
        header("Location: ../log/login.php?errorStr=Please log in");
        exit();
    }

    $id= $_POST["id"];

    $check = getData("select room_id from book where state<>'checked out' and room_id='$id'");
    if($check->rowCount()){
        echo "ERROR:This room is using or is booked, so can not delete";
        exit();
    }

    executeStatement("delete from book where room_id=$id");
    if(executeStatement("delete from room where id=$id")){
        echo "SUCCESS:Room $id was deleted";
        exit();
    }
    else{
        echo "ERROR: Room $id can not delete";
        exit();
    }
?>