<?php
    session_start();
    include ("../connect.php");
    $id=$_GET['id'];
    $state=$_SESSION['local_admin'];
    if(isset($_POST['send']))
    {
        $remarks=$_POST['remarks'];
        $authentic=$_POST['authentic'];

        if($authentic=="Yes")
            $sql="UPDATE complaints SET Complaint_Status='Interim Disposal' where Complaint_ID='$id'"; 
        else if($authentic=="No")
            $sql="UPDATE complaints SET Complaint_Status='In Admissible' where Complaint_ID='$id'";
        $query=mysqli_query($conn,$sql);
        if(!$query)
            echo "Not Updated!". "<br>" . mysqli_error($conn);

        $sql="INSERT INTO admin_responses(Complaint_ID,Remarks,Authentic) VALUES ('$id','$remarks','$authentic')";
        $query=mysqli_query($conn,$sql);
        if(!$query)
        {
            echo "Not Inserted". "<br>" . mysqli_error($conn);
        }

        if($_FILES['doc'])
        {
            $flag=true;
            foreach ($_FILES['doc']['name'] as $filename) 
            {
              $parts = pathinfo($filename);
              if (false == ($parts["extension"]=="pdf" or $parts["extension"]=="jpg" or $parts["extension"]=="jpeg" or $parts["extension"]=="png"))
                {
                  $flag=false;
                  break;
                }
            }

            if($flag)
            {
              $count=0;
              foreach ($_FILES['doc']['name'] as $filename) 
              {
                $parts = pathinfo($filename);
                $tmp=$_FILES['doc']['tmp_name'][$count];
                $count=$count + 1;
                $name=getcwd(). "/admin_uploads/" . $id . "_". $state . "_" . $count. "." . $parts["extension"];
                // var_dump($name);
                move_uploaded_file($tmp,$name);

              }
                
              $sql="UPDATE admin_responses set Docs = 'yes' where Complaint_ID = '$id'";
              $query=mysqli_query($conn,$sql);
              if(!$query)
              {
                echo "not updated" . mysqli_error($conn);
              }
              else
                // echo "Updated";
                header("location: local_admin_page.php?response=true");
              
            }
            else
              echo "<script>alert('Only pdf and image files are allowed');</script>";
        }
        else
            header("location: local_admin_page.php?response=true");
            
    }
?>

<html>
<head>
    <title>Local Authority</title>

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
                <a class="navbar-brand page-scroll" href="local_admin_page.php">Local Admin for <?php echo $state; ?></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse"
                 id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="admin_logout.php" class="btn btn-primary">Logout</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>


    <div class="col-md-8 col-sm-6 col-xs-12 personal-info" style="position:absolute; top:15%; left:20%;">
        <h1 align="center">Response Form</h1>
        <form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-md-3 control-label">Remarks*</label>
            <div class="col-md-8">
              <textarea class="form-control" name="remarks" rows="5" required></textarea>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Upload Supporting Documents (if any)</label>
            <div class="col-lg-4">
              <input class="form-control" type="file" name="doc[]" multiple>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Is this Complaint Authentic?</label>
            <div class="col-lg-2">
              <select name="authentic" class="form-control">
                  <option>Yes</option>
                  <option>No</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input class="btn btn-primary" value="Send" name="send" type="submit">
              <input class="btn btn-default" value="Cancel" type="reset" id="cancel" onclick="window.location.href='local_admin_page.php'">
            </div>
          </div>      
        </form>
    </div>

</body>
</html>
