<?php include("_header.php");
       require_once "../src/dbutils.php";
           require_once "../src/beans.php";
?>
<script>
    document.getElementById("url_home").classList.remove("active");
    document.getElementById("url_about").classList.add("active");
    document.getElementById("url_contact").classList.remove("active");
    document.getElementById("url_book").classList.remove("active");
</script>

<h1 style='color:red'>TYPE OF ROOM</h1>
<div class="row">
   <?php 
    $temp = getData("select * from room_type");
    foreach($temp as $row){
                $type = strtoupper(htmlspecialchars($row->cols["type"]));
                $maxPeople = ($row->cols["maxPeople"]);
                $bed = ($row->cols["numOfBeds"]);
                $food = htmlspecialchars($row->cols["food"]);
                $hourPrice = ($row->cols["hourPrice"]);
                $dayPrice = ($row->cols["dayPrice"]);
                $price = ($row->cols["price"]);
                $img = htmlspecialchars($row->cols["image"]);
                echo "<a href='regis_room.php'><div class='col-lg-3'>
                        <div class='panel-group'>
                              <div class='panel panel-info'>
                                    <div class='panel-heading'><h3>".$type."</h3></div>
                                    <div class='panel-body'>
                                        <table>
                                          <caption><img class='img-rounded' src='".$img."' width='230' height='140'></caption>
                                                <tbody>
                                                      <tr><th>Max of people:</th><td>".$maxPeople."</td></tr>
                                                      <tr><th>Num of bed:</th><td>".$bed."</td></tr>
                                                      <tr><th>Price by hour:</th><td>".$hourPrice."$</td></tr>
                                                      <tr><th>Price by day:</th><td>".$dayPrice."$</td></tr>
                                                      <tr><th>Over price:</th><td>".$price."$</td></tr>
                                                      <tr><th>Food service:</th><td>".$food."</td></tr>
                                                </tbody>
                                          </table>
                                    </div>
                              </div>
                        </div>
                  </div></a>";
    }
    
    ?>

          <!--<img class="img-rounded" src="../res/images/single-vip.jpg" width="240" height="140">
          <h2>Single - VIP</h2>
          <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>-->

    <!--<div class="col-lg-3">
          <img class="img-rounded" src="../res/images/double-vip.jpg" width="240" height="140">
          <h2>Double - VIP</h2>
          <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
    </div>
    <div class="col-lg-3">
          <img class="img-rounded" src="../res/images/single.jpg" alt="Generic placeholder image" width="240" height="140">
          <h2>Single</h2>
          <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
    </div>
    <div class="col-lg-3">
          <img class="img-rounded" src="../res/images/double.jpg" width="240" height="140">
          <h2>Double</h2>
          <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
    </div>-->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<?php include("_footer.php");?>