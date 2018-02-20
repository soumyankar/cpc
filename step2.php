<?php 
  session_start(); 
  include ("connect.php");
  include "HashGenerator.php";
  $id=$_SESSION['user_id'];
  $sql="Select * from users where ID='$id'";
  $query=mysqli_query($conn,$sql);
  $result=mysqli_fetch_assoc($query);

  if(isset($_POST['submit']))
  {
      $category=$_POST['category'];
      $complaint=$_POST['complaint'];
      $place=$_POST['iplace'];
      $date=$_POST['idate'];
      $state=$_POST['state'];
      $district=$_POST['district'];
      $tehsil=$_POST['tehsil'];
      $pin=$_POST['pin'];
      $curr_date=date("Y/m/d");

      $sql="INSERT INTO complaints (user_id, Category, Complaint, iPlace,iDate, Complaint_Date,PIN, State,District, Tehsil, Complaint_Status) VALUES ('$id','$category',\"$complaint\",'$place','$date','$curr_date','$pin','$state','$district','$tehsil','In Progress')";
      $query=mysqli_query($conn,$sql);
      if(!$query)
      {
        echo "Not Inserted". "<br>" . mysqli_error($conn);
      }
      else
      {
        $sql2="Select LAST_INSERT_ID() as c_id";
        $query2=mysqli_query($conn,$sql2);
        $result2=mysqli_fetch_assoc($query2);
        $c_id=$result2['c_id'];
        // var_dump($c_id);
        
        $obj = new HashGenerator;
        $hash_id = $obj->encode($c_id);

        $sql3="UPDATE complaints SET Complaint_ID='$hash_id' WHERE ID='$c_id'";
        $query=mysqli_query($conn,$sql3);
        if(!$query)
        {
          echo "Not Updated". "<br>" . mysqli_error($conn);
        }

        header("location:step3.php?c_id=$hash_id");
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

    <title>Register your Complaint </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">

    <!-- <link href="css/mic.css" rel="stylesheet"> -->
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
          <div class="container">
            <h1 class="page-header">Register your Complaint</h1>
            <div class="row">
              
              <!-- edit form column -->
              <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
                <form class="form-horizontal" role="form" method="post" action="">
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Category</label>
                    <div class="col-lg-8">
                      <select name="category" class="form-control">
                        <option>--Not Specified--</option>
                        <?php
                          $sql2="Select * from categories";
                          $query2=mysqli_query($conn,$sql2);
                          while($found=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                          {
                              echo "<option>".$found['Category']."</option>";
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Complaint Details*</label>
                    <div class="col-md-8">
                      <textarea id="complaint" class="form-control" name="complaint" rows="7" ></textarea>
                    </div>
                    <img src="img/mic.png" style="height:30px;width:30px" id="start-button" onclick="toggle()">
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Incident Date</label>
                    <div class="col-lg-8">
                      <input class="form-control" type="date" name="idate">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Incident Place*</label>
                    <div class="col-lg-8">
                      <input class="form-control" type="text" name="iplace" required>
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
                  <hr>
                  <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                      <input class="btn btn-primary" value="Submit" name="submit" type="submit">
                      <input class="btn btn-default" value="Cancel" type="reset" id="cancel">
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
    
    <!-- Speech to Text API Call -->
    <script type="text/javascript">
      var p=0;
      var k;
      var before;
      function toggle()
      {
        
        if(p==0)
          {
            before=$('#complaint').val();
            document.getElementById('start-button').src='img/red-mic.png';
            startDictation(event);

            p=1;
          }
        else
          {
          
            stop(event);
           
            p=0;
          }

         
         
      }
      var final_transcript = '';
      var recognizing = false;

      if ('webkitSpeechRecognition' in window) {

        var recognition = new webkitSpeechRecognition();

        recognition.continuous = true;
        recognition.interimResults = true;

        recognition.onstart = function() {
          recognizing = true;
        };

        recognition.onerror = function(event) {
          console.log(event.error);
        };

        recognition.onend = function() {
          recognizing = false;
        };

        recognition.onresult = function(event) {
          var interim_transcript = '';
          for (var i = event.resultIndex; i < event.results.length; ++i) {
            if (event.results[i].isFinal) {
              final_transcript += event.results[i][0].transcript;
              stop(event);
            } else {
              interim_transcript += event.results[i][0].transcript;
            }
          }
          final_transcript = capitalize(final_transcript);
          complaint.innerHTML=linebreak(final_transcript);
          if(k==0)
          complaint.innerHTML=linebreak(interim_transcript);
        };
      }

      var two_line = /\n\n/g;
      var one_line = /\n/g;
      function linebreak(s) {
        return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
      }

      function capitalize(s) {
        return s.replace(s.substr(0,1), function(m) { return m.toUpperCase(); });
      }
      function stop(event)
      {
        k=1;
        recognition.stop();
        document.getElementById('start-button').src='img/mic.png';
      }

      function startDictation(event) {
        k=0;
        if (recognizing) {
          k=1;
          recognition.stop();
          return;
        }
        final_transcript = '';
        recognition.lang = 'en-US';
        recognition.start();
        complaint.innerHTML = '';
        
      }
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