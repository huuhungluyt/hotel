<?php
$title="Rooms";
include("../log/_header.php");

if(!isset($_SESSION["loginAdmin"])){
        $_SESSION["errorStr"]="Please log in";
        header("Location:../log/login.php");
        exit();
    }

    require_once "../../src/dbutils.php";
?>

<script>
    document.getElementById("url_rooms").classList.add("active");
    document.getElementById("url_customers").classList.remove("active");
    document.getElementById("url_books").classList.remove("active");
</script>

<div class="container">
<div class="row">

    <div class="col-md-4 col-sm-12 panel-group">

        <div id="inform" class="alert">
        <strong><span class="glyphicon"></span><span></span></strong><span></span>
        </div>

        <!-- SEARCH ROOM-->
        <div class="panel panel-info">
            <div class= "panel-heading"><h4><span class="glyphicon glyphicon-search"></span> Search room</h4></div>
            <div class= "panel-body">
                <form id="formFindRoom" action="do_findroom.php"class="form-horizontal">
                    <div class="form-group">
                        <div class="radio control-label col-sm-4">
                            <label for="findById">
                                <input type="radio" id="findById" name="findBy" value="byId">Room ID:
                            </label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="byId" name="byId">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="radio control-label col-sm-4">
                        <label for="findByOther">
                            <input type="radio" id="findByOther" name="findBy" value="byOther">By other:
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="byFloor">Floor: </label>
                        </div>
                        <div class="col-sm-8">
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

                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="byType">Type: </label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" id="byType" name="byType">
                                <option value="">-- All --</option>
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
                        <div class="control-label col-sm-4">
                            <label for="byState">State: </label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" id="byState" name="byState">
                                <option value="">-- All --</option>
                                <option value="using">Using</option>
                                <option value="booked">Booked</option>
                                <option value="vacant">Vacant</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8">
                            <input type="button" class="btn btn-info pull-right" id="btnFindRoom" value="Find">
                        </div>
                        <div class="col-sm-4">
                            <input type="reset" class="btn btn-default pull-right" id="resetFindForm" value="Reset">
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

<!--ROOM INFORMATION-->
<div class= "col-md-8 col-sm-12">
    <div class="panel panel-info">
        <div class="panel-heading">
        <div class="row">
            <div class="col-md-11">
            <h4><span class="glyphicon glyphicon-th-list"></span> Room information</h4>
            </div>
            <div class="col-md-1">
            <button data-toggle='modal' data-target='#addPopup'class="btn btn-primary btn-sm pull-right"><span class="glyphicon glyphicon-plus"></span></button>
            </div>
            </div>
        </div>
        <div class="panel-body" style="overflow: scroll; height: 400px; overflow-x: hidden;">
            <table class="table table-striped table-hover table-bordered" id="roomInfo">
              <thead>
                <tr>
                  <th>Room ID</th>
                  <th>Type</th>
                  <th>Customer ID</th>
                  <th>Begin time</th>
                  <th>End time</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
        </div>
    </div>
</div>

<!--POPUP UPDATE ROOM-->
<div class="modal fade" id="updatePopup" role="dialog">
    <div class="modal-dialog" style="width:400px;">
    
      <!-- Modal content-->
      <div class="modal-content">
            <form id="formUpdateRoom" method="POST" class="form-horizontal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update customer information</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="roomId">ID:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" readonly class="form-control" id="roomId" name="roomId">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="roomType">Tyoe: </label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" id="roomType" name="roomType">
                            <?php
                                $temp= getData("select type from room_type");
                                foreach($temp as $obj){
                                    echo "<option value='".$obj->cols['type']."'>".$obj->cols['type']."</option>";
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <input type="submit" id="btnUpdateRoom" class="btn btn-success" value='Submit'>
                <input type="button" class="btn btn-default" data-dismiss="modal" value='Close'>
                </div>
            </form>
      </div>
    </div>
  </div>



<!--POPUP ADD ROOM-->
  <div class="modal fade" id="addPopup" role="dialog">
    <div class="modal-dialog" style="width:400px;">
    
      <!-- Modal content-->
      <div class="modal-content">
            <form id="formAddRoom" method="POST" class="form-horizontal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add room</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="control-label col-sm-4">
                        <label for="addRoomId" >Room ID</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="addRoomId" name="addRoomId">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="addRoomType">Type: </label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" id="addRoomType" name="addRoomType">
                                <?php
                                $temp= getData("select type from room_type");
                                foreach($temp as $obj){
                                    echo "<option value='".htmlspecialchars($obj->cols["type"])."'>".htmlspecialchars($obj->cols["type"])."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <input type="submit" id="btnUpdateRoom" class="btn btn-success" value='Submit'>
                <input type="button" class="btn btn-default" data-dismiss="modal" value='Close'>
                </div>
            </form>
      </div>
    </div>
  </div>


  <!--POPUP HISTORY FORM-->
<div class="modal fade" id="historyPopup" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Used room</h4>
        </div>

        <div class="modal-body" style="overflow: scroll; max-height: 400px; overflow-x: hidden;">
            <table class="table table-striped table-hover table-bordered" id="history">
                <thead>
                    <tr>
                        <th>User id</th>
                        <th>Begin time</th>
                        <th>End time</th>
                        <th>Order type</th>
                        <th>Fee</th>
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
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="../../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script src="room.js"></script>
<?php include("../log/_footer.php");?>