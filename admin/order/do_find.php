<?php
session_start();
    require_once "../../src/dbutils.php";

    if(!isset($_SESSION["loginAdmin"])){
        header("Location: ../log/login.php?errorStr=Please log in");
        exit();
    }

    $findBy= $_POST["findBy"];

    //By ID
    $byId= $_POST["byId"];
    

    //By others
    $byRoomId= $_POST["byRoomId"];
    $byUserId= $_POST["byUserId"];
    $byRoomType= $_POST["byRoomType"];
    $byBeginTime= $_POST["byBeginTime"];
    $byEndTime= $_POST["byEndTime"];
    $byOrderType= $_POST["byOrderType"];
    $byLowFee= $_POST["byLowFee"];
    $byHighFee= $_POST["byHighFee"];


    //By others

    $sqlStr="select book.id orderId, book.user_id userId, room.id roomId, room.type roomType, book.beginTime, book.endTime, book.type orderType, book.fee from book join room on book.room_id=room.id ";
    $where= "where 1=1 ";
    if($findBy){
        if($findBy=="byId"&&$byId) $where .= "and book.id=$byId ";
        if($findBy=="byOther"){
            if($byUserId) $where .= "and book.user_id='$byUserId' ";
            if($byRoomId) $where .= "and room.id='$byRoomId' ";
            if($byRoomType) $where .= "and room.type='$byRoomType' ";
            if($byOrderType) $where .= "and book.type='$byOrderType' ";
            if($byBeginTime&&$byEndTime) $where .= "and ((book.beginTime<='$byBeginTime' and book.endTime>='$byEndTime')or(book.beginTime>='$byBeginTime'and book.beginTime<='$byEndTime')or(book.endTime>='$byBeginTime'and book.endTime<='$byEndTime')) ";
            if($byLowFee&&$byHighFee) $where .= "and (fee<=$byHighFee and fee>=$byLowFee) ";
        } 
    }

    $dataTable= getData($sqlStr.$where);
    $result="";
    foreach($dataTable as $customer) {
        $result .= "<tr>";
        foreach($customer->cols as $key=>$value){
                $result .= "<td>".htmlspecialchars($value, ENT_QUOTES)."</td>";
        }
        // $id= $customer->cols["id"];
        // $username= json_encode($customer->cols["username"]);
        // $fullName= json_encode($customer->cols["fullName"]);
        // $gender= json_encode($customer->cols["gender"]);
        // $dateOfBirth= json_encode($customer->cols["dateOfBirth"]);
        $result .= "<td><button type='button' class='btn btn-success btn-xs ".(($customer->cols['fee'])?"disabled":"")."' data-toggle='modal' data-target='#updatePopup' onClick='fillUpdateForm($id, $username, $fullName, $gender, $dateOfBirth)'><i class='fa fa-dollar' style='font-size:20px;'></i></button></td>";
        // $result .= "<td><button onClick='loadHistory($id)' type='button' class='btn btn-warning btn-xs'
        // ><span class='glyphicon glyphicon-list-alt'></span></button></td>";
        $result .= "<td><button onClick='deleteCustomer($id)' class='btn btn-danger btn-xs' data-toggle='confirmation'
        // ><span class='glyphicon glyphicon-remove'></span></a></td>";
        $result .= "</tr>";
    }

    echo $result;
?>