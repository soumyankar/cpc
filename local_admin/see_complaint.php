<?php
    include ("../connect.php");
    session_start();
    $state=$_SESSION['local_admin'];
    $c_id=$_GET['c_id'];
?>
<html>
<head>
  <title>Local Admin </title>

  <script type="text/javascript"  src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <link href="../css/agency.css" rel="stylesheet">

  <style>
    body {
      background-color: grey;

    }
    table, th, td {
      border: 2px solid black;
      padding: 5px;

    }
    h4 {
      text-align: center;
    } 

  </style>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header page-scroll">
      <button type="button" class="navbar-toggle" data-toggle="collapse"
              data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span> <span
            class="icon-bar"></span> <span class="icon-bar"></span> <span
            class="icon-bar"></span>
      </button>
      <a class="navbar-brand page-scroll" href="local_admin_page.php">Local Admin for <?php echo $state; ?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse"
         id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="local_admin_page.php" class="page-scroll"> View All Complaints</a></li>
        <li><a href="admin_logout.php" class="btn btn-primary"> Logout</a></li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>
<section>
  <?php
    $sql="Select * from complaints where Complaint_ID='$c_id'";
    $result=mysqli_query($conn,$sql);
    $found=mysqli_fetch_array($result,MYSQLI_ASSOC);
  ?>
  <h2 class="aa_h2"  align="center">Complaint</h2>
  <p align="center"><?php echo $found['Complaint']; ?></p>

  <?php

    $sql="Select * from complaints where Docs='yes' and Complaint_ID='$c_id'";
    $query=mysqli_query($conn,$sql);
    $found2=mysqli_fetch_array($query,MYSQLI_ASSOC);
    $u_id=$found2['user_id'];
    if(!is_null($found2))
    {      
      echo "<center><a class=\"btn btn-success\" href=\"../download_complaint.php?c_id=$c_id&u_id=$u_id\">Download Documents attatched</a></center>";
    }

  ?>

  <h2 class="aa_h2"  align="center">Complaint Details</h2>
  <div class="aa_htmlTable">
    <div style="margin-top: 50px;">
    <table align="center"  border="5" style="max-width: 80%;">
      <thead>
        <tr>
          <th>Complaint ID</th>
          <th>Category</th>      
          <th>Complaint Date</th>        
          <th>Incidence Place</th>
          <th>Incidence Date</th>
          <th>District</th>
          <th>Tehsil</th>
          <th>Complaint Status</th>
          <th>Response</th>
        </tr>
      </thead>
      <tbody>
        
        <tr>
          <td><?php echo $c_id; ?></td>
          <td><?php echo $found['Category']; ?></td>
          <td><?php echo $found['Complaint_Date']; ?></td>
          <td><?php echo $found['iPlace']; ?></td>
          <td><?php echo $found['iDate']; ?></td>
          <td><?php echo $found['District']; ?></td>
          <td><?php echo $found['Tehsil']; ?></td>
          <td><?php echo $found['Complaint_Status']; ?></td>
          <td>
            <?php 
              $sql2="Select * from admin_responses where Complaint_ID = '$c_id'";
              $query2=mysqli_query($conn,$sql2);
              $found2=mysqli_fetch_assoc($query2);
              if(!is_null($found2))
              {
                ?>
                <a class="btn btn-success" href="see_response.php?id=<?php echo $c_id; ?>">View Response Sent</a>
                <?php
              }
              else
              {
                ?>
                <a class="btn btn-success" href="admin_response.php?id=<?php echo $c_id; ?>">Respond</a>
                <?php
              }
            ?>
          </td>
        </tr>
        <?php  
        ?>
      </tbody>
    </table>
  </div>
  </div>



  <h2 class="aa_h2" align="center">Victim Details</h2>
  <div class="aa_htmlTable">
    <div>
    <?php
          $sql="Select * from victim where Complaint_ID='$c_id'";
          $result=mysqli_query($conn,$sql);
          if($found=mysqli_fetch_array($result,MYSQLI_ASSOC))
          {
            ?>
            <table align="center" border="5" style="max-width: 80%;">
              <thead>
                <tr>
                  <th>Complaint ID</th>
                  <th>First Name</th>
                  <th>Middle Name</th>        
                  <th>Last Name</th>        
                  <th>Age</th>
                  <th>Gender</th>
                  <th>Age_Proof</th>
                  <th>Relation</th>
                  <th>Relative</th>
                  <th>Disability</th>
                  <th>Address</th>
                  <th>Town</th>
                  <th>State</th>
                  <th>District</th>
                  <th>Tehsil</th>
                  <th>PO</th>
                  <th>PIN</th>
                </tr>
              </thead>
              <tbody>
                
                <tr>
                  <td><?php echo $c_id; ?></td>
                  <td><?php echo $found['First_Name']; ?></td>
                  <td><?php echo $found['Middle_Name']; ?></td>
                  <td><?php echo $found['Last_Name']; ?></td>
                  <td><?php echo $found['Age']; ?></td>
                  <td><?php echo $found['Gender']; ?></td>
                  <td><?php echo $found['Age_Proof']; ?></td>
                  <td><?php echo $found['Relation']; ?></td>
                  <td><?php echo $found['Relative']; ?></td>
                  <td><?php echo $found['Disability']; ?></td>
                  <td><?php echo $found['Address']; ?></td>
                  <td><?php echo $found['Town']; ?></td>
                  <td><?php echo $found['State']; ?></td>
                  <td><?php echo $found['District']; ?></td>
                  <td><?php echo $found['Tehsil']; ?></td>
                  <td><?php echo $found['PO']; ?></td>
                  <td><?php echo $found['PIN']; ?></td>
                </tr>
                <?php
            }
            else
            {
              echo "<h4>--No Victim Details--</h4>";
            }
        
          ?>
      </tbody>
    </table>
  </div>
  </div>

  <h2 class="aa_h2"  align="center">Case History</h2>
  <div class="aa_htmlTable">
    <div>
      <?php
          $sql="Select * from case_history where Complaint_ID='$c_id'";
          $result=mysqli_query($conn,$sql);
          if($found=mysqli_fetch_array($result,MYSQLI_ASSOC))
          {
            ?>
            <table align="center" border="5" style="max-width: 80%;">
              <thead>
                <tr>
                  <th>Complaint ID</th>
                  <th>Organisation</th>
                  <th>Case Number</th>        
                  <th>Registered Date</th>        
                  <th>Details</th>
                </tr>
              </thead>
              <tbody>
                
                <tr>
                  <td><?php echo $c_id; ?></td>
                  <td><?php echo $found['Organisation']; ?></td>
                  <td><?php echo $found['Case_No']; ?></td>
                  <td><?php echo $found['Registered_date']; ?></td>
                  <td><?php echo $found['Details']; ?></td>
                </tr>
              </tbody>
            </table>
            <?php
          }
          else
          {
            echo "<h4>--No Case History--</h4>";
          }
        
    ?>
  </div>
  </div>
</section>
</body>
</html>

