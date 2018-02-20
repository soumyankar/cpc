<?php
    session_start();
    include ("../connect.php");

    if(isset($_SESSION['local_admin']))
    {
        header("location:local_admin_page.php");
    }
    if(isset($_POST['login']))
    {
        $state=$_POST['state'];
        $pass=$_POST['pass'];

        // var_dump($state .$pass);

        $sql="Select * from admins where State='$state' and Password='$pass'";
        $query=mysqli_query($conn,$sql);
        $result=mysqli_fetch_assoc($query);
        if($result)
        {
            $_SESSION['local_admin']=$state;
            header("location:local_admin_page.php");
        }
        else
        {
            echo "<h4 style=\"position:absolute; top:45%; left:35%\"><span class=\"glyphicon glyphicon-warning-sign\">&nbspIncorrect Credentials</span></h4>";
        }
    }
?>

<html>
<head>
    <title>Local Authority</title>
    <link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="../css/agency.css" rel="stylesheet">


    <style>
        body {
            background-color: grey;
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
                <a class="navbar-brand page-scroll" href="local_login.php">Local Authority Login</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse"
                 id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../index.php" class="btn btn-primary">Home Page</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>


    <div class="col-md-8 col-sm-6 col-xs-12 personal-info" style="position:absolute; top:15%; left:20%;">      
          <form class="form-horizontal" role="form" method="post" action="">
          <h1 align="center" class="form-group">Please Login</h1>
              <div class="form-group">
                  <label class="col-lg-3 control-label">Username*</label>
                  <div class="col-lg-5">
                    <input class="form-control" type="text" name="state">
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
                  <div class="col-md-5">
                    <input class="btn btn-primary" value="Submit" name="login" type="submit">
                  </div>
                </div>
            </form>
    </div>

</body>
</html>
