
<?php
require_once "src/dbutils.php";

$temp= getData("select dayPrice from room_type, room where room_type.type= room.type and room.id='0101'");
            $dayPrice= $temp->fetchAll()[0]->cols['dayPrice'];

echo $dayPrice;
?>