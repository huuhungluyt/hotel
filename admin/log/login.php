
<?php
$title= 'Log in';
include("_header.php");
if(isset($_SESSION['loginAdmin'])){
    header('Location: index.php');
    exit();
}
?>
    <div class="row">
      <div class="col-md-4 col-sm-12 col-xs-12 panel-group">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-log-in"></span> Log in</h4>
          </div>

          <div class="panel-body">
            <form name="formLogin" action="do_login.php" method="POST" class="form-horizontal">
                <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="username">
                                Username
                            </label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="password">
                                Password
                            </label>
                        </div>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>

                    <input type="submit" class="btn btn-info pull-right" value="Log in">
            </form>
          </div>
        </div>  
      </div>

      <div class="col-md-8 panel-group">
      <?php
        if($errorStr=$_REQUEST["errorStr"]){
            $errorStr=htmlspecialchars($errorStr);
            echo "<div class='alert alert-warning'>";
            echo "<strong><span class='glyphicon glyphicon-warning-sign'></span> WARNING </strong> $errorStr !";
            echo "</div>";
        }
      ?>
      </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>

<script>
$(function(){
    $("form[name='formLogin']").validate({
        rules:{
            username: "required",
            password: "required"
        },
        messages:{
            username: "Please enter your username !",
            password: "Please enter your password !"
        },
        submitHandler: function(form){
            form.submit();
        }
    });
});
</script>



<?php include("_footer.php");?>