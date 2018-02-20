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
  <script type="text/javascript"  src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
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
        <li><a href="../logout.php" class="btn btn-primary"> Logout</a></li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>
<section>
  <h2 align="center">Complaints Status Filter</h2><br>

  <center>
    <?php
      $sql="Select * from categories";
      $query=mysqli_query($conn,$sql);
      while($result=mysqli_fetch_assoc($query))
      {
        echo '<a class="btn btn-success category" data-id="'.$result['Category'].'">'.$result['Category'].'</a>&nbsp&nbsp';
      }
    ?>
  </center>

  <br>
  <div id="show_details"></div>


    <!-- <table align="center" border="5" style="position: absolute;top:25%;left:15%;">
      <thead>
        <tr>
          <th>Complaint ID</th>
          <th>Complainant Name</th>
          <th>Complainant Email</th>        
          <th>Complainant Mobile</th>
          <th>Complaint Details</th>
          <th>Documents</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $sql="Select * from complaints where Complaint_Status='Pending'";
          $result=mysqli_query($conn,$sql);
          $found=mysqli_num_rows($result);
          if(!$found)
          {
            echo "<h4 style=\"position:absolute; top:35%; left:40%\">--No Complaints--</h4>";
          }
          else
          {
            while($found=mysqli_fetch_array($result,MYSQLI_ASSOC))
            {
              $id=$found['user_id'];
              $sql2="Select * from users where ID='$id'";
              $query=mysqli_query($conn,$sql2);
              $user=mysqli_fetch_array($query,MYSQLI_ASSOC);
              $c_id=$found['ID'];
              ?>
              <tr>
                <td><?php echo $c_id; ?></td>
                <td><?php echo $user['First_Name']. " " . $user['Last_Name']; ?></td>
                <td><?php echo $user['Email']; ?></td>
                <td><?php echo $user['Mobile']; ?></td>
                <td><a class="btn btn-success" href="admin_complaints.php?c_id=<?php echo $c_id; ?>">See Complaint Details</a></td>
                <td><a class="btn btn-success" href="download_doc.php?c_id=<?php echo $c_id; ?>&user_id=<?php echo $id; ?>">Download Document</a></td>
              </tr>
              <?php
            }
          }  
        ?>
      </tbody>
    </table> -->

</section>

<script type="text/javascript">
  $('.category').click(function() {
    var filter = $(this).data('id');
    // console.log(filter);
    $.post('category_filter.php',{filter:filter},function(data){
      $('#show_details').html(data);
    });
  });
</script>

</body>
</html>