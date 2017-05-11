<?php
    session_start();
    require_once "../../src/dbutils.php";

    if(!isset($_SESSION["loginAdmin"])){
        header("Location: ../log/login.php?errorStr=Please log in");
        exit();
    }


    $id= $_POST["id"];
    $type= $_POST["type"];

        if(executeStatement("insert into room values('$id', '$type')")){
            echo "SUCCESS:Room $id type $type was added successfully";
            exit();
        }else{
            echo "ERROR:Room $id is already exist";
            exit();
        }
?>