<?php
    include ("../connect.php");
    session_start();
    $state=$_GET['state'];
?>
<html>
<head>
<!--  <link rel="stylesheet" type="text/css" href="css/table.css">-->
<!--  <link rel="stylesheet" type="text/css" href="css/form.css">-->
  <title>Local Admin </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="../css/agency.css" rel="stylesheet">
  <script type="text/javascript"  src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
  <style>
    body {
      background-color: grey;

    }
    table, th, td {
      border: 2px solid black;
    }
    td,th,btn {
      padding: 1em;
      width:50px;
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
      <a class="navbar-brand page-scroll" href="adminpage.php">NCPCR Admin</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse"
         id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="all_complaints.php" class="page-scroll"> View All Complaints</a></li>
        <li><a href="admin_logout.php" class="btn btn-primary"> Logout</a></li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>

<section>
  <center>
    <form type="get" action="state_search.php">
      <div id="custom-search-input">
        <div class="input-group col-md-5">
          <select type="text" class="form-control input-lg" name='state'/>
              <option value="">--Select State--</option>
              <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
              <option value="Andhra Pradesh">Andhra Pradesh</option>
              <option value="Arunachal Pradesh">Arunachal Pradesh</option>
              <option value="Assam">Assam</option>
              <option value="Bihar">Bihar</option>
              <option value="Chandigarh">Chandigarh</option>
              <option value="Chhattisgarh">Chhattisgarh</option>
              <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
              <option value="Daman and Diu">Daman and Diu</option>
              <option value="Delhi">Delhi</option>
              <option value="Goa">Goa</option>
              <option value="Gujarat">Gujarat</option>
              <option value="Haryana">Haryana</option>
              <option value="Himachal Pradesh">Himachal Pradesh</option>
              <option value="Jammu and Kashmir">Jammu and Kashmir</option>
              <option value="Jharkhand">Jharkhand</option>
              <option value="Karnataka">Karnataka</option>
              <option value="Kerala">Kerala</option>
              <option value="Lakshadweep">Lakshadweep</option>
              <option value="Madhya Pradesh">Madhya Pradesh</option>
              <option value="Maharashtra">Maharashtra</option>
              <option value="Manipur">Manipur</option>
              <option value="Meghalaya">Meghalaya</option>
              <option value="Mizoram">Mizoram</option>
              <option value="Nagaland">Nagaland</option>
              <option value="Odisha">Odisha</option>
              <option value="Pondicherry">Pondicherry</option>
              <option value="Punjab">Punjab</option>
              <option value="Rajasthan">Rajasthan</option>
              <option value="Sikkim">Sikkim</option>
              <option value="Tamil Nadu">Tamil Nadu</option>
              <option value="Tripura">Tripura</option>
              <option value="Uttaranchal">Uttaranchal</option>
              <option value="Uttar Pradesh">Uttar Pradesh</option>
              <option value="West Bengal">West Bengal</option>
          </select>
          <span class="input-group-btn">
              <button class="btn btn-info btn-lg" type="submit">
                  <i class="glyphicon glyphicon-search"></i>
              </button>
          </span>
        </div>
      </div>
    </form>
  </center>
  <h2 class="aa_h2" align="center">Complaints from <?php echo $state; ?></h2>
  <div class="aa_htmlTable">

    <br />
    <div style="">
    <?php
      $sql="Select * from complaints where State = '$state'";
      $result=mysqli_query($conn,$sql);
      $found=mysqli_num_rows($result);
      if(!$found)
      {
        echo "<center><h4>--No Results Found--</h4></center>";
      }
      else
      {
        ?>
      <table align="center" border="5">
        <thead>
          <tr>
            <th>Complaint ID</th>
            <th>Complainant Name</th>
            <th>Complainant Email</th>        
            <th>Complainant Mobile</th>
            <th>Complaint Status</th>
            <th>Complaint Details</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while($found=mysqli_fetch_array($result,MYSQLI_ASSOC))
          {
            $id=$found['user_id'];
            $sql2="Select * from users where ID='$id'";
            $query=mysqli_query($conn,$sql2);
            $user=mysqli_fetch_array($query,MYSQLI_ASSOC);
            $c_id=$found['Complaint_ID'];
            ?>
            <tr>
              <td><?php echo $c_id; ?></td>
              <td><?php echo $user['First_Name']. " " . $user['Last_Name']; ?></td>
              <td><?php echo $user['Email']; ?></td>
              <td><?php echo $user['Mobile']; ?></td>
              <td><?php echo $found['Complaint_Status']; ?></td>
              <td><a class="btn btn-success" href="see_complaint.php?c_id=<?php echo $c_id; ?>">See Complaint Details</a></td>
            </tr>
            <?php
            }
          }  
        ?>
      </tbody>
    </table>
  </div>
  </div>

</section>

<script>
    var x=window.location.search.substring(1),y;
    if(x)
    {
        y=x.split('=');
//                console.log(y[0]);
  if(y[0]=='response')
          alert("Response Sent.");
    }
</script>
</body>
</html>

