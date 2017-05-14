<?php 
    require_once "../src/dbutils.php";
    require_once '../src/beans.php';
    session_start();
    if(!isset($_SESSION["loginUser"])){
        header("Location: index.php??errorStr=Please login");
        exit();
    } 

    $id_user = $_POST["id_user"];
    $id_room = $_POST["id_room"];
    $start_time = $_POST["start_time"];
    $type_price = $_POST["price_type"];

    if(executeStatement("insert into book (user_id, room_id, bookTime, beginTime, type) values ('$id_user', '$id_room', NOW(), '$start_time', '$type_price')")){
        echo "SUCCESS:Book room successfully!";
        exit();
    } else {
        echo "ERROR:Book room fail";
    }

?>