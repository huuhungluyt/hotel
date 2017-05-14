<?php
    session_start();
    require_once "../../src/dbutils.php";

    if(!isset($_SESSION["loginAdmin"])){
        header("Location: ../log/login.php?errorStr=Please log in");
        exit();
    }

    $findBy= $_POST["findBy"];

    //By ID
    $byType= $_POST["byType"];
    
    //By others
    //By Floor
    $byMaxPeople= $_POST["byMaxPeople"];
    $byNumOfBeds= $_POST["byNumOfBeds"];
    $byFood= $_POST["byFood"];

    $sqlStr="select * from room_type ";
    $where= "where 1=1 ";
    if($findBy){
        if($findBy=="byType"&&$byType) $where .= "and type='$byType' ";
        if($findBy=="byOther"){
            if($byMaxPeople) $where .= "and maxPeople='$byMaxPeople' ";
            if($byNumOfBeds) $where .= "and numOfBeds='$byNumOfBeds' ";
            if($byFood) $where .= "and food='$byFood' ";
        }
    }

    $dataTable= getData($sqlStr.$where);
    $result="";
    foreach($dataTable as $room) {
        $result .= "<tr>";
        foreach($room->cols as $key=>$value){
            if($key!="image"){
                $result .= "<td>".htmlspecialchars($value, ENT_QUOTES)."</td>";
            }
        }
        $type= json_encode($room->cols["type"]);
        $maxPeople= $room->cols["maxPeople"];
        $numOfBeds= $room->cols["numOfBeds"];
        $food= json_encode($room->cols["food"]);
        $hourPrice = $room->cols["hourPrice"];
        $dayPrice = $room->cols["dayPrice"];
        $price = $room->cols["price"];
        $image = json_encode($room->cols["image"]);
        $result .= "<td><button type='button' class='btn btn-success btn-xs'
        onClick='fillUpdateForm($type, $maxPeople, $numOfBeds, $food, $hourPrice, $dayPrice, $price, $image)'
        ><span class='glyphicon glyphicon-pencil'></span></button></td>";
        $result .= "<td><button onClick='deleteRoomType($type)' class='btn btn-danger btn-xs'
        ><span class='glyphicon glyphicon-remove'></span></button></td>";

        $result .= "</tr>";
    }

    echo $result;
?>