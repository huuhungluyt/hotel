<?php include("_header.php");
    require_once "../src/dbutils.php";
    require_once "../src/beans.php";

   if(!isset($_SESSION["loginUser"])){
       header("Location:index.php");
       exit();
   }
   
   
?>
<script>
    document.getElementById("url_home").classList.remove("active");
    document.getElementById("url_about").classList.remove("active");
    document.getElementById("url_contact").classList.remove("active");
    document.getElementById("url_book").classList.add("active");
</script>
<div class="container">
<div class="row">
            
    <div class="col-md-4 ">
        
        <div class="panel panel-success">
        <div class="panel-heading">
            <h2>Search empty room</h2>
        </div>
            <div class="panel-body">
                <form class="form-horizontal" name="formSearch" id="formSearch" method="POST">
                    <div class="form-group">
                    <div class="col-md-4">
                        <label for="byType">Type:</label>
                        </div>
                        <div class="col-md-8">
                            <select class="form-control" id="byType" name="byType">
                            <option value="">--All--</option>
                            <?php 
                                $temp = getData("select type from room_type");
                                foreach($temp as $obj){
                                    echo "<option value='".htmlspecialchars($obj->cols['type'])."'>".htmlspecialchars($obj->cols['type'])."</option>";
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                    <div class="col-md-4">
                        <label for="byFloor">Floor:</label>
                        </div>
                        <div class="col-md-8">
                            <select class="form-control" id="byFloor" name="byFloor">
                            <option value="">-- All --</option>
                            <?php
                                $temp= getData("select distinct SUBSTR(id, 1, 2) id from room");
                                foreach($temp as $obj){
                                    echo "<option value='".$obj->cols['id']."'>".$obj->cols['id']."</option>";
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="inform" class="alert">
                <strong><span class="glyphicon"></span><span></span></strong><span></span>
            </div>
    </div>
    <div class="col-md-8">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h2 style="color:red">Result</h2>
            </div>
                <div class="panel-body" style="overflow: scroll; height: 400px; overflow-x: hidden;">
                <table class="table table-striped table-hover table-bordered" id="roomResult">
                    <thead>
                        <tr>
                            <th class="col-sm-3">Id Room</th>
                            <th class="col-sm-3">Type of room</th>
                            <th class="col-sm-2">Choose</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<!--POPUP BOOK ROOM-->
<div class="modal fade" id="myBook" role="dialog">
    <div class="modal-dialog" style="width:400px;">
        <div class="modal-content">
         <form class="form-horizontal" name="formBook" id="formBook" method="POST">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title" style="color:blue">Book room</h3>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="col-md-4">
                        <label for="user_id">Id user:</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="user_id" name="user_id" readonly>
                    </div>
                </div>
                <div class="form-group hide">
                    <div class="col-md-4">
                        <label for="room_id">Id room:</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="room_id" name="room_id"></hide>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">
                        <label for="start_time">Start time:</label>
                    </div>
                    <link href="../bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
                    <div class="col-md-8">
                        <div class=" input-group date">
                            <input class="form-control date form_datetime" data-date-format="yyyy-mm-dd hh:ii:ss" readonly type="text" id="start_time" name= 'start_time'>
					        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">
                        <label for="type_price">Type of price:</label>
                    </div>
                    <div class="col-md-8">
                        <select class="form-control" id="type_price" name="type_price">
                            <?php 
                                // $tmp = getData("select hourPrice 'hour', dayPrice 'day' from room_type where type = ");
                                // foreach($tmp as $obj2){
                                //     foreach($obj2->cols as $k=>$v){
                                //         echo "<option value='".htmlspecialchars($k)."'>".htmlspecialchars($k.": ".$v)."</option>";

                                //     }
                                // }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" id="book_room" name="book_room" class="btn btn-primary btn-md">Submit</button>
            </div>
        </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script src="../bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script src="../bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.fr.js"></script>
<script src="js/room.js"></script>

<?php include("_footer.php");?>