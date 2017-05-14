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
    document.getElementById("url_room").classList.remove("active");
    document.getElementById("url_room_type").classList.add("active");
    document.getElementById("url_customer").classList.remove("active");
    document.getElementById("url_order").classList.remove("active");
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
                <form id="formFindRoomType" action=""class="form-horizontal">
                    <div class="form-group">
                        <div class="radio control-label col-sm-4">
                            <label for="findByType">
                                <input type="radio" id="findByType" name="findBy" value="byType">Type:
                            </label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" id="byType" name="byType">
                            <option value="">-- All --</option>
                            <?php
                                $temp= getData("select type from room_type");
                                foreach($temp as $obj){
                                    echo "<option value='".$obj->cols['type']."'>".$obj->cols['type']."</option>";
                                }
                            ?>
                            </select>
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
                            <label for="byMaxPeople">Max number of people: </label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" id="byMaxPeople" name="byMaxPeople">
                            <option value="">-- All --</option>
                            <?php
                                $temp= getData("select distinct maxPeople from room_type");
                                foreach($temp as $obj){
                                    echo "<option value='".$obj->cols['maxPeople']."'>".$obj->cols['maxPeople']."</option>";
                                }
                            ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="byNumOfBeds">Number of beds: </label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" id="byNumOfBeds" name="byNumOfBeds">
                                <option value="">-- All --</option>
                                <?php
                                    $temp = getData("select distinct numOfBeds from room_type");
                                    foreach($temp as $obj){
                                        echo "<option value='".htmlspecialchars($obj->cols['numOfBeds'])."'>".htmlspecialchars($obj->cols['numOfBeds'])."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="byFood">Food: </label>
                        </div>
                        <div class="col-sm-8">
                             <select class="form-control" id="byFood" name="byFood">
                                <option value="">-- All --</option>
                                <?php
                                    $temp = getData("select distinct food from room_type");
                                    foreach($temp as $obj){
                                        echo "<option value='".htmlspecialchars($obj->cols['food'])."'>".htmlspecialchars($obj->cols['food'])."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8">
                            <input type="button" class="btn btn-info pull-right" id="btnFindRoomType" value="Find">
                        </div>
                        <div class="col-sm-4">
                            <input type="reset" class="btn btn-default pull-right" id="resetFindForm" value="Reset">
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

<!--ROOM TYPE INFORMATION-->
<div class= "col-md-8 col-sm-12">
    <div class="panel panel-info">
        <div class="panel-heading">
        <div class="row">
            <div class="col-md-11">
            <h4><span class="glyphicon glyphicon-th-list"></span> Room type information</h4>
            </div>
            <div class="col-md-1">
            <button data-toggle='modal' data-target='#addPopup'class="btn btn-primary btn-sm pull-right"><span class="glyphicon glyphicon-plus"></span></button>
            </div>
            </div>
        </div>
        <div class="panel-body" style="overflow: scroll; height: 400px; overflow-x: hidden;">
            <table class="table table-striped table-hover table-bordered" id="roomTypeInfo">
              <thead>
                <tr>
                  <th>Type</th>
                  <th>Max number of people</th>
                  <th>Number of beds</th>
                  <th>Food</th>
                  <th>Hour price</th>
                  <th>Day price</th>
                  <th>Unit price</th>
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
            <form id="formUpdateRoomType" method="POST" class="form-horizontal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update room type information</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="control-label col-sm-4">
                        <label for="roomType" >Type</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="roomType" name="roomType" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="updateMaxPeople">Max number of people: </label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="updateMaxPeople" name="updateMaxPeople">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="updateNumOfBeds">Number of beds: </label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="updateNumOfBeds" name="updateNumOfBeds">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="updateFood">Food: </label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" id="updateFood" name="updateFood">
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="updateHourPrice">Hour price: </label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="updateHourPrice" name="updateHourPrice">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="updateDayPrice">Day price: </label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="updateDayPrice" name="updateDayPrice">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="updateUnitPrice">Unit price: </label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="updateUnitPrice" name="updateUnitPrice">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="updateImage">Image link: </label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="updateImage" name="updateImage">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <input type="submit" id="btnUpdateRoomType" class="btn btn-success" value='Submit'>
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
            <form id="formAddRoomType" method="POST" class="form-horizontal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add room type</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="control-label col-sm-4">
                        <label for="addType" >Type</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="addType" name="addType">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="addMaxPeople">Max number of people: </label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="addMaxPeople" name="addMaxPeople">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="addNumOfBeds">Number of beds: </label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="addNumOfBeds" name="addNumOfBeds">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="addFood">Food: </label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" id="addFood" name="addFood">
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="addHourPrice">Hour price: </label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="addHourPrice" name="addHourPrice">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="addDayPrice">Day price: </label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="addDayPrice" name="addDayPrice">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="addUnitPrice">Unit price: </label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="addUnitPrice" name="addUnitPrice">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="addImage">Image link: </label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="addImage" name="addImage">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <input type="submit" id="btnUpdateRoomType" class="btn btn-success" value='Submit'>
                <input type="button" class="btn btn-default" data-dismiss="modal" value='Close'>
                </div>
            </form>
      </div>
    </div>
  </div>

</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="../../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script src="room_type.js"></script>
<?php include("../log/_footer.php");?>