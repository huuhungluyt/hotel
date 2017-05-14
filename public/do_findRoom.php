<?php 

    require_once "../src/dbutils.php";
    require_once '../src/beans.php';
    session_start();
    if(!isset($_SESSION["loginUser"])){
        header("Location: index.php??errorStr=Please login");
        exit();
    } else {
        $loginUser=$_SESSION['loginUser'];
      $id_user= $loginUser->cols["id"];
    }

    $byType = $_POST["byType"];
    $byFloor = $_POST["byFloor"];

    $query = "select id, type from room ";
    $where ="where id not in (select room_id from book where state <> 'check out') ";
    $order ="order by room.id asc";

    if($byType) $where .= "and room.type='$byType' ";
    if($byFloor) $where .= "and SUBSTR(room.id,1,2)='$byFloor' ";

    $data = getData($query.$where.$order);
    $result ="";
    foreach($data as $row){
            $result .="<tr>";
            foreach($row->cols as $key => $value){
                $result .="<td>".htmlspecialchars($value, ENT_QUOTES)."</td>";
            }
            $id_room= json_encode($row->cols["id"]);
            $type_room=$row->cols["type"];
            $hourPrice= 0;
            $dayPrice= 0;
            $prices= getData("select hourPrice, dayPrice from room_type where type='$type_room'");
            foreach($prices as $price){
                $hourPrice= $price->cols['hourPrice'];
                $dayPrice= $price->cols['dayPrice'];
            }
            $result .="<td><button type='button' id='choose' name='choose' data-toggle='modal' data-target='#myBook' class='btn btn-primary btn-md' onClick='fillIdUser(\"$id_user\",$id_room, $hourPrice, $dayPrice)'>Choose</button></td>";
            $result .="</tr>";
    }
    echo $result;
    ?>