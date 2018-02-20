<?php
    include ("../connect.php");
    session_start();
?>
<html>
<head>
<!--  <link rel="stylesheet" type="text/css" href="css/table.css">-->
<!--  <link rel="stylesheet" type="text/css" href="css/form.css">-->
  <title>NCPCR Admin </title>
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
    td,th {
      width:50px;
      padding: 1em;
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
        <li><a href="../logout.php" class="btn btn-primary"> Logout</a></li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>

  
<section>
  <h1 align="center">What do you want to see?</h1>
  <div style="position: absolute;left:40%;top:30%;">
    <div class="row">         
        <div  class="btn-group-vertical">    
          <a href="all_complaints.php" class="btn btn-warning btn-block btn-lg">All Complaints</a><br>
          <a href="show_status.php" class="btn btn-success btn-block btn-lg">Complaints Status</a><br>
          <a href="state_wise.php" class="btn btn-warning btn-lg">State Wise Complaints</a><br>
          <a href="category.php" class="btn btn-success btn-lg">Category Wise Complaints</a><br>
        </div>
      </div>
  </div>
</section> 

</body>
</html>

