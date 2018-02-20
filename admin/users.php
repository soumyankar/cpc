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
      padding: 1em;
      border: 2px solid black;
    }
    td {
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
        <li><a href="../logout.php" class="btn btn-primary"> Logout</a></li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>
<section>
  <h2 class="aa_h2" align="center">All Users</h2>
  <div class="aa_htmlTable">
    <div style="">
    <table align="center" border="5">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>        
          <th>Mobile</th>
          <th>Age</th>
          <th>Gender</th>
          <th>DOB</th>
          <th>State</th>
          <th>District</th>
          <th>PIN</th>
          <th>User Type</th>
          <th>Profile Complete</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $sql="Select * from users";
          $result=mysqli_query($conn,$sql);
          $user=mysqli_num_rows($result);
          if(!$user)
          {
            echo "<h4 style=\"position:absolute; top:60%; left:60%\">No Users</h4>";
          }
          else
          {
            while($user=mysqli_fetch_array($result,MYSQLI_ASSOC))
            {
              ?>
              <tr>
                <td><?php echo $user['ID']; ?></td>
                <td><?php echo $user['First_Name']. " " . $user['Middle_Name']. " " . $user['Last_Name']; ?></td>
                <td><?php echo $user['Email']; ?></td>
                <td><?php echo $user['Mobile']; ?></td>
                <td><?php echo $user['Age']; ?></td>
                <td><?php echo $user['Gender']; ?></td>
                <td><?php echo $user['DOB']; ?></td>
                <td><?php echo $user['State']; ?></td>
                <td><?php echo $user['District']; ?></td>
                <td><?php echo $user['PIN']; ?></td>
                <td><?php echo $user['User_Type']; ?></td>
                <td><?php echo $user['isComplete']; ?></td>
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
</body>
</html>

