<?php
    session_start();
    require_once "../../src/dbutils.php";

    if(!isset($_SESSION['loginAdmin'])){
        header("Location: ../log/login.php?errorStr=Please log in");
        exit();
    }

    $id= $_POST["id"];
    $action= $_POST["action"];




    if($action=="delete"){
        if(executeStatement("delete from book where id=$id and state='checked out'")){
            echo "SUCCESS:Order $id was deleted";
            exit();
        }
        else{
            echo "ERROR:Order $id can not delete";
        }




    }elseif($action=="cancel"){
        if(executeStatement("update book set state='checked out' where id=$id and state='booked'")){
            echo "SUCCESS:Order $id was cancel";
            exit();
        }
        else{
            echo "ERROR:Order $id can not cancel";
        }




    }elseif($action=="check out"){
        $data= getData("select * from book where id= $id and state = 'checked in'");
        $order= $data->fetchAll()[0];
        date_default_timezone_set("Asia/Ho_Chi_Minh");


        //get begin time
        $beginTime= $order->cols['beginTime'];


        //get end time
        $now= date("Y-m-d h:i:s");
            

        //get Room Id
        $roomId= $order->cols['room_id'];

        //get Room type
        $temp= getData("select type from room where id='$roomId'");
        $roomType= $temp->fetchAll()[0]->cols['type'];

        $diff = abs(strtotime($now) - strtotime($beginTime));

        //get Order type
        $orderType= $order->cols['type'];

        //get prices
        $temp= getData("select hourPrice, dayPrice, price from room_type where type ='$roomType'");
        $prices= $temp->fetchAll()[0];
        $hourPrice= $prices->cols['hourPrice'];
        $dayPrice= $prices->cols['dayPrice'];
        $unitPrice= $prices->cols['price'];

        if($orderType=='day'){
            $days = floor($diff/ (60*60*24));
            $hours= floor(($diff-$days*60*60*24)/(60*60));

            //get money
            $money= $days*$dayPrice+(($hours>12)?($dayPrice):($dayPrice/2));

            echo $roomId.",".$roomType.",".$beginTime.",".$now.",".$orderType.",".$hourPrice.",".$dayPrice.",".$unitPrice.",".$money.",".$hours.",".$days;
        }else{
            $hours= floor($diff/ (60*60));

            //get money
            $money= $hourPrice + (($hours>1)?(($hours-1)*$unitPrice):0);

            echo $roomId.",".$roomType.",".$beginTime.",".$now.",".$orderType.",".$hourPrice.",".$dayPrice.",".$unitPrice.",".$money.",".$hours.",";
        }
    }
?>