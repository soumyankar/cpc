
<?php
  session_start(); 
  include ("connect.php");
  $id=$_SESSION['user_id'];
  // var_dump($id);
  $sql="Select * from users where ID='$id'";
  $query=mysqli_query($conn,$sql);
  $result=mysqli_fetch_assoc($query);

  if(isset($_POST['submit']))
  {
    $check=$_POST['check'];
    $whyNo=$_POST['whyNo'];
    $c_id=$_POST['complaint_id'];
    $r_id=$_POST['response_id'];

    // var_dump($check);

    $sql="INSERT INTO user_feedback(Complaint_ID, Response_id, isSatisfied, Comments) VALUES ('$c_id','$r_id','$check','$whyNo')";
    $query=mysqli_query($conn,$sql);
    if(!$query)
      {
        echo "Not Inserted". "<br>" . mysqli_error($conn);
      }
      else
      {
        echo "<script type='text/javascript'>alert('Feedback Sent!');</script>";
      
        if($check=="yes")
        {
          $sql="Update complaints Set Complaint_Status='Solved' where Complaint_ID = '$c_id'";
          $query=mysqli_query($conn,$sql);
        }
        else
        {
          // echo "here";
          $sql="Update complaints Set Complaint_Status='Pending' where Complaint_ID = '$c_id'";
          $query=mysqli_query($conn,$sql);
        }
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

    <title>Complaint Box</title>

    <script type="text/javascript"  src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">

    <style type="text/css">


        td,th {
          width:50px;
          padding: 1em;
        }

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

            <br/>

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
              <h1>Complaint Box:</h1>
              <br>
                <table align="center" style="max-width: 80%;" border="2">
                    <thead>
                    <tr>
                        <th>Complaint ID</th>
                        <th>Category</th>
                        <th>Complaint</th>
                        <th>Complaint Date</th>
                        <th>Incident Place</th>
                        <th>Incidence Date</th>
                        <th>Status</th>
                        <th>Response</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql="Select * from complaints where user_id='$id'";
                    $result=mysqli_query($conn,$sql);
                    $ctr=0;
                    while($found=mysqli_fetch_array($result,MYSQLI_ASSOC))
                    {
                        $ctr+=1;
                        ?>
                        <tr>
                            <td><?php echo $found['Complaint_ID']; ?></td>
                            <td><?php echo $found['Category']; ?></td>
                            <td><a class="btn btn-primary see_complaint" data-id="<?php echo $found['Complaint']; ?>" >See Complaint</a></td>
                            <td><?php echo $found['Complaint_Date']; ?></td>
                            <td><?php echo $found['iPlace']; ?></td>
                            <td><?php echo $found['iDate']; ?></td>
                            <td><?php echo $found['Complaint_Status']; ?></td> 
                            <?php 
                              if($found['Complaint_Status']!=="In Progress")
                              {
                                $c_id=$found['Complaint_ID'];
                                $sql2="Select * from admin_responses where Complaint_ID='$c_id'";
                                $query2=mysqli_query($conn,$sql2);
                                $found2=mysqli_fetch_assoc($query2);
                                // var_dump($found2);
                                $remarks=$found2['Remarks'];
                                $response_id=$found2['ID'];
                                // var_dump($response_id);
                                $sql3="Select * from user_feedback where Response_id = '$response_id'";
                                $query3=mysqli_query($conn,$sql3);
                                $found3=mysqli_fetch_assoc($query3);
                                if(!is_null($found3))
                                  $feedback=true;
                                else
                                  $feedback=false;
                                if($found['Complaint_Status'] == "In Admissible")
                                  $feedback=true;
                                ?>
                                <td><a class="btn btn-primary view_response" 
                                  data-todo='{"c_id" : "<?php echo $c_id; ?>", "r_id" : "<?php echo $response_id; ?>", "remarks" : "<?php echo $remarks; ?>","feedback" : "<?php echo $feedback; ?>"}'>View Response</a>
                                <?php
                                if($found['Complaint_Status']=="Pending")
                                {
                                  echo "<br>--Feedback Sent--</td>";
                                }
                                else if($found['Complaint_Status']=="Solved")
                                {
                                  echo "<br>--Satisfied--</td>";
                                }
                                else if($found['Complaint_Status']=="In Admissible")
                                {
                                  echo "<br>--Invalid Complaint--</td>";
                                }
                                else
                                  echo "</td>";
                              }
                              else
                              {
                                echo "<td>--No Response Yet--</td>";
                              }
                            ?>                                                
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <?php 
                  if($ctr==0)
                    {
                      echo "<br><center><h4>--No Previously Lodged Complaints--</h4></center>";
                    }
                ?>
            </div>
        </div>

        <!-- Complaint Details Modal -->
        <div class="modal fade" id="complaint" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                  aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">
                  Complaint Details 
                </h3>
              </div>
              <div class="modal-body"> 
                <p class="Complaint_detail"></p>
              </div>
            </div>
          </div>
        </div>

        <!-- View Response Modal -->
        <div class="modal fade" id="viewResponse" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                  aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">
                  Response from Local Authority 
                </h3>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-8">
                    <h3>Remarks: </h3>
                    <p class="remarks"></p>
                  </div>
                </div>
                
                <div class="row download">
                  <div class="col-md-8">
                    <a class="btn btn-success download_button">Download Documents Attached</a>
                  </div>
                </div>

                <div class="row feedback">
                  <div class="col-xs-12">
                  <h3>Are You Satisfied?</h3>
                  <form name="myForm" method="post" action="">
                    <!-- <div class="btn-group btn-group-vertical" data-toggle="buttons"> -->
                      <label class="btn">
                        <input type="radio" name='check' class="yes" value="yes"><span>Yes</span>
                      </label>
                      <label class="btn">
                        <input type="radio" name='check' class="no" value="no"></i><span> No</span>
                      </label>
                      <br>
                      <input type="hidden" name="complaint_id" class="complaint_id" value="">
                      <input type="hidden" name="response_id" class="response_id" value="">
                    <div class="whyNo" type="hidden"><textarea rows="3" placeholder="Why No?" name="whyNo"></textarea></div><br>
                    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                  </form>
                  </div>
                </div>
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
    
    <script type="text/javascript">

      $('.view_response').click(function(){
        var c_id = $(this).data('todo').c_id;
        var r_id = $(this).data('todo').r_id;
        var remarks = $(this).data('todo').remarks;
        var feedback = $(this).data('todo').feedback;
        // console.log(feedback);

        $.post('check_doc.php',{c_id: c_id},function(data) {
          if($.trim(data) == "no") 
          {
            $('.download').hide();
          }
          else
          {
            $('.download').show();
            $('.download_button').data('id',c_id);
            // console.log($('.download_button').data('id'));
          }
        });

        if(feedback)
          $('.feedback').hide();
        else
          $('.feedback').show();
        $('#viewResponse').find('.remarks').text(remarks);
        $('.complaint_id').val(c_id);
        $('.response_id').val(r_id);
        $('#viewResponse').modal('show');
      });

      $('.see_complaint').click(function(){
        var complaint = $(this).data('id');
        $('#complaint').find('.Complaint_detail').text(complaint);
        $('#complaint').modal('show');
      });

      $('.download_button').click(function(){
        var c_id = $(this).data('id');
        // $.get('download_doc.php',{c_id: c_id});
        window.location.href="download_response.php?c_id=" + c_id;
      });

    </script>

    <script type="text/javascript">
      $(function(){

        $(".whyNo").hide();

        $('.no').click(function()
        {  
          $(".whyNo").show();
        });
        $('.yes').click(function()
        {
          $(".whyNo").hide();
        });
      });
    </script>

    
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
  </body>
</html>