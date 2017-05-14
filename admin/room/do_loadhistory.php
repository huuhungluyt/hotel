<?php
    session_start();
    require_once "../../src/dbutils.php";

    if(!isset($_SESSION['loginAdmin'])){
        header("Location: ../log/login.php?errorStr=Please log in");
        exit();
    }
    $id= $_POST["id"];

    $dataTable= getData("select user_id, beginTime, endTime, book.type, fee from user_acc, book where user_id=user_acc.id and room_id=$id");

    foreach($dataTable as $row) {
        $result .= "<tr>";
        foreach($row->cols as $key=>$value){
                $result .= "<td>".htmlspecialchars($value, ENT_QUOTES)."</td>";
        }
        $result .= "</tr>";
    }

    echo $result;
?>