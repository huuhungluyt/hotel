<?php include("_header.php");?>
<div class="row">
      <div class="col-md-5">
            <div class="panel panel-success">
                  <div class="panel-heading">
                        <h2 style="color:blue">Register</h2>
                  </div>
                  <div class="panel-body">
                  <table>
                        <form class="form-signin">
                              <div class="form-group">
                                    <label for="username">Username:</label>
                                    <input type="text" id="username" class="form-control" placeholder="Enter your username">
                              </div>
                              <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" id="password" class="form-control" placeholder="Enter your password">
                              </div>
                              <div class="form-group">
                                    <label for="re-password">Confirm password:</label>
                                    <input type="password" id="re-password" class="form-control" placeholder="Enter your password again">
                              </div>
                              <div class="form-group">
                                    <label for="fullname">Fullname</label>
                                    <input type="text" id="fullname" class="form-control" placeholder="Enter your fullname">
                              </div>
                              <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <div class="radio">
                                          <label class="radio-inline"><input type="radio" name="optradio">Male</label>
                                          <label class="radio-inline"><input type="radio" name="optradio">Female</label>
                                          <label class="radio-inline"><input type="radio" name="optradio">Other</label>
                                    </div>
                              </div>
                              <div class="form-group">
                                    <label for="date-of-bỉrth">Date Of Birth</label>
                                    <input type="date" id="date-of-bỉrth" class="form-control">
                              </div>          
                              <div class="form-group pull-right">
                                    <button type="button" id="submit" class="btn btn-primary btn-md">Submit</button>
                              </div>
                        </form>
                  </table>
                  </div>
            </div>
      </div>
      <div class="col-md-7">
            <h3>Content</h3>
      </div>
</div>

<?php include("_footer.php");?>
