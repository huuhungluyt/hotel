<?php
    session_start();
    require_once "../../src/dbutils.php";

    if(!isset($_SESSION["loginAdmin"])){
        header("Location: ../log/login.php?errorStr=Please log in");
        exit();
    }


    $addType= $_POST["addType"];
    $addMaxPeople= $_POST["addMaxPeople"];
    $addNumOfBeds= $_POST["addNumOfBeds"];
    $addFood= $_POST["addFood"];
    $addHourPrice= $_POST["addHourPrice"];
    $addDayPrice= $_POST["addDayPrice"];
    $addUnitPrice= $_POST["addUnitPrice"];
    $addImage= $_POST["addImage"];

        if(executeStatement("insert into room_type values('$addType', $addMaxPeople, $addNumOfBeds, '$addFood', $addHourPrice, $addDayPrice, $addUnitPrice, '$addImage')")){
            echo "SUCCESS:Room type $addType was added successfully";
            exit();
        }else{
            echo "ERROR:Room type $addType is already exist";
            exit();
        }
?>