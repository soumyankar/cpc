<?php
  include ("connect.php");
   session_start();
  $id=$_SESSION['user_id'];
  $sql="Select * from users where ID='$id'";
  $query=mysqli_query($conn,$sql);
  if(!$query)
  {
    echo "Not Inserted". "<br>" . mysqli_error($conn);
  } 
  $result=mysqli_fetch_assoc($query);
  $hash=$result['hash_id'];
 include "HashGenerator.php";
 function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
  }
      $errors= array();
      $category=$_POST['category'];
      $city=$_POST['city'];
      $workshift=$_POST['workshift'];
      $country=$_POST['country'];
      $complaint=$_POST['description'];
      $path3=$_FILES['fileInput3']['name'];
      $file3=$path3;
      $path3_tmp=$_FILES['fileInput3']['tmp_name'];
        // var_dump($c_id);
      $sql="INSERT INTO `add_credits` (`hash_id`,`ID`,`Category`,`city`,`country`,`description`,`file_1`,`work_shift`) VALUES ('$hash',NULL,'$category','$city','$country','$complaint','$file3','$workshift')";
      $query=mysqli_query($conn,$sql);
      if(!$query)
      {
        echo "Not Inserted". "<br>" . mysqli_error($conn);
      }  
      $sql2="Select LAST_INSERT_ID() as ID";
      $query2=mysqli_query($conn,$sql2);
      $result2=mysqli_fetch_assoc($query2);
      $c_id=($result2['ID']);
      $path3=$c_id."_file3";
        if(empty($errors)==true){
         move_uploaded_file($path3_tmp,"images/".$path3);
      }else{
         print_r($errors);
      }
        $sql5="UPDATE add_credits SET file_1='$path3' WHERE ID='$c_id' ";
        $query=mysqli_query($conn,$sql5);
        if(!$query)
        {
          echo "Not Updated". "<br>" . mysqli_error($conn);
        }   
      $origin = $result['City/Town'].",".$result['country']; $destination = $city.",".$country;
      $api = file_get_contents("http://www.distance24.org/route.json?stops=".rawurlencode($origin)."|".rawurlencode($destination));
      $data = json_decode($api);
      $test=$data->{'distance'};
      $sql6="SELECT hours from Work WHERE Shifts='$workshift'";
      $query6=mysqli_query($conn,$sql6);
      if(!$query6)
      {
        echo "Fatal Error"."<br>".mysqli_error($conn);
      }     
      $result6=mysqli_fetch_assoc($query6);
      $credit=$result['credit_point'];
      $temp=((int)$test*2+(int)$result6['hours']);
      $credit=$credit+((int)$test*2+(int)$result6['hours']);
      $sql7="UPDATE users set credit_point='$credit' WHERE hash_id='$hash'";
      $query7=mysqli_query($conn,$sql7);
      if(!$query7)
      {
       echo "Fatal Error"."<br>".mysqli_error($conn);  
      }
      $sql8="UPDATE add_credits SET credit='$temp' WHERE ID='$c_id'";
        $query8=mysqli_query($conn,$sql8);
        if(!$query8)
        {
          echo "Not Updated". "<br>" . mysqli_error($conn);
        }   
        // phpAlert(   "Hello world!\\n\\nPHP has got an Alert Box"   );
        header('location: home.php');
?>