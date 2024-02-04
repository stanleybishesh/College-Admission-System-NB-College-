<?php
session_start();
error_reporting(0);
$con=mysqli_connect("localhost", "root", "", "regdb");
if(mysqli_connect_errno()){
echo "Connection Fail".mysqli_connect_error();
}
if(isset($_POST['login']))
{
  $email=$_POST['email'];
  $password=md5($_POST['password']);
  $query=mysqli_query($con,"SELECT ID from tbluser where  (Email='$email' || MobileNumber='$email') && Password='$password' ");
  $smt=mysqli_fetch_array($query);
  if($smt>0){
    $_SESSION['uid']=$smt['ID'];
   //echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
   header('location:dashboard.php');
  }
  else{
  echo "<script>alert('Invalid Details');</script>";
  }
}
?>