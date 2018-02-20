<?php
    include ("../connect.php");
    session_start();
    $state=$_SESSION['local_admin'];
    $id=$_GET['search_id'];
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
  <center>
    <form type="get" action="search.php">
      <div id="custom-search-input">
        <div class="input-group col-md-5">
          <input type="text" class="form-control input-lg" name='search_id' placeholder="Enter Complaint ID" />
          <span class="input-group-btn">
              <button class="btn btn-info btn-lg" type="submit">
                  <i class="glyphicon glyphicon-search"></i>
              </button>
          </span>
        </div>
      </div>
    </form>
  </center>
  <h2 class="aa_h2" align="center">Search Results</h2>
  <div class="aa_htmlTable">

    <br />
    <div style="">
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
          $sql="Select * from complaints where State='$state' and Complaint_ID like '%$id%'";
          $result=mysqli_query($conn,$sql);
          $found=mysqli_num_rows($result);
          if(!$found)
          {
            echo "<h4 style=\"position:absolute; top:60%; left:60%\">--No Results Found--</h4>";
          }
          else
          {
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

