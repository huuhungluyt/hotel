<?php
    session_start();
    require_once "../../src/dbutils.php";

    if(!isset($_SESSION['loginAdmin'])){
        header("Location: ../log/login.php?errorStr=Please log in");
        exit();
    }

    $type= $_POST["type"];

    $check = getData("select type from room where id in (select room_id from book where state<>'checked out') and type='$type'");
    if($check->rowCount()){
        echo "ERROR:This room type is using, so can not delete";
        exit();
    }

    if(executeStatement("delete from book where room_id in (select id from room where type='$type')")){
        if(executeStatement("delete from room where type='$type'")){
            if(executeStatement("delete from room_type where type='$type'")){
                echo "SUCCESS:Room type $type was deleted";
                exit();
            }
            else{
                echo "ERROR:Room type $type can not delete";
                exit();
            }
        }
    }
    
?>