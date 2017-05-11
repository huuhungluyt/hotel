<?php
    session_start();
    require_once "../../src/dbutils.php";

    if(!isset($_SESSION['loginAdmin'])){
        header("Location: ../log/login.php?errorStr=Please log in");
        exit();
    }

    $id= $_POST["id"];

    $dataTable= getData("select room_id, room.type room_type, beginTime, endTime, book.type, fee from room, book where user_id=$id and room.id=book.room_id");

    foreach($dataTable as $row) {
        $result .= "<tr>";
        foreach($row->cols as $key=>$value){
                $result .= "<td>".htmlspecialchars($value, ENT_QUOTES)."</td>";
        }
        $result .= "</tr>";
    }

    echo $result;
?>