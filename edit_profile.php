<?php 
  session_start(); 
  include ("connect.php");
  $id=$_SESSION['user_id'];
  $sql="Select * from users where ID='$id'";
  $query=mysqli_query($conn,$sql);
  $result=mysqli_fetch_assoc($query);
  if(isset($_POST['Save']))
  {
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
    $dob=$_POST['dob'];
    $address=$_POST['address'];
    $pin=$_POST['pin'];

    $sql2="UPDATE users SET 
    First_Name='$fname',
    Last_Name='$lname',
    Age='$age',
    Gender='$gender',
    Email='$email',
    Mobile='$mobile',
    DOB='$dob',
    Address='$address',
    PIN='$pin'
    WHERE ID='$id'";
    $query2=mysqli_query($conn,$sql2);
    if($query2)
          {
            // echo "<script type='text/javascript'>alert('Changes Saved!');</script>";
            header("location: edit_profile.php?saved=true");

          }
    if(!$query2)
      {
          echo "Not Inserted". "<br>" . mysqli_error($conn);
      }
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
 
    <title>Profile Settings</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
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
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="img/no-img.jpeg" alt=""><?php echo $result['First_Name']; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <!-- <li><a href="edit_profile.php">Edit Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span>Change Password</span>
                      </a>
                    </li> -->
                    <li><a href="help.php">Help</a></li>
                    <li>< a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div style="padding-top: 60px;">
            <h1 align="center">Edit Profile</h1>
            <div class="row">
              
              <!-- edit form column -->
              <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
                <h3>Personal info</h3>
                <form class="form-vertical" role="form" method="post">
                  <div class="form-group">
                    <label class="col-lg-3 control-label">First name*</label>
                    <div class="col-lg-8">
                      <input class="form-control" id="fname" type="text" name="fname" required>
                    </div>
                  </div>
              </br>
            </br>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Last name*</label>
                    <div class="col-lg-8">
                      <input class="form-control" id="lname" type="text" name="lname" required>
                    </div>
                  </div>
                  </br>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Age*</label>
                    <div class="col-lg-8">
                      <input class="form-control" id="age" name="age" type="number" required>
                    </div>
                  </div>
                  </br>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Gender*</label>
                    <div class="col-lg-2">
                      <select class="form-control" id="gender" name="gender">
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                      </select>
                    </div>
                  </div>
                  </br>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Email*</label>
                    <div class="col-lg-8">
                      <input class="form-control email2" id="email" type="text" name="email" required>
                    </div>
                  </div>
                  </br>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Mobile*</label>
                    <div class="col-lg-8">
                      <input class="form-control" id="mobile" name="mobile" type="number" required>
                    </div>
                  </div>
                  </br>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Date of Birth*</label>
                    <div class="col-lg-8">
                      <input class="form-control" id="dob" name="dob" type="date"  required>
                    </div>
                  </div>
                  </br>
                  <div class="form-group">
                    </br>
                    <label class="col-md-3 control-label">Address*</label>
                    <div class="col-md-8">
                      <textarea class="form-control" id="address" name="address"></textarea>
                    </div>
                  </div>
                  </br>
                  <div class="form-group">
                    </br>
                    </br>
                    <label class="col-lg-3 control-label">PIN*</label>
                    <div class="col-lg-8">
                      <input class="form-control" type="number" name="pin" id="pincode" required>
                    </div>
                  </div>
                  </br>
                  <hr>
                  <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                      <input class="btn btn-primary" value="Save Changes" name="Save" type="submit">
                      <span></span>
                      <input class="btn btn-default" value="Cancel" type="reset"  onclick="window.location.href='home.php'"`>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
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

    <script>
      $(document).ready(function() {
        $('#pincode').keyup(function(e) {
          var pincode = $(this).val();
          
          if(pincode.length == 6 && $.isNumeric(pincode)) {
            // var req = 'retrieve.php?pincode=' + pincode;
            // $.getJSON(req, null, function(data) {
              // $('#taluka').val(data.taluka);
              // $('#district').val(data.district);
              // $('#state').val(data.state);
            // });
          request = $.ajax({
            type: "post",
            url: "retrieve.php",
            data:{id:pincode},
            dataType: 'text'
                                        
          });
          request.done(function (response, textStatus, jqXHR){
                          // alert(response);
            if(response==-1)
              alert("Wrong pincode. Try again");
            var array =JSON.parse(response);

            $('#taluka').val(array.Taluk);
            $('#district').val(array.Districtname);
            $('#state').val(array.statename);

          })
          };
        });
      });
    </script>
    
    <script type="text/javascript">
      $(document).ready(function() {

        var fname = "<?php echo $result['First_Name']; ?>";
        var lname = "<?php echo $result['Last_Name']; ?>";
        var mobile = "<?php echo $result['Mobile']; ?>";
        var email = "<?php echo $result['Email']; ?>";
        var age = "<?php echo $result['Age']; ?>";
        var dob = "<?php echo $result['DOB']; ?>";
        var address = "<?php echo $result['Address']; ?>";
        var nationality = "<?php echo $result['Nationality']; ?>";
        var pin = "<?php echo $result['PIN']; ?>";
        var state = "<?php echo $result['State']; ?>";
        var district = "<?php echo $result['District']; ?>";
        var tehsil = "<?php echo $result['Tehsil']; ?>";
        var User_Type = "<?php echo $result['User_Type']; ?>";

        $('#fname').val(fname);
        $('#lname').val(lname);
        $('#email').val(email);
        $('#mobile').val(mobile);

        if(age)
          $('#age').val(age);
        if(dob)
          $('#dob').val(dob);
        if(address)
          $('#address').val(address);
        if(nationality)
          $('#nationality').val(nationality);
        if(pin)
          $('#pincode').val(pin);
        if(state)
          $('#state').val(state);
        if(district)
          $('#district').val(district);
        if(tehsil)
          $('#taluka').val(tehsil);
        if(User_Type)
          $('#user_type').val(User_Type);

      });

    </script>

    <script>
        var x=window.location.search.substring(1),y;
        if(x)
        {
            y=x.split('=');
            if(y[0]=='saved')
              alert("Changes Saved!");
        }
    </script>
    
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
  </body>
</html>