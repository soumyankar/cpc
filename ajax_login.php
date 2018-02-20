<?php

include "connect.php";
session_start();


$email = $_POST['login_email'];
$pass = $_POST['login_pass'];

if($email == "Admin" and $pass == "Admin")
{
    $_SESSION['user_id']="Admin";
    echo $_SESSION['user_id'];
    // header("location:admin/adminpage.php");
}
else 
{
    $sql="Select * from users where Email='$email' and Password='$pass'";
    $query=mysqli_query($conn,$sql);
    $found=mysqli_num_rows($query);
    $profile=mysqli_fetch_array($query,MYSQLI_ASSOC);
    if($found)
    {
        $_SESSION['user_id']=$profile['ID'];
        echo $_SESSION['user_id'];
        // header("location:home.php");
    }
    else
    {
        echo "Error";
    }
}
