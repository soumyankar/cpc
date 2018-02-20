<?php
  session_start(); 
  include ("connect.php");
  $id=$_SESSION['user_id'];
  $c_id=$_GET['c_id'];
  $sql="Select * from users where ID='$id'";
  $query=mysqli_query($conn,$sql);
  $result=mysqli_fetch_assoc($query);

  if(isset($_POST['next']))
  {
      $org=$_POST['porg'];
      $case_no=$_POST['pno'];
      $date=$_POST['pdate'];
      $details=$_POST['pdetails'];

      $sql="INSERT INTO case_history(Organisation, Complaint_id, Case_No, Registered_date, Details) VALUES('$org','$c_id','$case_no','$date','$details')";
      $query=mysqli_query($conn,$sql);
      if(!$query)
      {
        echo "Not Inserted". "<br>" . mysqli_error($conn);
      }
    else
      header("location:step5.php?c_id=$c_id");
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

    <title>Case History </title>

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
                <br> <h3>Case/Complaint Already Registered?</h3>
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
                               
            <div class="row" id="case_history">
              <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
                <h3>Details:</h3>
                <form class="form-horizontal" role="form" method="post">
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Name of the Organisation/Institute where case is registered*</label>
                    <div class="col-lg-8">
                      <select name="porg" class="form-control">
                        <option>--Please Select--</option>
                        <option>SCPCR</option>
                        <option>Other Organisation</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Already Registered Case No*</label>
                    <div class="col-lg-8">
                      <input class="form-control" type="text" name="pno" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Previous Registered Date</label>
                    <div class="col-lg-8">
                      <input class="form-control" type="date" name="pdate">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Details of Already Registered Case in brief*</label>
                    <div class="col-md-8">
                      <textarea class="form-control" id="details" name="pdetails" rows="5"></textarea>
                    </div>
                    <img src="img/mic.png" style="height:30px;width:30px" id="start-button" onclick="toggle()">
                  </div>
                  
                  <hr>
                  <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                      <input class="btn btn-primary" value="Next" name="next" type="submit">
                      <input class="btn btn-default" value="Skip" type="reset" onclick="window.location.href='step5.php?c_id=<?php echo $c_id; ?>'">
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

        $("#case_history").hide();

        $('#yes').click(function()
        {
          $("#case_history").show();
        });

        $('#no').click(function()
        {
          // $("#case_history").hide();
          window.location.href = 'step5.php?c_id=<?php echo $c_id; ?>';
        });
      });
    </script>

    <!-- Speech to Text API Call -->
    <script type="text/javascript">
      var p=0;
      var k;
      function toggle()
      {
        
        if(p==0)
          {
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
          details.innerHTML=linebreak(final_transcript);
          if(k==0)
          details.innerHTML=linebreak(interim_transcript);
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
        details.innerHTML = '';
        
      }
    </script>
    
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
  </body>
</html>