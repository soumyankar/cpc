
<?php
  include ("../connect.php");
  session_start();
  $c_id=$_GET['id'];
?>
<html>
<head>
  <title>Local Admin </title>

  <script type="text/javascript"  src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
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
    h4,h3,h2,p {
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
      <a class="navbar-brand page-scroll" href="local_admin_page.php">NCPCR Admin</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse"
         id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php" class="btn btn-primary"> Logout</a></li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>
<section>
  <h2>Response of Local Authority to the complaint:</h2><br>
  <h3>Remarks:</h3><br>
    <?php 
      $sql="Select * from admin_responses where Complaint_ID = '$c_id'";
      $query=mysqli_query($conn,$sql);
      $result=mysqli_fetch_assoc($query);
      echo "<p>".$result['Remarks'] . "</p>";
    ?>
    <br><h3>Authentic:</h3>
    <?php
      echo "<p>".$result['Authentic'] . "</p>";
    ?>
    
</section>


</body>
</html>

