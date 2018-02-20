<?php
  session_start(); 
  include ("connect.php");
  $id=$_SESSION['user_id'];
  $c_id=$_GET['c_id'];
  $sql="Select * from users where ID='$id'";
  $query=mysqli_query($conn,$sql);
  $result=mysqli_fetch_assoc($query);

  if(isset($_POST['Upload']))
  {
    $flag=true;
    foreach ($_FILES['documents']['name'] as $filename) 
    {
      $parts = pathinfo($filename);
      if (false == ($parts["extension"]=="pdf" or $parts["extension"]=="jpg" or $parts["extension"]=="jpeg" or $parts["extension"]=="png"))
        {
          $flag=false;
          break;
        }
    }

    if($flag)
    {
      $count=0;
      foreach ($_FILES['documents']['name'] as $filename) 
      {
        $parts = pathinfo($filename);
        
        $name=getcwd(). "/uploads/" . $c_id . "_" . $id . "_". $count. "." . $parts["extension"];
        $tmp=$_FILES['documents']['tmp_name'][$count];
        $count=$count + 1;
        // var_dump($name);
        move_uploaded_file($tmp,$name);

      }
        
      $sql="UPDATE Complaints set Docs = 'yes' where Complaint_ID = '$c_id'";
      $query=mysqli_query($conn,$sql);
      if(!$query)
      {
        echo "not updated" . mysqli_error($conn);
      }
      else
        header("location:success.php?c_id=$c_id");
      
    }
    else
      echo "<script>alert('Only pdf and image files are allowed');</script>";
      // echo "invalid file";

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

    <title>Upload Document </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">

    <style type="text/css">

        label.btn span {
          font-size: 1.5em ;
        }

        label input[type="radio"] ~ i.fa.fa-circle-o{
            color: #c8c8c8;    display: inline;
        }
        label input[type="radio"] ~ i.fa.fa-dot-circle-o{
            display: none;
        }
        label input[type="radio"]:checked ~ i.fa.fa-circle-o{
            display: none;
        }
        label input[type="radio"]:checked ~ i.fa.fa-dot-circle-o{
            color: #7AA3CC;    display: inline;
        }
        label:hover input[type="radio"] ~ i.fa {
        color: #7AA3CC;
        }
    </style>
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
                    <li><a href="edit_profile.php">Edit Profile</a></li>
                    <li>
                      <a href="change_pass.php">
                        <span>Change Password</span>
                      </a>
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
              <div class="col-sm-8">
                <br> <h3>Do you have any supporting documents?</h3>
                <br>
                <div class="btn-group btn-group-horizontal" data-toggle="buttons">
                  <label class="btn" id="yes">
                    <input type="radio" name='victim'><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i> <span>  Yes</span>
                  </label>
                  <label class="btn" id="no">
                    <input type="radio" name='victim'><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i><span> No</span>
                  </label>
                </div>

              </div>
            </div>
                               
            <div class="row" id="document">
              <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
                <h3>Upload Document(s):</h3>
                <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    
                    <div class="col-lg-5">
                      <input class="form-control" type="file" name="documents[]" multiple required>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                      <input class="btn btn-primary" value="Submit your Complaint" name="Upload" type="submit">
                      <input class="btn btn-default" value="Skip" type="reset" onclick="window.location.href='success.php'">
                    </div>
                  </div>
                </form>
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
    
    <script type="text/javascript">
      $(function(){

        $("#document").hide();

        $('#yes').click(function()
        {
          $("#document").show();
        });

        $('#no').click(function()
        {
          // $("#document").hide();
          window.location.href = "success.php?c_id=<?php echo $c_id; ?>";
        });
      });
    </script>
    
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
  </body>
</html>