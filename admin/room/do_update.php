<?php
    session_start();
    require_once '../../src/dbutils.php';
    
    if(!isset($_SESSION['loginAdmin'])){
        header("Location: ../log/login.php?errorStr=Please log in");
        exit();
    }

    $id= $_POST["id"];
    $type= $_POST["type"];

    $check = getData("select room_id from book where NOW()<=endTime and room_id='$id'");
    if($check->rowCount()){
        echo "ERROR:This room is using, so can not update";
        exit();
    }


    if(executeStatement("update room set type='$type' where id='$id'")){
        echo "SUCCESS:Room $id is updated";
        exit();
    }else{
        echo "ERROR:Room $id update failed";
    }
?>