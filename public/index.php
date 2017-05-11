<?php include("_header.php");?>


    <div class="container">
  <div class="row">

<div id="inform" class="alert">
            <strong><span class="glyphicon"></span><span></span></strong><span></span>
        </div>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
              <form class="form-signin" id='formRegisAccount' name='formRegisAccount' method='POST' action='do_regisaccount.php'>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Register account</h4>
                </div>
                <div class="modal-body">
                                  <div class="form-group">
                                        <label for="username">Username:</label>
                                        <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username">
                                  </div>
                                  <div class="form-group">
                                        <label for="password">Password:</label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                                  </div>
                                  <div class="form-group">
                                        <label for="re_password">Confirm password:</label>
                                        <input type="password" id="re_password" name="re_password" class="form-control" placeholder="Enter your password again">
                                  </div>
                                  <div class="form-group">
                                        <label for="fullname">Fullname</label>
                                        <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Enter your fullname">
                                  </div>
                                  <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <div class="radio">
                                              <label class="radio-inline"><input type="radio" name="genderradio" value="male">Male</label>
                                              <label class="radio-inline"><input type="radio" name="genderradio" value="female">Female</label>
                                              <label class="radio-inline"><input type="radio" name="genderradio" value="other">Other</label>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                        <label for="dateOfBỉrth">Date Of Birth</label>
                                              <link rel="stylesheet prefetch" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">
                                              <div  class="input-group date">
                                                    <input class="form-control" data-date-format="yyyy-mm-dd" readonly type="text" id="dateOfBirth" name= 'dateOfBirth'>
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                                              </div>      
                                  </div>
                                    
                                  
                </div>
                <div class="modal-footer">
                  <div class="form-group pull-right">
                                        <button type="submit" id="submit" class="btn btn-primary btn-md">Submit</button>
                                  </div>
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
<script src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script src="js/regis_form.js"></script>

<?php include("_footer.php")?>

