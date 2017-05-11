<?php
echo "done";
require_once "../src/dbutils.php";
$temp = getData("select 2h_price, overnight_price,24h_price,unit_price from INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'cn_web' and TABLE_NAME = 'room_type'");
$content="";
foreach($temp as $obj){
    $content .= "<tr>";
    foreach($obj->cols as $key=>$value){
        if($key!="password"){
            $content .= "<td>".htmlspecialchars($value)."</td>";
        }
    }
    $content .= "</tr>";
}

echo "<table>
    <thead>
        <tr>
        <th>id</th>
        <th>username</th>
        <th>fullname</th>
        <th>gender</th>
        <th>date of birth</th> 
        </tr>
    </thead>
    <tbody>"
    .$content.
    "</tbody>
</table>"
?>