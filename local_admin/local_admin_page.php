<?php
    include ("../connect.php");
    session_start();
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
  <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
  <link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
  <link rel="stylesheet" type="text/css" href="../vendor/perfect-scrollbar/perfect-scrollbar.css">
  <link rel="stylesheet" type="text/css" href="../css/util.css">
  <link rel="stylesheet" type="text/css" href="../css/main.css">
<!--  <link rel="stylesheet" type="text/css" href="css/table.css">-->
<!--  <link rel="stylesheet" type="text/css" href="css/form.css">-->
  <title>Local Admin</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="../css/agency.css" rel="stylesheet">
  <script type="text/javascript"  src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
  <style>
    body {
      /*background-color: #ccccff;*/
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
      <a class="navbar-brand page-scroll" href="local_admin_page.php">Local Admin</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse"
         id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
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
          <input type="text" class="form-control input-lg" name='search_id' placeholder="Enter Credit ID" />
          <span class="input-group-btn">
              <button class="btn btn-info btn-lg" type="submit">
                  <i class="glyphicon glyphicon-search"></i>
              </button>
          </span>
        </div>
      </div>
    </form>
  </center>
  <?php
      $sql3="Select * from users";
                      $query3=mysqli_query($conn,$sql3);
                      $found2=mysqli_num_rows($query3);
                      if(!$found2)
                      {
                        echo "<h4 style=\"position:absolute; top:60%; left:60%\">--No Users :(--</h4>";
                       }
                      else
                      {
                        while($found2=mysqli_fetch_array($query3,MYSQLI_ASSOC))
                        {

  ?>
  <h2 class="aa_h2 container" align="center">User: <?php echo $found2['First_Name']." ".$found2['Last_Name'] ?></h2>
    <div class="container limiter">
    <div class="container ">
      <div class="container wrap-table100">
        
        <div class="container table100 ver3 m-b-110">
          <div class="container table100-head">
            <table>
              <thead>
                <tr class="container row100 head">
                  <th class="cell100 column1">Category</th>
                  <th class="cell100 column2">City/Town</th>
                  <th class="cell100 column3">Work Shift</th>
                  <th class="cell100 column4">Uploaded Documents?</th>
                  <th class="cell100 column5">Credits Scored</th>
                </tr>
              </thead>
            </table>
          </div>

          <div class="table100-body js-pscroll">
            <table>
              <tbody> 
                <?php
                      $hash=$found2['hash_id'];
                      $sql2="Select * from add_credits where hash_id='$hash' ";
                      $query2=mysqli_query($conn,$sql2);
                      $found=mysqli_num_rows($query2);
                      if(!$found)
                      {
                        echo "<td style=\"cell100 column3\"><b>--No Uploads :(--</b></td>";
                       }
                      else
                      {
                        while($found=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                        {
                ?>
                <tr class="row100 body">
                  <td class="cell100 column1"><?php echo $found['Category'] ?></td>
                  <td class="cell100 column2"><?php echo $found['city'].",".$found['country'] ?></td>
                  <td class="cell100 column3"><?php echo $found['work_shift'] ?></td>
                  <td class="cell100 column4"><?php echo "YES" ?></td>
                  <td class="cell100 column5"><?php echo $found['credit'] ?></td>
                </tr>
                <?php
              }
            }
            ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
        <?php
        }
      }
        ?>
</section>
  <script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
  <script src="../vendor/bootstrap/js/popper.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="../vendor/select2/select2.min.js"></script>
  <script src="../vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
  <script>
    $('.js-pscroll').each(function(){
      var ps = new PerfectScrollbar(this);

      $(window).on('resize', function(){
        ps.update();
      })
    });
      
    
  </script>
  <script src="../js/main.js"></script>

</body>
</html>

