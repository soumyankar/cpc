<?php
  session_start();
  include "connect.php";
  $id=$_SESSION['user_id'];
  $sql="Select * from users where ID='$id'";
  $query=mysqli_query($conn,$sql);
  $result=mysqli_fetch_assoc($query);
  ?>
<html>
<head>
  <title>Add Credits</title>
 
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
              qualify: {
                required: true,
                minlength:5,
              }
              city: {
                required: true,
                minlength:5,
              }
              country: {
                required: true,
                minlength:5,
              }
              complaint: {
                required: true,
                minlength:5,
              }
              description: {
                required: true,
                minlength: 10,
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
  <h1 align="center">Add Credits</h1>
  <div class="container">
    <div class="jumbotron">
      <form class="form-horizontal col-md-offset-3" id="quick_complaint" role="form" method="POST" enctype="multipart/form-data" action="upload.php" >
            
        <div class="form-group">
              <label class="col-lg-3 control-label">Category</label>
              <div  class="col-md-offset-3" align="center" >
              
             </div>
                    <div class="col-lg-4" style="margin-top: 10px"> 
             <!-- class="col-sm-8" -->
                      <select name="category" class="form-control">
                        <option>--Not Specified--</option>
                        <?php
                          $sql2="Select * from categories2";
                          $query2=mysqli_query($conn,$sql2);
                          while($found=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                          {
                              echo "<option>".$found['Category']."</option>";
                          }
                        ?>
                      </select>
                     </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">City/Town*</label>
                    <div class="col-lg-4">
                      <input class="form-control" name="city" type="text" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Country*</label>
                    <div class="col-lg-4">
                      <input class="form-control" name="country" type="text" required>
                    </div>
                </div>
        <div class="form-group">
                    <label class="col-lg-3 control-label">Description</label>
                    <div class="col-lg-4" style="margin-top: 10px">
                      <textarea id="description" class="form-control" name="description" rows="7"></textarea>
                    </div>
                </div>
            
          <label class="col-lg-3 control-label">Upload Video/Picture</label>
          <input type="file" id="fileInput" name="fileInput3" />
          <br>
                    <label class="col-lg-3 control-label ">Work Shift</label>
                    <div class="col-lg-4" style="margin-top: 10px">
                      <select name="workshift" class="form-control">
                        <option>--Not Specified--</option>
                        <?php
                          $sql2="Select * from Work";
                          $query2=mysqli_query($conn,$sql2);
                          while($found=mysqli_fetch_array($query2,MYSQLI_ASSOC))
                          {
                              echo "<option>".$found['Shifts']."</option>";
                          }
                        ?>
                    </div>


                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                      <input class="btn btn-primary" value="Submit" name="next" type="submit" style="margin-top:20px">
              
                    </div>
                  </div>
      </form>
    </div>
  </div>
<script>
   function chooseFile() {
      $("#fileInput").click();
   }
</script>
  <script type="text/javascript">
      $("#cancel").click(function(){
          
        window.location.href = 'index.php';
      });
    </script>
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

    <!-- jQuery --->
  <script src="js/jquery.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>

  <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
<style>
  article, aside, figure, footer, header, hgroup, 
  menu, nav, section { display: inline-table; }
</style>
<style>
     .col-sm-8{
           alignment-adjust:before-edge;
      }
</style>
<script>
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#  blah')
                    .attr('src', e.target.result)
                    .width(80)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
  </script>
</html>