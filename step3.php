<?php 
  session_start(); 
  include ("connect.php");
  $c_id=$_GET['c_id'];
  $id=$_SESSION['user_id'];
  $sql="Select * from users where ID='$id'";
  $query=mysqli_query($conn,$sql);
  $result=mysqli_fetch_assoc($query);

  if(isset($_POST['next']))
  {
    $fname=$_POST['fname'];
    $mname=$_POST['mname'];
    $lname=$_POST['lname'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];
    $age_proof=$_POST['proof'];
    $relation=$_POST['relation'];
    $rname=$_POST['rname'];
    $disability=$_POST['disability'];
    $address=$_POST['address'];
    $town=$_POST['town'];
    $district=$_POST['district'];
    $state=$_POST['state'];
    $tehsil=$_POST['tehsil'];
    $po=$_POST['PO'];
    $pin=$_POST['pin'];

    $sql="INSERT INTO victim(user_id,Complaint_ID, First_Name, Middle_Name, Last_Name, Age, Gender, Age_Proof, Relation, Relative, Disability, Address, Town, State, District, Tehsil, PO, PIN) VALUES('$id','$c_id', '$fname','$mname','$lname','$age','$gender', '$age_proof', '$relation', '$rname', '$disability', '$address', '$town', '$state', '$district', '$tehsil', '$po', '$pin')";
    $query=mysqli_query($conn,$sql);
    if(!$query)
      {
        echo "Not Inserted". "<br>" . mysqli_error($conn);
      }
    else
      header("location:step4.php?c_id=$c_id");
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

    <title>Victim Details </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script type="text/javascript"  src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>

    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    <script>

    (function($,W,D)
    {
      var JQUERY4U = {};

      JQUERY4U.UTIL =
      {
        setupFormValidation: function()
        {
          //form validation rules
          $("#victim_form").validate({
            rules: {
              pin: {
                required: true,
                maxlength: 6,
                minlength: 6
              }
            },
            messages: {
              
              pin: {
                required: "Please provide a PIN",
                maxlength: "Incorrect PIN",
                minlength: "Incorrect PIN"
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
            <div class="row">
              <div class="col-sm-8">
                <br> <h3>Do you have victim Details?</h3>
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
                       
            <div class="row" id="victim">
            <h3>Victim Details:</h3>
              <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
                <form class="form-horizontal" id="victim_form" role="form" method="post" action="">
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
                    <label class="col-lg-3 control-label">Last name</label>
                    <div class="col-lg-8">
                      <input class="form-control" type="text" name="lname">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Age*</label>
                    <div class="col-lg-8">
                      <input class="form-control" name="age" type="number" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Age Proof</label>
                    <div class="col-lg-8">
                      <select name="proof" class="form-control">
                        <option>No ID Proof</option>
                        <option>Adhaar Card</option>
                        <option>PAN Card</option>
                        <option>UID</option>
                        <option>Any ID Proof</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Gender</label>
                    <div class="col-lg-8">
                      <select name="gender" class="form-control">
                        <option>Male</option>
                        <option>Female</option>
                        <option>Others</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Caste</label>
                    <div class="col-lg-8">
                      <select name="caste" class="form-control">
                        <option>Not Known</option>
                        <option>General</option>
                        <option>OBC</option>
                        <option>SC</option>
                        <option>ST</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Relation</label>
                    <div class="col-lg-8">
                      <select name="relation" class="form-control">
                        <option>No Relation</option>
                        <option>C/O</option>
                        <option>S/O</option>
                        <option>D/O</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Relative Name</label>
                    <div class="col-lg-8">
                      <input class="form-control" name="rname" type="text">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Disability</label>
                    <div class="col-lg-8">
                      <select name="disability" class="form-control" required>
                        <option>No Disability</option>
                        <option>Handicaped</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Address</label>
                    <div class="col-md-8">
                      <textarea class="form-control" name="address" rows="4"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Village/Town</label>
                    <div class="col-lg-8">
                      <input class="form-control" type="text" name="town">
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
                    <label class="col-lg-3 control-label">P.O.</label>
                    <div class="col-lg-8">
                      <input class="form-control" type="text" name="PO">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                      <input class="btn btn-primary" value="Next" name="next" type="submit">
                      <input class="btn btn-default" value="Skip" type="reset" onclick="window.location.href='step4.php?c_id=<?php echo $c_id; ?>'">
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
          var r = confirm("Are You Sure to Cancel?");
          if (r == true) {
              window.location.href = 'home.php';
          }
      });
    </script>

    <script type="text/javascript">
      $(function(){

        $("#victim").hide();

        $('#yes').click(function()
        {
          $("#victim").show();
        });

        $('#no').click(function()
        {
          // $("#victim").hide();
          window.location.href = 'step4.php?c_id=<?php echo $c_id; ?>';
        });
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
    
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
  </body>
</html>