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
    

    //By Username
    $byUsername= $_POST["byUsername"];


    //By others
    $byFullName= $_POST["byFullName"];
    $byGender= $_POST["byGender"];
    $byBirthyear= $_POST["byBirthyear"];

    $sqlStr="select * from user_acc ";
    $where= "where 1=1 ";
    if($findBy){
        if($findBy=="byId"&&$byId) $where .= "and id=$byId ";
        if($findBy=="byUsername"&&$byUsername) $where .= "and username='$byUsername' ";
        if($findBy=="byOther"){
            if($byFullName) $where .= "and fullName='$byFullName' ";
            if($byGender) $where .= "and gender='$byGender'";
            if($byBirthyear) $where .= "and YEAR(dateOfBirth)='$byBirthyear'";
        } 
    }

    $dataTable= getData($sqlStr.$where);
    $result="";
    foreach($dataTable as $customer) {
        $result .= "<tr>";
        foreach($customer->cols as $key=>$value){
            if($key!="password"){
                $result .= "<td>".htmlspecialchars($value, ENT_QUOTES)."</td>";
            }
        }
        $id= $customer->cols["id"];
        $username= json_encode($customer->cols["username"]);
        $fullName= json_encode($customer->cols["fullName"]);
        $gender= json_encode($customer->cols["gender"]);
        $dateOfBirth= json_encode($customer->cols["dateOfBirth"]);
        $result .= "<td><button type='button' class='btn btn-success btn-xs' data-toggle='modal' data-target='#updatePopup'
        onClick='fillUpdateForm($id, $username, $fullName, $gender, $dateOfBirth)'
        ><span class='glyphicon glyphicon-pencil'></span></button></td>";
        $result .= "<td><button onClick='loadHistory($id)' type='button' class='btn btn-warning btn-xs'
        ><span class='glyphicon glyphicon-list-alt'></span></button></td>";
        $result .= "<td><button onClick='deleteCustomer($id)' class='btn btn-danger btn-xs' data-toggle='confirmation'
        ><span class='glyphicon glyphicon-remove'></span></a></td>";
        $result .= "</tr>";
    }

    echo $result;
?>