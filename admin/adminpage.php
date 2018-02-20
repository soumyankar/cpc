<html>
<head>
    <title>Admin page</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/agency.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/admin.css">


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
                <a class="navbar-brand page-scroll" href="../index.php">NCPCR ADMIN PAGE</a>
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


    <div style="position:fixed; top:15%; left:40%;">
        <img src="http://swiftexpressdelivery.com/images/login_key1.png" height="150" width="200">
        <h1>Welcome Admin</h1>
        <form>
            <input class="button-link" type="button" value="Users" onclick="window.location.href='users.php'" />
        </form>
        <form>
            <input class="button-link" type="button" value="Complaints" onclick="window.location.href='display_complaints.php'" />
        </form>
        <form>
            <input class="button-link" type="button" value="Local Admins" onclick="window.location.href='local_admin.php'" />
        </form>
    </div>

</body>
</html>
