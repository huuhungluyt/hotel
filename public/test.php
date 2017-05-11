<?php
echo "done";
require_once "../src/dbutils.php";
$temp = getData("select * from user_acc where fullname='Nguyen Thi Hanh'");
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