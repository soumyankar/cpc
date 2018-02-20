<?php
  include ("connect.php");

  if(isset($_POST['next']))
  {
  		$adhaar=$_POST['adhaar'];
    	$dob=$_POST['dob'];

    	header('location:quick_register.php');
  }
?>
<html>
<head>
	<title>Quick Complaint</title>

	<!-- Bootstrap Core CSS --><link href="css/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript"  src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>

    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>

    <script>

		(function($,W,D)
		{
			var JQUERY4U = {};

			JQUERY4U.UTIL =
			{
				setupFormValidation: function()
				{
					//form validation rules
					$("#quick_complaint").validate({
						rules: {
							adhaar: {
								required: true,
								minlength:12,
								maxlength: 12
							}
						},
						messages: {
							adhaar: {
								required: "Please provide your Correct Adhaar Number",
								minlength: "Incorrect Adhaar Number",
								maxlength: "Incorrect Adhaar Number"
							}						
						},
						submitHandler: function(form) {
							form.submit();
						}
					});
				}
			}

			//when the dom has loaded setup form validation rules
			$(D).ready(function($) {
				JQUERY4U.UTIL.setupFormValidation();
			});

		})(jQuery, window, document);


	</script>
</head>
<body>
	<h1 align="center">Register a Quick Complaint</h1>
	<div class="container">
		<div class="jumbotron">
			<form class="form-horizontal col-md-offset-3" id="quick_complaint" role="form" method="post" action="">
				<div class="form-group">
                    <label class="col-lg-3 control-label">Adhaar Card Number*</label>
                    <div class="col-lg-4">
                      <input class="form-control" name="adhaar" type="number" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Date of Birth*</label>
                    <div class="col-lg-3">
                      <input class="form-control" name="dob" type="date" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                      <input class="btn btn-primary" value="Next" name="next" type="submit">
                      <input class="btn btn-default" value="Cancel" type="reset" id="cancel">
                    </div>
                  </div>
			</form>
		</div>
	</div>

	<script type="text/javascript">
      $("#cancel").click(function(){
          
        window.location.href = 'index.php';
      });
    </script>

    <!-- jQuery -->
	<script src="js/jquery.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>

	<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>