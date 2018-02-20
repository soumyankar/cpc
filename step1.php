<?php 
  session_start(); 
  include ("connect.php");
  $id=$_SESSION['user_id'];
  $sql="Select * from users where ID='$id'";
  $query=mysqli_query($conn,$sql);
  $result=mysqli_fetch_assoc($query);

  if($result['isComplete']=="Yes")
  {
    header("location:step2.php");
  }

  if(isset($_POST['next']))
  {
    $fname=$_POST['fname'];
    $mname=$_POST['mname'];
    $lname=$_POST['lname'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
    $dob=$_POST['dob'];
    $nationality=$_POST['nationality'];
    $address=$_POST['address'];
    $district=$_POST['district'];
    $state=$_POST['state'];
    $pin=$_POST['pin'];
    $tehsil=$_POST['tehsil'];
    $user_type=$_POST['user_type'];

    $sql="Update users Set 
    First_Name='$fname',
    Middle_Name='$mname',
    Last_Name='$lname',
    Age='$age',
    Gender='$gender',
    Email='$email',
    Mobile='$mobile',
    DOB='$dob',
    Nationality='$nationality',
    Address='$address',
    District='$district',
    State='$state',
    PIN='$pin',
    Tehsil='$tehsil',
    User_Type='$user_type',
    isComplete='Yes'
    WHERE ID='$id'";
    $query=mysqli_query($conn,$sql);
    if(!$query)
      echo "Not Updated" . mysqli_error($conn);
    header("location:step2.php");
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

    <title>Register your Complaint </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                    <li><a href="javascript:;">Help</a></li>
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
            <h1>Complete your profile to Continue</h1>
                        
            <div class="row">
              <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
                <h3>Basic details of the Complainant:</h3>
                <form class="form-horizontal" role="form" method="post" action="">
                  <div class="form-group">
                    <label class="col-lg-3 control-label">First name*</label>
                    <div class="col-lg-8">
                      <input class="form-control" id="fname" type="text" name="fname" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Middle name</label>
                    <div class="col-lg-8">
                      <input class="form-control" type="text" name="mname">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Last name*</label>
                    <div class="col-lg-8">
                      <input class="form-control" id="lname" type="text" name="lname" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Age*</label>
                    <div class="col-lg-8">
                      <input class="form-control" name="age" type="number" required>
                    </div>
                  </div>
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
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Email*</label>
                    <div class="col-lg-8">
                      <input class="form-control" id="email" type="text" name="email" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Mobile(+91)*</label>
                    <div class="col-lg-8">
                      <input class="form-control" id="mobile" name="mobile" type="number" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Date of Birth*</label>
                    <div class="col-lg-8">
                      <input class="form-control" name="dob" type="date"  required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Are You an Indian National?</label>
                    <div class="col-lg-2">
                      <select class="form-control" id="nationality" name="nationality">
                        <option>Yes</option>
                        <option>No</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Address*</label>
                    <div class="col-md-8">
                      <textarea class="form-control" name="address"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">PIN*</label>
                    <div class="col-lg-8">
                      <input class="form-control" type="number" name="pin" id="pincode" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">State*</label>
                    <div class="col-lg-8">
                      <input class="form-control" type="text" name="state" id="state">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">District*</label>
                    <div class="col-lg-8">
                      <input class="form-control" type="text" name="district" id="district">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Tehsil/Taluk*</label>
                    <div class="col-lg-8">
                      <input class="form-control" type="text" name="tehsil" id="taluka">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">User Type:</label>
                    <div class="col-lg-3">
                      <select class="form-control" id="user_type" name="user_type">
                        <option>Individual</option>
                        <option>NGO</option>
                      </select>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                      <input class="btn btn-primary" value="Next" name="next" type="submit">
                      <input class="btn btn-default" value="Cancel" type="reset" id="cancel">
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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  

    <script type="text/javascript">
      $("#cancel").click(function(){
          var r = confirm("Are You Sure?");
          if (r == true) {
              window.location.href = 'home.php';
          }
      });
    </script>

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

        $('#fname').val(fname);
        $('#lname').val(lname);
        $('#email').val(email);
        $('#mobile').val(mobile);

      });

    </script>
    
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
  </body>
</html>