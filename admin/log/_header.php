  <?php
    require_once '../../src/dbutils.php';
    require_once '../../src/beans.php';
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

    <title>Exception Hotel - <?php echo $title?></title>

    <!-- Bootstrap core CSS -->
    <link href="../../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">

  </head>

  <body>
  <!--INCLUDE-->


    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Exception Hotel - Manager Area</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
        <?php
            if(isset($_SESSION["loginAdmin"])){
              $loginAdmin= $_SESSION["loginAdmin"];
              $adminFullName= htmlspecialchars($loginAdmin->cols["fullName"]);
                echo "<ul class='nav navbar-nav'>
                <li class='active' id='url_room'><a href='../room'>Room</a></li>
                <li class='active' id='url_room_type'><a href='../room_type'>Type of room</a></li>
                <li id='url_customer'><a href='../customer'>Customer</a></li>
                <li id='url_order'><a href='../order'>Order</a></li>
              </ul>

            <form class='navbar-form navbar-right'>
            <div class='form-group'>
              <h5 style='color:white;'>Welcome <strong>$adminFullName</strong></h5>
            </div>
            <a href='../log/do_logout.php' class='btn btn-warning pull-right'><span class='glyphicon glyphicon-log-out'></span> Log out</a>
          </form>
              ";
            }
        ?>
          
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
    </div>

    <div class="container">