<?php
  include ("connect.php");

  if(isset($_POST['submit']))
  {
      $category=$_POST['category'];
      $complaint=$_POST['complaint'];
      $place=$_POST['iplace'];
      $date=$_POST['idate'];
      $curr_date=date("Y/m/d");
      $state=$_POST['state'];
      $district=$_POST['district'];
      $tehsil=$_POST['tehsil'];

      $sql="INSERT INTO quick_complaints (Category, Complaint, iPlace,iDate, Complaint_Date,State, District) VALUES ('$category','$complaint','$place','$date','$curr_date','$state','$district','$tehsil')";
      $query=mysqli_query($conn,$sql);
      if(!$query)
      {
        echo "Not Inserted". "<br>" . mysqli_error($conn);
      }
      else
      {
        echo "<script type='text/javascript'>alert('Complaint Registered!');</script>";
        header("location:index.php");
      }
  }
?>
<html>
<head>
	<title>Quick Complaint</title>

	<!-- Bootstrap Core CSS --><link href="css/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript"  src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>

    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>

</head>
<body>
	<h1 align="center">Register your Complaint</h1>
	<div class="container">
		<div class="jumbotron">
			<div class="right_col" role="main">
          <div class="container">
            <div class="row">
              
              <!-- edit form column -->
              <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
                <form class="form-horizontal" role="form" method="post" action="">
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Category</label>
                    <div class="col-lg-8">
                      <select name="category" class="form-control">
                        <option>--Not Specified--</option>
                        <?php
                          $sql2="Select * from categories";
                          $query2=mysqli_query($conn,$sql2);
                          while($found=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                          {
                              echo "<option>".$found['Category']."</option>";
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Complaint Details*</label>
                    <div class="col-md-8">
                      <textarea id="complaint" class="form-control" name="complaint" rows="7" ></textarea>
                    </div>
                    <img src="img/mic.png" style="height:30px;width:30px" id="start-button" onclick="toggle()">
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Incident Date</label>
                    <div class="col-lg-8">
                      <input class="form-control" type="date" name="idate">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Incident Place*</label>
                    <div class="col-lg-8">
                      <input class="form-control" type="text" name="iplace" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">PIN*</label>
                    <div class="col-lg-8">
                      <input class="form-control" type="number" name="pin" id="pincode" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">State*</label>
                    <div class="col-lg-8">
                      <input class="form-control" type="text" name="state" id="state">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">District*</label>
                    <div class="col-lg-8">
                      <input class="form-control" type="text" name="district" id="district">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">Tehsil/Taluk*</label>
                    <div class="col-lg-8">
                      <input class="form-control" type="text" name="tehsil" id="taluka">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                      <input class="btn btn-primary" value="Submit" name="submit" type="submit">
                      <input class="btn btn-default" value="Cancel" type="reset" id="cancel">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
		</div>
	</div>

	<script type="text/javascript">
      $("#cancel").click(function(){
          
        window.location.href = 'index.php';
      });
    </script>

    <!-- Speech to Text API Call -->
    <script type="text/javascript">
      var p=0;
      var k;
      function toggle()
      {
        
        if(p==0)
          {
            document.getElementById('start-button').src='img/red-mic.png';
            startDictation(event);
            p=1;
          }
        else
          {
            stop(event);
            p=0;
          }

      }
      var final_transcript = '';
      var recognizing = false;

      if ('webkitSpeechRecognition' in window) {

        var recognition = new webkitSpeechRecognition();

        recognition.continuous = true;
        recognition.interimResults = true;

        recognition.onstart = function() {
          recognizing = true;
        };

        recognition.onerror = function(event) {
          console.log(event.error);
        };

        recognition.onend = function() {
          recognizing = false;
        };

        recognition.onresult = function(event) {
          var interim_transcript = '';
          for (var i = event.resultIndex; i < event.results.length; ++i) {
            if (event.results[i].isFinal) {
              final_transcript += event.results[i][0].transcript;
              stop(event);
            } else {
              interim_transcript += event.results[i][0].transcript;
            }
          }
          final_transcript = capitalize(final_transcript);
          complaint.innerHTML=linebreak(final_transcript);
          if(k==0)
          complaint.innerHTML=linebreak(interim_transcript);
        };
      }

      var two_line = /\n\n/g;
      var one_line = /\n/g;
      function linebreak(s) {
        return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
      }

      function capitalize(s) {
        return s.replace(s.substr(0,1), function(m) { return m.toUpperCase(); });
      }
      function stop(event)
      {
        k=1;
        recognition.stop();
        document.getElementById('start-button').src='img/mic.png';
      }

      function startDictation(event) {
        k=0;
        if (recognizing) {
          k=1;
          recognition.stop();
          return;
        }
        final_transcript = '';
        recognition.lang = 'en-US';
        recognition.start();
        complaint.innerHTML = '';
        
      }
    </script>


    <script>
      $(document).ready(function() {
        $('#pincode').keyup(function(e) {
          var pincode = $(this).val();
          
          if(pincode.length == 6 && $.isNumeric(pincode)) {
            // var req = 'retrieve.php?pincode=' + pincode;
            // $.getJSON(req, null, function(data) {
              // $('#taluka').val(data.taluka);
              // $('#district').val(data.district);
              // $('#state').val(data.state);
            // });
          request = $.ajax({
            type: "post",
            url: "retrieve.php",
            data:{id:pincode},
            dataType: 'text'
                                        
          });
          request.done(function (response, textStatus, jqXHR){
                          // alert(response);
            if(response==-1)
              alert("Wrong pincode. Try again");
            var array =JSON.parse(response);

            $('#taluka').val(array.Taluk);
            $('#district').val(array.Districtname);
            $('#state').val(array.statename);

          })


          };
        });
      });
    </script>


    <!-- jQuery -->
	<script src="js/jquery.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>

	<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>