<?php 
session_start(); 
include ("connect.php");
include "creds.php";
include "swiftmailer/lib/swift_required.php";
include "HashGenerator.php";

if(isset($_SESSION['user_id']))
	header("location:home.php");

if(isset($_POST['Register'])){

	    $fname=$_POST["fname"];
	    $lname=$_POST["lname"];
	    if(isset($_POST['bday']))
	    $bday=$_POST['bday'];
	    $email=$_POST["email"];
      	if(isset($_POST['qualify']))
      		$qualify=$_POST['qualify'];
      	if(isset($_POST['gender']))
      		$gender=$_POST['gender'];
      	if(isset($_POST['qualify1']))
      		$qualify1='YES';
      	if(isset($_POST['qualify2']))
      		$qualify2='YES';
  		if(isset($_POST['qualify3']))
      		$qualify3='YES';
  		if(isset($_POST['qualify4']))
      		$qualify4='YES';
      	if(isset($_POST['qualify5']))
      		$qualify5='YES';
      	if(isset($_POST['qualify6']))
      		$qualify6='YES';
  		if(isset($_POST['qualify7']))
      		$qualify7='YES';
      	
      	if(isset($_POST['occu']))
      		$occu=$_POST['occu'];
	    $mob=$_POST["mobile"];
	    $pass=$_POST['password'];
	    $address=$_POST['address'];
	    $city=$_POST['city'];
	    $country=$_POST['country'];
	    $pin=$_POST['pin'];
	    $motivates=$_POST['mot'];
	    $experience=$_POST['volun'];
	    $sql="INSERT INTO `users` (`ID`, `hash_id`, `First_Name`, `Middle_Name`, `Last_Name`, `Age`, `Gender`, `Email`, `Password`, `Mobile`, `DOB`, `qualification`, `hindi_lang`, `english_lang`, `mandarin_lang`, `french_lang`, `spanish_lang`, `russian_lang`, `other_lang`, `Nationality`, `Address`, `City/Town`,`country, `PIN`, `motivation`, `extra_info`, `occupation`, `User_Type`, `isComplete`) VALUES (NULL, '', '$fname', NULL, '$lname', NULL, '$gender', '$email', '$pass', '$mob', '$bday','$qualify', '$qualify1', '$qualify2', '$qualify3', '$qualify4', '$qualify5', '$qualify6', '$qualify7', NULL, '$address', '$city','$country, '$pin', '$motivates', '$experience', '$occu', NULL, 'No')";
    	$query=mysqli_query($conn,$sql);
    	if(!$query)
    	{	
    		echo "Not Inserted" . mysqli_error($conn);	  	
		}
		
	  	header("location: index.php?registered=true");
		}	
		$sql2="Select LAST_INSERT_ID() as ID";
      	$query2=mysqli_query($conn,$sql2);
      	$result2=mysqli_fetch_assoc($query2);
      	$c_id=($result2['ID']);
        $obj = new HashGenerator;
        $hash_id = $obj->encode($c_id);
        $sql3="UPDATE users SET hash_id='$hash_id' WHERE ID='$c_id'";
        $query=mysqli_query($conn,$sql3);
        if(!$query)
        {
          echo "Not Updated". "<br>" . mysqli_error($conn);
        }
      
		//send message to mobile
	    // $x = SendSMS("127.0.0.1", 8800, "username", "password", $mob, $msg);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="rohan_panda">
    <meta name="viewport" class="container-fluid" content="width=device-width, initial-scale=1">


	<title>CPC</title>

	<!-- Bootstrap Core CSS --><link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom CSS --><link href="css/agency.css" rel="stylesheet">
	<!-- <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->
	<link rel="stylesheet" href="css/login.css" type="text/css">
	<script type="text/javascript"	src="http://ajax.googleapis.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
	<script src="js/jquery.md5.js"></script>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<!-- Validation  --><script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>

	<script>

	<!-- For Registration -->
		(function($,W,D)
		{
			var JQUERY4U = {};

			JQUERY4U.UTIL =
			{
				setupFormValidation: function()
				{
					//form validation rules
					$("#register-form").validate({
						rules: {
							name: "required",
							mobile: {
								required: true,
								maxlength: 10
							},
							email: {
								required: true,
								email: true,
								remote: "check_email.php"
							},
							password: {
								required: true,
								minlength: 5
							},
							captcha_code: {
								required: true,
								remote: "process.php"
							}
						},
						messages: {
							name: "Please enter your Full Name",
							mobile: {
								required: "Please provide a Mobile Number",
								maxlength: "Incorrect Mobile Number"
							},
							password: {
								required: "Please provide a Password",
								minlength: "Your password must be at least 5 characters long"
							},
							email: {
								required: "Please enter a valid Email Address",
								remote: "This Email is Already Registered"
							},
							captcha_code: {
	                            required: "Please Enter The Captcha Code",
	                            remote: "Captcha is Incorrect!"
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

	<script>
		function refreshCaptcha(){
			var img = document.images['captchaimg'];
			img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
		}

	</script>

</head>

<body id="page-top" class="index">

	<!-- Navigation -->
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
				<!-- <a class="navbar-brand page-scroll" href="index.html">NCPCR </a> -->
				<!-- <a href="index.php"><img src="img/logo.jpeg" class="avatar img-circle" height="100" width="100"></a> -->
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse"
				id="bs-example-navbar-collapse-1">

				<ul class="nav navbar-nav navbar-right">
					<li class="hidden"><a href="#page-top"></a></li>
					<li><a class="page-scroll" href="index.php"><b>Home</b></a></li>
					<li><a class="page-scroll" href="#"><b>About CPC</b></a></li>
					<li><a class="page-scroll" href="local_admin/local_login.php"><b>Local Authority Login</b></a></li>			
					<li><a class="page-scroll" href="#"><b>Help</b></a></li>					
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container-fluid -->
	</nav>

	<!-- Header -->




<section class="mySection" style="background-image: url('https://i.imgur.com/WhJDgIr.jpg') " >

		<div class="container-fluid col-md-offset-7 login_section" >
		    <form class="form-signin" id="login_form" action="" method="post" style="background-color: rgba(255,255,255,0.4);">       
				<h3 class="form-signin-heading" align="Center" style="background-color: rgba(255,255,255,0);">Please login</h3>
				<input type="text" class="form-control" id="email" name="login_email" placeholder="Email Address" required autofocus="" style="background-color: rgba(255,255,255,0.7);" />
				<input type="password" class="form-control" name="login_pass" id="password" placeholder="Password" required/>
				<br>
			    <center>
					<div id="msgbox" style="font-size: 18px;"> 
						<span id="msgbox"></span> 
					</div> 
				</center>    

				<button class="btn btn-lg btn-primary btn-block" type="submit" id="login" name="Login">Login</button> 
				<p class="form-signin-heading" align="Center">OR</p>  
				<button class="btn btn-lg btn-danger btn-block register_modal" type="button">Register</button>
				<!-- <h3 class="form-signin-heading" align="Center">----</h3>   -->
				
				
		    </form>

		</div>

		<!-- <div id="body">
			<div id="featured">
				<div>
					<h2>National Commission for Protection of Child Rights</h2>
					<span>Our website is created with</span>
					<span>inspiration, checked for quality and originality</span>
					<span>and meticulously sliced and coded.</span>
				</div>
			</div>
		</div> -->

		<!-- <div class= 'col-xs-4' style="position:absolute;top:25%;height: 55%;width: 400px; overflow: scroll;">
		<a class="twitter-timeline" href="https://twitter.com/NCPCR_">Tweets by NCPCR_</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
		</div> -->

		<!-- <div  class='col-md-4'><a href="https://twitter.com/NCPCR_" class="twitter-follow-button" data-show-count="false">Follow @NCPCR_</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
		</div> -->
		

</section>


	<footer>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4">
					<span class="copyright">Copyright &copy; Pyanweb</span><br>
					Contact us: <span class="glyphicon glyphicon-envelope">audi.kd8060@gmail.com</span>
				</div>
				<div class="col-md-4">
					<ul class="list-inline social-buttons">
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
					</ul>
				</div>
				<div class="col-md-4">
					<ul class="list-inline quicklinks">
						<li><a href="#">Privacy Policy</a></li>
						<li><a href="#">Terms of Use</a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>


<!-- <p>DISCLAIMER : Neither National Informatics Centre or The Office of National Commission for Protection of Child Rights (NCPCR) is responsible for any inadvertent error that may have crept in the information being published on internet.<br>
NOTE : For further details kindly contact National Commission for Protection of Child Rights, 5th Floor,Chanderlok Building ,36 Janpath, New Delhi, PIN 110001
it[dot]ncpcr[at]nic[dot]in Tel.No. 23478200 Fax No. 23724026</p> -->


	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">×</button>
					<h4 class="modal-title" id="myModalLabel">
						Registration Form 
					</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-8">
							<br>								
							<div class="tab-pane" id="Registration">
								<form role="form" action="" method="post" id="register-form">
					       			<div id="form-content" class="form-group">
					        			<fieldset>
					        				<div class="row">
						            			<div class="form-group col-sm-4">
						                			<label for="name">First Name</label>
						                		</div>
						                		<div class="form-group col-sm-8">
						               			    <input type="text" name="fname" class="form-control" placeholder="Enter your First Name" required/>
						            			</div>
						            		</div>

						            		<div class="row">
						            			<div class="form-group col-sm-4">
						                			<label for="name">Last Name</label>
						                		</div>
						                		<div class="form-group col-sm-8">
						               			    <input type="text" name="lname" class="form-control" placeholder="Enter your Last Name" required/>
						            			</div>
						            		</div>

						            		<div class="row">
						            			<div class="form-group col-sm-4">
						                			<label for="name">Gender</label>
						                		</div>
						            			<div class="form-group col-sm-8">
						            				<form>
  														<input type="radio" name="gender" value="male" > Male<br>
  														<input type="radio" name="gender" value="female"> Female<br>
  														<input type="radio" name="gender" value="not"> Prefer Not to answer<br>
  														<input type="radio" name="gender" value="other"> Other<br>
													</form>	
												</div>
					 						</div>

					 						<div class="row">
						            			<div class="form-group col-sm-4">
					                				<label for="birth">Date Of Birth</label>
					                			</div>
					                			<div class="form-group col-sm-8">
					                				<form>
		  												<input type="date" method="POST" name="bday">
													</form> 
					            				</div>
											</div>

											<div class="row">
						            			<div class="form-group col-sm-4">
					                				<label for="qualify">Educational Qualifications</label>
					                			</div>
					                			<div class="form-group col-sm-8">
					                				<select name="qualify" class="form-control">
					                					<option>--Not Specified--</option>
                       										 <?php
                          										$sql2="Select * from educational_qualification";
                          										$query2=mysqli_query($conn,$sql2);
                          										while($found=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                          										{
                         										     echo "<option>".$found['Category']."</option>";
                          										}
                        										?>
                     								 </select>
					            				</div>
											</div>

											<div class="row">
						            			<div class="form-group col-sm-4">
					                				<label for="lang">Languages Known</label>
					                			</div>
					                			<div class="form-group col-sm-8">
					                				<form>
  														<input type="checkbox" name="qualify1" value="hnd">Hindi<br>
  														<input type="checkbox" name="qualify2" value="eng">English<br> <input type="checkbox" name="qualify3" value="mnd">Mandarian<br>
  														<input type="checkbox" name="qualify4" value="frn">French<br>
  														<input type="checkbox" name="qualify5" value="span">Spanish<br>
  														<input type="checkbox" name="qualify6" value="rus">Russian<br>
  														<input type="checkbox" name="qualify7" value="oth">Other
													</form>
					            				</div>
											</div>
											
											<div class="row">
									            <div class="form-group col-sm-4">
									                <label for="email">Email</label>
									             </div>
									             <div class="form-group col-sm-8">
									                <input type="email" name="email" class="form-control" placeholder="Enter your Email Address" required/>
									            </div>
									        </div>

									        <div class="row">
									            <div class="form-group col-sm-4">
									                <label for="email">Password</label>
									             </div>
									             <div class="form-group col-sm-8">
									                <input type="password" name="password" class="form-control" placeholder="Enter your Password" required/>
									            </div>
									        </div>
									        
									        <div class="row">
									            <div class="form-group col-sm-4">
									                <label for="address">Address</label>
									             </div>
									             <div class="form-group col-sm-8">
									                <textarea id="complaint" class="form-control" name="address" rows="7"></textarea>
									            </div>
									        </div>

									        <div class="row">
						            			<div class="form-group col-sm-4">
					                				<label for="mobile">Mobile(+91)</label>
					                			</div>
					                			<div class="form-group col-sm-8">
					                				<input type="number" name="mobile" class="form-control" placeholder="Enter your Mobile Number" required />
					            				</div>
											</div>

											<div class="row">
									            <div class="form-group col-sm-4">
									                <label for="city">City/Town</label>
									             </div>
									             <div class="form-group col-sm-8">
									                <input type="name" name="city" class="form-control" placeholder="Enter the city name" required/>
									            </div>
									        </div>

									        <div class="row">
									            <div class="form-group col-sm-4">
									                <label for="state">Country</label>
									             </div>
									             <div class="form-group col-sm-8">
									                <input type="name" name="country" class="form-control" placeholder="Enter the state name" required/>
									            </div>
									        </div>

									        <div class="row">
									            <div class="form-group col-sm-4">
									                <label for="pin">Pincode</label>
									             </div>
									             <div class="form-group col-sm-8">
									                <input type="pin" name="pin" class="form-control" placeholder="Enter the pin code" required/>
									            </div>
									        </div>

									        <div class="row">
									            <div class="form-group col-sm-4">
									                <label for="mot">What motivates you to join cyber peace corps?</label>
									             </div>
									             <div class="form-group col-sm-8">
									                <textarea id="complaint" class="form-control" name="mot" rows="7" placeholder="Try to highlight here how your experience and background will add value"></textarea>
									            </div>
									        </div>

									        <div class="row">
									            <div class="form-group col-sm-4">
									                <label for="mot">Have you volunteered with other organization(s) ? If yes, mention the name of the organization(s) and your role.</label>
									             </div>
									             <div class="form-group col-sm-8">
									                <textarea id="complaint" class="form-control" name="volun" rows="7"></textarea>
									            </div>
									        </div>

									        <div class="row">
						            			<div class="form-group col-sm-4">
						                			<label for="name">Occupation</label>
						                		</div>
						            			<div class="form-group col-sm-8">
						            				<form method="POST">
  														<input type="radio" name="occu" value="Stud" >Student<br>
  														<input type="radio" name="occu" value="female">Professional<br>
  														<input type="radio" name="occu" value="other">Other<br>
													</form>	
												</div>
					 						</div>

									        <br>
									        <div class="row">
									            <div class="form-group col-sm-4">
									                <label for='captcha'>Captcha</label>
									            </div>
									            <div class="form-group col-sm-8">
									            <img src="captcha.php?rand=<?php echo rand();?>" id='captchaimg'>
									                <br><br>
											        <input id="captcha_code" name="captcha_code"  class="form-control" type="text" placeholder="Enter the code above" required>
											        <br>
											        Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh.
									            </div>
									        </div>									        
											<div class="row">
									            <div class="form-group col-sm-4">
									                <button type="submit" name="Register" class="submit btn btn-md btn-success">Register</button>
										            </div>
										        </div>
										    </div>   
									    </fieldset>
						    		</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- jQuery -->
	<!-- <script src="js/jquery.js"></script> -->

	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>

	<!-- Plugin JavaScript -->
	<!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
	<script src="js/classie.js"></script>
	<script src="js/cbpAnimatedHeader.js"></script> -->

	<!-- Contact Form JavaScript -->
	<script src="js/jqBootstrapValidation.js"></script>
	<script src="js/contact_me.js"></script>

	<!-- Custom Theme JavaScript -->
	<script src="js/agency.js"></script>

	<script type="text/javascript">

		$('.register_modal').click(function(){
			$('#myModal').modal('show');
		});

	</script>

	<script>
        var x=window.location.search.substring(1),y;
        if(x)
        {
            y=x.split('=');
//                console.log(y[0]);
			if(y[0]=='registered')
            	alert("Registration Successful! \nPlease Login to Continue.");
        }
    </script>

    <script type="text/javascript">

    	$('#login').click(function() {
    		
	    	var pass = $('#password').val();
	    	var email = $('#email').val();

	  //   	var salt = "HighSecurity";
	  //       var strMD5 = $.md5(pass);
			// var strMD52 = $.md5(salt);
			// var saltEnc = strMD52+strMD5;
			// console.log('saltEnc');
			// $('#password').val(saltEnc);

			$("#msgbox").addClass('error-warning').html('Validating....').fadeIn(1000);

			$.post("ajax_login.php",{ login_email:email,login_pass:pass },function(data) {
				// console.log(data);
				if($.trim(data)=="Admin")
				{
					$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('Logging in.....').addClass('error-success').fadeTo(900,1,
		              function()
					  {
						 
						 document.location='admin/adminpage.php';
					  });
					  
					});
				}
				else if ($.trim(data)=="Error") 
				{
					$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $("#msgbox").html('<span style="color:red">Incorrect Email Id or Password!</span>').addClass('error-warning').fadeTo(900,1);
					  
					});

				}
				else 
				{
					$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('Logging in.....').addClass('error-success').fadeTo(900,1,
		              function()
					  {
						 document.location='home.php';
					  });
					  
					});
				}
			});
			return false;
		});
    </script>
		
</body>

</html>
