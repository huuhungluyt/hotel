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
    //By Floor
    $byFloor= $_POST["byFloor"];
    $byType= $_POST["byType"];
    $byState= $_POST["byState"];

    $sqlStr="   select room.id id, room.type type, user_id, beginTime
                from
                    room
                    left join
                    (select * from book where state<>'checked out') book
                    on
                    room.id=room_id ";
    $where= "where 1=1 ";
    $order= "order by room.id asc";
    if($findBy){
        if($findBy=="byId"&&$byId) $where .= "and room.id=$byId ";
        if($findBy=="byOther"){
            if($byFloor) $where .= "and SUBSTR(room.id,1,2)='$byFloor' ";
            if($byType) $where .= "and room.type='$byType' ";
            if($byState=="vacant") $where .= "and room.id not in (select room_id from book where state<>'checked out')";
            if($byState=="booked") $where .= "and room.id in (select room_id from book where state='booked')";
            if($byState=="using") $where .= "and room.id in (select room_id from book where state='checked in')";
        }
    }

    $dataTable= getData($sqlStr.$where.$order);
    $result="";
    foreach($dataTable as $room) {
        $result .= "<tr>";
        foreach($room->cols as $key=>$value){
            if($key=="type"){
                $temp="";
                $data= getData("select 2h_price '2 hours', overnight_price 'Overnight', 24h_price '24 hours', unit_price 'Unit' from room_type where type='$value'");
                foreach($data as $obj){
                    foreach($obj->cols as $k=>$v){
                        $temp .= "<li style='padding:10px;'>".$k.": <strong>".htmlspecialchars($v)." $</strong></li>";
                    }
                }
                $result .= "<td><div class='dropdown'>
                    <button class='btn btn-default btn-sm dropdown-toggle' type='button' data-toggle='dropdown'>$value
                    <span class='caret'></span></button>
                    <ul class='dropdown-menu'>"
                    .$temp.
                    "</ul>
                </div></td>";
            }elseif($key=="user_id"&&$value){
                $temp="";
                $data= getData("select username 'Username', fullName 'Full name', gender 'Gender', dateOfBirth 'Data of birth' from user_acc where id='$value'");
                foreach($data as $obj){
                    foreach($obj->cols as $k=>$v){
                        $temp .= "<li style='padding:10px;'>".$k.": <strong>".htmlspecialchars($v)."</strong></li>";
                    }
                }

                $result .= "<td><div class='dropdown'>
                    <button class='btn btn-default btn-sm dropdown-toggle' type='button' data-toggle='dropdown'>$value
                    <span class='caret'></span></button>
                    <ul class='dropdown-menu'>"
                    .$temp.
                    "</ul>
                </div></td>";
            }else{
                $result .= "<td>".htmlspecialchars($value, ENT_QUOTES)."</td>";
            }
        }
        $id= json_encode($room->cols["id"]);
        $type= json_encode($room->cols["type"]);
        $result .= "<td><button type='button' class='btn btn-success btn-xs' data-toggle='modal' data-target='#updatePopup'
        onClick='fillUpdateForm($id, $type)'
        ><span class='glyphicon glyphicon-pencil'></span></button></td>";
        $result .= "<td><button onClick='loadHistory($id)' type='button' class='btn btn-warning btn-xs'
        ><span class='glyphicon glyphicon-list-alt'></span></button></td>";
        $result .= "<td><button onClick='deleteRoom($id)' class='btn btn-danger btn-xs'
        ><span class='glyphicon glyphicon-remove'></span></button></td>";
        $result .= "</tr>";
    }

    echo $result;
?>