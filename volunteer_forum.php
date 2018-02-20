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
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Volunteer Forum</title>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
          <script src="https://rawgit.com/kottenator/jquery-circle-progress/1.2.2/dist/circle-progress.js"></script>
          <script src="examples.js"></script>

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
            <h1 align="center">Volunteer Forum</h1>

<table align="center" class="aa_h2" style="width: 100%  border: 1px solid #dddddd;">
  <tr>
    <th style="font-size: 20px;" >Name</th>
    <th style="font-size: 20px;">Score</th>
  </tr>
  <?php
                      $sql3="Select * from users ORDER BY credit_point DESC";  
                      if(isset($_POST['sort']))
                      {
                        echo "YEs yes ";
                        $sql3.=" ORDER BY credit_point";  
                      }
                      $query3=mysqli_query($conn,$sql3);
                      $found2=mysqli_num_rows($query3);
                      if(!$found2)
                      {
                        echo "<h4 style=\"position:absolute; top:60%; left:60%\">--No Users :(--</h4>";
                       }
                      else
                      {
                        while($found2=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                        {
                          if($found2['ID']!='$id')
                          {
                           
  ?>
  <tr>
      <td><img src="img/no-img.jpeg" style=" width: 75px;
  height: 75px; border-radius: 50%; display: inline-block;" alt=""/><span><b style="display: inline-block; position: absolute; padding: 0px 10px 0px 10px; font-size: 20px; line-height: 40px;"><?php echo $found2['First_Name']." ".$found2['Last_Name'] ?></b></span></td>
  <td><b style="font-size: 25px;"><?php echo $found2['credit_point'] ?></b></td>
  </tr>
  <?php
  }
  }
  }
  ?>
</table>
<button type="submit" name="sort">Sort</button>
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
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}

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