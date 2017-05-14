<?php
    session_start();
    require_once '../../src/dbutils.php';
    
    if(!isset($_SESSION['loginAdmin'])){
        header("Location: ../log/login.php?errorStr=Please log in");
        exit();
    }

    $roomType= $_POST["roomType"];
    $updateMaxPeople= $_POST["updateMaxPeople"];
    $updateNumOfBeds= $_POST["updateNumOfBeds"];
    $updateFood= $_POST["updateFood"];
    $updateHourPrice= $_POST["updateHourPrice"];
    $updateDayPrice= $_POST["updateDayPrice"];
    $updateUnitPrice= $_POST["updateUnitPrice"];
    $updateImage= $_POST["updateImage"];

    $check = getData("select type from room where id in (select room_id from book where state<>'checked out') and type='$roomType'");
    if($check->rowCount()){
        echo "ERROR:This room type is using, so can not update";
        exit();
    }


    if(executeStatement("update room_type set maxPeople=$updateMaxPeople, numOfBeds=$updateNumOfBeds, food='$updateFood', hourPrice=$updateHourPrice, dayPrice=$updateDayPrice, price=$updateUnitPrice, image='$updateImage' where type='$roomType'")){
        echo "SUCCESS:Room type $roomType is updated";
        exit();
    }else{
        echo "ERROR:Room type $roomType update failed";
    }
?>