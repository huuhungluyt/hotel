<?php
   $title= "Customers";
   include("../log/_header.php");
   
   if(!isset($_SESSION["loginAdmin"])){
       $_SESSION["errorStr"]="Please log in";
       header("Location:../log/login.php");
       exit();
   }
   ?>
<script>
   document.getElementById("url_room").classList.remove("active");
   document.getElementById("url_room_type").classList.remove("active");
   document.getElementById("url_customer").classList.add("active");
   document.getElementById("url_order").classList.remove("active");
</script>
<div class="container">
   <div class="row">
      <div class="col-md-4 col-sm-12 panel-group">
         <div id="inform" class="alert">
            <strong><span class="glyphicon"></span><span></span></strong><span></span>
         </div>
         <!-- SEARCH CUSTOMER-->
         <div class="panel panel-info">
            <div class= "panel-heading">
               <h4><span class="glyphicon glyphicon-search"></span> Search customer</h4>
            </div>
            <div class= "panel-body">
               <form name="formFindCustomer" class="form-horizontal">
                  <div class="form-group">
                     <div class="radio control-label col-sm-4">
                        <label for="findById">
                        <input type="radio" id="findById" name="findBy" value="byId">ID:
                        </label>
                     </div>
                     <div class="col-sm-8">
                        <input type="text" class="form-control" name="byId" id="byId">
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="radio control-label col-sm-4">
                        <label for="findByUsername">
                        <input type="radio" id="findByUsername" name="findBy" value="byUsername">Username:
                        </label>
                     </div>
                     <div class="col-sm-8">
                        <input type="text" class="form-control" name="byUsername" id="byUsername">
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
                        <label for="byFullName">Fullname: </label>
                     </div>
                     <div class="col-sm-8">
                        <input type="text" class="form-control" id="byFullName" name="byFullName">
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="control-label col-sm-4">
                        <label for="byGender">Gender: </label>
                     </div>
                     <div class="col-sm-8">
                        <select class="form-control" id="byGender" name="byGender">
                           <option value="">-- All --</option>
                           <option value="male">Male</option>
                           <option value="female">Female</option>
                           <option value="other">Other</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="control-label col-sm-4">
                        <label for="byBirthyear">Year of birth: </label>
                     </div>
                     <div class="col-sm-8">
                        <select class="form-control" id="byBirthyear" name="byBirthyear">
                           <option value="">-- All --</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-sm-8">
                        <input type="button" class="btn btn-info pull-right" id="btnFindCustomer" value="Find">
                     </div>
                     <div class="col-sm-4">
                        <input type="reset" class="btn btn-default pull-right" id="resetFindForm" value="Reset">
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!--CUSTOMERS INFORMATION-->
      <div class= "col-md-8 col-sm-12">
         <div class="panel panel-info">
            <div class="panel-heading">
               <h4><span class="glyphicon glyphicon-th-list"></span> Customer information</h4>
            </div>
            <div class="panel-body" style="overflow: scroll; max-height: 400px; overflow-x: hidden;">
               <table class="table table-striped table-hover table-bordered" id="customerInfo">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Full name</th>
                        <th>Gender</th>
                        <th>Date of birth</th>
                     </tr>
                  </thead>
                  <tbody>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <!--POPUP-->
      <!--POPUP UPDATE FORM-->
      <div class="modal fade" id="updatePopup" role="dialog">
         <div class="modal-dialog" style="width:400px;">
            <!-- Modal content-->
            <div class="modal-content">
               <form id="formUpdateCustomer" method="POST" class="form-horizontal">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">Update customer information</h4>
                  </div>
                  <div class="modal-body">
                     <div class="form-group">
                        <div class="control-label col-sm-4">
                           <label for="customerId">ID:</label>
                        </div>
                        <div class="col-sm-8">
                           <input type="text" readonly class="form-control" id="customerId" name="customerId">
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="control-label col-sm-4">
                           <label for="username">Username:</label>
                        </div>
                        <div class="col-sm-8">
                           <input type="text" class="form-control" id="username" name="username">
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="control-label col-sm-4">
                           <label for="fullName">Full name:</label>
                        </div>
                        <div class="col-sm-8">
                           <input type="text" class="form-control" id="fullName" name="fullName">
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="control-label col-sm-4">
                           <label for="gender">Gender: </label>
                        </div>
                        <div class="col-sm-8">
                           <select class="form-control" id="gender" name="gender">
                              <option value='male'>Male</option>
                              <option value='female'>Female</option>
                              <option value='other'>Other</option>
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="control-label col-sm-4">
                           <label for="dateOfBirth">Date of birth: </label>
                        </div>
                        <div class="col-sm-8">
                           <link rel="stylesheet prefetch" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">
                           <div  class="input-group date">
                              <input class="form-control" data-date-format="yyyy-mm-dd" readonly type="text" id="dateOfBirth" name= 'dateOfBirth'>
                              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <input type="submit" id="btnUpdateCustomer" class="btn btn-success" value='Submit'>
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
                           <th>Room id</th>
                           <th>Room type</th>
                           <th>Begin time</th>
                           <th>End time</th>
                           <th>Type</th>
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
<!--Confirmation js-->
<script src="../../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script src="customer.js"></script>
<?php include("../log/_footer.php");?>

