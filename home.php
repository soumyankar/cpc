<?php 
  session_start(); 
  include ("connect.php");
  $id=$_SESSION['user_id'];
  $sql="Select * from users where ID='$id'";
  $query=mysqli_query($conn,$sql);
  $result=mysqli_fetch_assoc($query);
  if(!isset($_SESSION['user_id']))
  {
    header("location:index.php");
  }
  $percent=(int)$result['credit_point'];
  $divisor=1000000;
  $percent=((float)($percent/$divisor))*100;
?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <link href="ToxProgress-master/css2/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>

    <!-- Add these files to use ToxProgress -->
    <link href="ToxProgress-master/css2/tox-progress.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="ToxProgress-master/js2/tox-progress.js"></script>
    <!-- -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome</title>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // document.querySelector('#reset-button').addEventListener('click', function () {
            //     ToxProgress.create();
            //     ToxProgress.animate();
            // });
            ToxProgress.create();
            ToxProgress.animate();
        });
    </script>
    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span>CPC</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="img/no-img.jpeg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $result['First_Name']; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="home.php"><i class="fa fa-home"></i>Home</a></li>
                  <li><a href="edit_profile.php"><i class="fa fa-edit"></i>Account Settings <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="edit_profile.php">Edit Profile</a></li>
                      <li><a href="#">Change Password</a></li>
                    </ul>
                  </li>
                    <li><a href="../cpc/credit_history.php"><i class="fa fa-paw"></i>Credit History</a></li>
                    <li><a href="volunteer_forum.php"><i class="fa fa-bars"></i>Volunteer Forum</a></li>
                  <li><a href="logout.php"><i class="fa fa-sign-out"></i>Logout</a>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="img/no-img.jpeg" alt=""><?php echo $result['First_Name']; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="edit_profile.php">Edit Profile</a></li>
                    <li>
                      <a href="change_pass.php"><span>Change Password</span> </a>
                    </li>
                    <li><a href="help.php">Help</a></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row">
            <h1 align="center">Welcome to CYBER PEACE CORPS</h1>
        
        <div class="col-md-25 col-sm-50 " style="float: center;">
            <div style="margin: 50px 400px;" class="tox-progress" data-size="250" data-thickness="12" data-color="#229922"
                 data-background="#ffffff" data-progress="<?php echo $percent; ?>" data-speed="500">
                <div class="tox-progress-content" data-vcenter="true">
                    <div class="text-center" style="width: 100%">
                        <p class="text-center" style="font-family:'Josefin Sans', sans-serif;font-size: 2.0em; padding-bottom: 0 margin: 50px 200px;"><?php echo $result['credit_point'];?></p>
                </div>
            </div>
            <p style="font-family:'Josefin Sans', sans-serif;font-size: 1.4em;" class="text-center margin-top-xs">50</p>
        </div>
              </div>
              <h3 style="margin: 340px 500px;margin-bottom: 0px;">Your Credit</h3>
              <a href="Add_credits.php" class="myButton" style="margin: 50px 400px;margin-bottom: 0px;">+Add Credits</a>
        
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Copyright &copy; Pyanweb
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  
    
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
  </body>
  <style>
    .myButton {
  -moz-box-shadow:inset 0px -3px 7px 0px #29bbff;
  -webkit-box-shadow:inset 0px -3px 7px 0px #29bbff;
  box-shadow:inset 0px -3px 7px 0px #29bbff;
  background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #2dabf9), color-stop(1, #0688fa));
  background:-moz-linear-gradient(top, #2dabf9 5%, #0688fa 100%);
  background:-webkit-linear-gradient(top, #2dabf9 5%, #0688fa 100%);
  background:-o-linear-gradient(top, #2dabf9 5%, #0688fa 100%);
  background:-ms-linear-gradient(top, #2dabf9 5%, #0688fa 100%);
  background:linear-gradient(to bottom, #2dabf9 5%, #0688fa 100%);
  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#2dabf9', endColorstr='#0688fa',GradientType=0);
  background-color:#2dabf9;
  -moz-border-radius:14px;
  -webkit-border-radius:14px;
  border-radius:14px;
  display:inline-block;
  cursor:pointer;
  color:#ffffff;
  font-family:Arial;
  font-size:17px;
  padding:10px 74px;
  text-decoration:none;
  text-shadow:0px 1px 0px #263666;
}
.myButton:hover {
  background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #0688fa), color-stop(1, #2dabf9));
  background:-moz-linear-gradient(top, #0688fa 5%, #2dabf9 100%);
  background:-webkit-linear-gradient(top, #0688fa 5%, #2dabf9 100%);
  background:-o-linear-gradient(top, #0688fa 5%, #2dabf9 100%);
  background:-ms-linear-gradient(top, #0688fa 5%, #2dabf9 100%);
  background:linear-gradient(to bottom, #0688fa 5%, #2dabf9 100%);
  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#0688fa', endColorstr='#2dabf9',GradientType=0);
  background-color:#0688fa;
}
.myButton:active {
  position:relative;
  top:1px;
}

  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://rawgit.com/kottenator/jquery-circle-progress/1.2.2/dist/circle-progress.js"></script>
  <script src="examples.js"></script>
</html>