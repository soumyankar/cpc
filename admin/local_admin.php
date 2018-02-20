<?php
    include ("../connect.php");
    if(isset($_POST['create']))
    {
        $state=$_POST['state'];
        $pass=$_POST['pass'];

        $sql="Insert INTO admins(State,Password) VALUES ('$state','$pass')";
        $query=mysqli_query($conn,$sql);
        if (!$query) {
          echo "NOT INSERTED" . mysqli_error($conn);
        }
        // echo "<script>alert('New admin added');</script>";
        header('location: local_admin.php');
    }


?>
<html>
<head>
<!--  <link rel="stylesheet" type="text/css" href="css/table.css">-->
<!--  <link rel="stylesheet" type="text/css" href="css/form.css">-->
  <title>New Admin </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="../css/agency.css" rel="stylesheet">
  <style>
    body {
      background-color: grey;
    }

    /*td,th {
      padding: 1em;
    }*/
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
        <li><a href="adminpage.php" class="page-scroll"> Admin Page</a></li>
        <li><a href="../logout.php" class="btn btn-primary"> Logout</a></li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>
<h2 class="aa_h2"  style="position: fixed; left: 45%; top:10%;">All Admins</h2>
<div class="aa_htmlTable" style="position: fixed; top:20%;">

  <br />
  <div style="width:100%;height:50%;overflow-y: scroll;">
  <table align="center" style="width:25%;position: fixed; left: 40%;" border="2">
    <thead>
      <tr>
        <th>Admin ID</th>
        <th>State</th>
        <!-- <th>Password</th> -->
      </tr>
    </thead>
    <tbody>
      <?php
        $sql="Select * from admins";
        $result=mysqli_query($conn,$sql);
        while($found=mysqli_fetch_array($result,MYSQLI_ASSOC))
        {
          ?>
          <tr>
            <td><?php echo $found['ID']; ?></td>
            <td><?php echo $found['State']; ?></td>
            <!-- <td><?php echo $found['Password']; ?></td> -->
          </tr>
          <?php
        }
      ?>
    </tbody>
  </table>
</div>
</div>
<div class="container" style="position: fixed; top: 50%; left: 25%;">
  <h2 style="margin-left: 200px;">Add Local Admin</h2>
  <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
      <form class="form-horizontal" role="form" method="post" action="">
          <div class="form-group">
              <label class="col-lg-3 control-label">State*</label>
              <div class="col-lg-5">
                <select name="state" class="form-control">
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
              </div>
          </div>
          <br>
          <div class="form-group">
              <label class="col-lg-3 control-label">Password*</label>
              <div class="col-lg-5">
                <input class="form-control" type="Password" name="pass">
              </div>
          </div>
          
          <div class="form-group">
              <label class="col-md-3 control-label"></label>
              <div class="col-md-8">
                <input class="btn btn-primary" value="Create" name="create" type="submit">
                <!-- <input class="btn btn-default" value="Cancel" type="reset" id="cancel"> -->
              </div>
          </div>
      </form>
  </div>
</div>


</body>
</html>

