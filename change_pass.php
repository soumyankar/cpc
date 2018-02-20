<?php
  session_start(); 
  include ("connect.php");
  $id=$_SESSION['user_id'];
  // var_dump($id);
  $sql="Select * from users where ID='$id'";
  $query=mysqli_query($conn,$sql);
  $result=mysqli_fetch_assoc($query);

  if(isset($_POST['Save']))
  {
    $old_pass=$_POST['old'];
    $pass=$_POST['new1'];


    if($result['Password']==$old_pass)
    {
      $sql="Update users Set 
      Password='$pass'
      WHERE ID='$id'";
      $query=mysqli_query($conn,$sql);
      if($query)
      {
        echo "<script type='text/javascript'>alert('Password Changed Successfully!');</script>";
      }
      else
          echo "Not Inserted". "<br>" . mysqli_error($conn);
    }
    else
      echo "<script type='text/javascript'>alert('Incorrect Old Password');</script>";
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Change Password</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script type="text/javascript"  src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>


    <script>

  <!-- For Password Change -->
    (function($,W,D)
    {
      var JQUERY4U = {};

      JQUERY4U.UTIL =
      {
        setupFormValidation: function()
        {
          //form validation rules
          $("#pass_change").validate({
            rules: {
              new1: {
                minlength: 5
              },
              new2: {
                equalTo: "#new1"
              }
            },
            messages: {
              new1: {
                minlength: "Your Password must be more than 5 characters!"
              },
              new2: {
                 equalTo: "Password doesn't match!"
                }           
            },
            submitHandler: function(form) {
              form.submit();
            }
          });
        }
      }

      //when the dom has loaded setup form validation rules
      $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
      });

    })(jQuery, window, document);


  </script>

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span>NCPCR</span></a>
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
                
                <ul class="nav side-menu">
                  <li><a href="home.php"><i class="fa fa-home"></i>Home</a></li>
                  <li><a href="step1.php"><i class="fa fa-bars"></i>Complaint Registration</a></li>
                  <li><a href="complaint_box.php"><i class="fa fa-desktop"></i> Complaints Box</a>
                  </li>
                  <li><a><i class="fa fa-edit"></i>Account Settings <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="edit_profile.php">Edit Profile</a></li>
                      <li><a href="change_pass.php">Change Password</a></li>
                    </ul>
                  </li>
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
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="img/no-img.jpeg" alt=""><?php echo $result['First_Name']; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <!-- <li><a href="edit_profile.php">Edit Profile</a></li>
                    <li>
                      <a href="change_pass.php">
                        <span>Change Password</span>
                      </a>
                    </li> -->
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
              <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
                <h3>Create a New Password here:</h3>
                <form class="form-horizontal" role="form" id="pass_change" method="post" action="">
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Old Password:</label>
                    <div class="col-lg-8">
                      <input class="form-control" type="password" id="old" name="old" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">New Password:</label>
                    <div class="col-lg-8">
                      <input class="form-control" type="password" id="new1" name="new1" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Repeat Password:</label>
                    <div class="col-lg-8">
                      <input class="form-control" type="password" name="new2" required>
                    </div>
                  </div>
                  
                  <hr>
                  <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                      <input class="btn btn-primary" value="Save" type="submit" name="Save">
                      <input class="btn btn-default" value="Cancel" type="reset" onclick="window.location.href='home.php'">
                    </div>
                  </div>
                </form>
                <h2 id="saved" style="position: absolute; left: 27%;"></h2>
              </div>
            </div>

        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Copyright &copy; Web Samaritans
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
</html>