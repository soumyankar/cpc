<html>
<head>
    <!--  <link rel="stylesheet" type="text/css" href="css/table.css">-->
    <!--  <link rel="stylesheet" type="text/css" href="css/form.css">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="css/agency.css" rel="stylesheet">
    <style>
        body {
            background-color: grey;
        }
        /*.aa_h2 {*/
            /*position: fixed;*/
            /*top:10%;*/
        /*}*/
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
            <a class="navbar-brand page-scroll" href="adminpage.php">Hotel
                Royals </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse"
             id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="adminpage.php" class="page-scroll"> Admin Page</a></li>
                <li><a href="logout.php" class="btn btn-primary"> Logout</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<h2 class="aa_h2"  style="position: fixed; left: 45%; top:10%;">All Messages</h2>
<div class="aa_htmlTable" style="position: fixed; top:20%;">
    <br />

    <div style="">
        <table align="center" style="width:70%;position: fixed; left: 20%;" border="2">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Message</th>
            </tr>
            </thead>
            <tbody>
            <?php
            include "connect.php";
            $sql="Select * from contact_us";
            $result=mysqli_query($conn,$sql);
            while($found=mysqli_fetch_array($result,MYSQLI_ASSOC))
            {
                ?>
                <tr>
                    <td><?php echo $found['ID']; ?></td>
                    <td><?php echo $found['Name']; ?></td>
                    <td><?php echo $found['Email']; ?></td>
                    <td><?php echo $found['Mobile']; ?></td>
                    <td><?php echo $found['Message']; ?></td>

                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>

