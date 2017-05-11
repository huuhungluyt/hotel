<?php
    require_once '../src/dbutils.php';
    require_once '../src/beans.php';
    session_start();
  ?>

 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Carousel Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="../bootstrap-3.3.7-dist/custom/css/carousel.css" rel="stylesheet">
  </head>
  <body>

 <div class="navbar-wrapper">
      <div class="container">

        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#" style='color:red'>Exception Hotel</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="active" id="url_home"><a href="#">Home</a></li>
                <li id="url_about"><a href="about.php">About</a></li>
                <li id="url_contact"><a href="contact.php">Contact</a></li>
                <?php 
                  if(isset($_SESSION["loginUser"])){
                    echo "<li id='url_book'><a href='regis_room.php'>Book</a></li>";
                  }
                ?>
              </ul>

<?php
    if(!isset($_SESSION['loginUser'])){
        echo " <form class='navbar-form navbar-right' action='do_login.php' method='POST' name='formLogin'>
            <div class='form-group'>
              <input type='text' name='user' placeholder='Username' class='form-control'>
            </div>
            <div class='form-group'>
              <input type='password' name='pass' placeholder='Password' class='form-control'>
            </div>
            <button type='submit' class='btn btn-success'>Sign in</button>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#myModal'>New account ?</button>
          </form>";
    }else{
      $loginUser=$_SESSION['loginUser'];
      $id= $loginUser->cols["id"];
      $username= htmlspecialchars($loginUser->cols["username"]);
      $password= htmlspecialchars($loginUser->cols["password"]);
      $re_password= htmlspecialchars($loginUser->cols["password"]);
      $userFullName= htmlspecialchars($loginUser->cols["fullName"]);
      $gender= htmlspecialchars($loginUser->cols["gender"]);
      $dateOfBirth= htmlspecialchars($loginUser->cols["dateOfBirth"]);
      echo "<form class='navbar-form navbar-right' action='do_logout.php' method='POST'>
            <div class='form-group'>
              <label >Wellcome <strong id='loginUsername' style='color:white' data-toggle='modal' data-target='#myEditaccount' onClick='fillUpdateAccForm(\"$id\",\"$username\",\"$password\",\"$re_password\", \"$userFullName\", \"$gender\", \"$dateOfBirth\")'>$userFullName</strong></label>
            </div>
            <button type='submit' class='btn btn-success'>LogOut</button>
          </form>";
    }
?>
    
             
            </div>
          </div>
        </nav>

      </div>
    </div>
    

     <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img class="first-slide" src="../res/images/hinh2.jpg" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Wellcome to Exception Hotel</h1>
              <!--<p></p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>-->
            </div>
          </div>
        </div>
        <div class="item">
          <img class="second-slide" src="../res/images/hinh3.jpg" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Wellcome to Exception Hotel</h1>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="third-slide" src="../res/images/hinh1.jpg" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Wellcome to Exception Hotel</h1>      
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->
<div class= "container">
    <?php
      if($errorStr=$_GET["errorStr"]){
            $errorStr=htmlspecialchars($errorStr);
            echo "<div class='alert alert-warning'>";
            echo "<strong><span class='glyphicon glyphicon-warning-sign'></span> WARNING </strong> $errorStr !";
            echo "</div>";
        }
    ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>

<script>
  $(function(){
      $("form[name='formLogin']").validate({
          rules:{
              user: "required",
              pass: "required"
          },
          messages:{
              user: "Please enter your username !",
              pass: "Please enter your password !"
          },
          submitHandler: function(form){
              form.submit();
          }
      });
  });
</script>

<div class="modal fade" id="myEditaccount" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
              <form class="form-signin" name="formUpdateAccount" id="formUpdateAccount" method="POST" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update account</h4>
                </div>
                <div class="modal-body">
                                  <div class="form-group">
                                        <label for="up_id">ID:</label>
                                        <input type="text" id="up_id" name ="up_id" class="form-control" readonly>
                                  </div>
                                  <div class="form-group">
                                        <label for="up_username">Username:</label>
                                        <input type="text" id="up_username" name ="up_username" class="form-control" placeholder="Enter your username">
                                  </div>
                                  <div class="form-group">
                                        <label for="up_password">Password:</label>
                                        <input type="password" id="up_password" name="up_password" class="form-control" placeholder="Enter your password">
                                  </div>
                                  <div class="form-group">
                                        <label for="up_re_password">Confirm password:</label>
                                        <input type="password" id="up_re_password" name="up_re_password" class="form-control" placeholder="Enter your password again">
                                  </div>
                                  <div class="form-group">
                                        <label for="up_fullname">Fullname</label>
                                        <input type="text" id="up_fullname" name="up_fullname" class="form-control" placeholder="Enter your fullname">
                                  </div>
                                  <div class="form-group">
                                        <label for="up_gendertradio">Gender</label>
                                        <div class="radio">
                                              <label class="radio-inline"><input type="radio" name="up_genderradio" value="male">Male</label>
                                              <label class="radio-inline"><input type="radio" name="up_genderradio" value="female">Female</label>
                                              <label class="radio-inline"><input type="radio" name="up_genderradio" value="other">Other</label>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                        <label for="update_dateOfBỉrth">Date Of Birth Update</label>
                                              <link rel="stylesheet prefetch" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">
                                              <div  class="input-group date">
                                                    <input class="form-control" data-date-format="yyyy-mm-dd" readonly type="text" id="update_dateOfBỉrth" name= 'update_dateOfBỉrth'>
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
    
    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

