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
    $byOrderState= $_POST["byOrderState"];

    //By others

    $sqlStr="select book.id orderId, book.user_id userId, room.id roomId, room.type roomType,book.bookTime, book.beginTime, book.endTime, book.type orderType, book.fee, book.state from book join room on book.room_id=room.id ";
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
    if($byOrderState&&($findBy!="byId"||!$byId)) $where .= "and state ='$byOrderState' ";

    $dataTable= getData($sqlStr.$where);
    $result="";
    foreach($dataTable as $order) {
        $result .= "<tr>";
        foreach($order->cols as $key=>$value){
            if($key!="state"){
                $result .= "<td>".htmlspecialchars($value, ENT_QUOTES)."</td>";
            }else{
                if($value=="booked"){
                    $result .= "<td><button type='button' class='btn btn-success btn-xs' data-toggle='modal' data-target='#updatePopup' onClick=''><span class='glyphicon glyphicon-log-in'></span></button></td>";
                }elseif($value=="checked in"){
                    $result .= "<td><button type='button' class='btn btn-info btn-xs' data-toggle='modal' data-target='#updatePopup' onClick=''><span class='glyphicon glyphicon-time'></span></button></td>";
                }else{
                    $result .= "<td><button disabled type='button' class='btn btn-info btn-xs' data-toggle='modal' data-target='#updatePopup' onClick=''><span class='glyphicon glyphicon-log-out'></span></button></td>";
                }

                    $result .= "<td><button ".(($value=="booked")?"":"disabled")." type='button' class='btn btn-warning btn-xs' data-toggle='modal' data-target='#updatePopup' onClick=''><span class='glyphicon glyphicon-refresh'></span></button></td>";
            }
        }
        $result .= "<td><button onClick='deleteCustomer($id)' class='btn btn-danger btn-xs' data-toggle='confirmation'><span class='glyphicon glyphicon-remove'></span></a></td>";
        $result .= "</tr>";
    }

    echo $result;
?>