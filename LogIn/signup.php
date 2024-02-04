<?php 
    include('includes/dbconnection.php');
    if(isset($_POST['submit']))
     {
        $name=$_POST['name'];
        $number=$_POST['number'];
        $email=$_POST['email'];
        $password=md5($_POST['password']);
        $stmt=mysqli_query($con, "select Email from tbluser where Email='$email' || MobileNumber='$number'");
        $result=mysqli_fetch_array($stmt);
        if($result>0){
        echo "<script>alert('This email or Contact Number already associated with another account');</script>";
        }
        else
        {
        $query=mysqli_query($con, "INSERT INTO tbluser (FullName, MobileNumber, Email,  Password) VALUE('$name', '$number', '$email', '$password' )");
        if ($query) {
        echo "<script>alert('You have successfully registered');</script>";
        echo "<script>window.location.href ='login.html'</script>";
        }
        else
        {
        echo "<script>alert('Something Went Wrong. Please try again');</script>";
        echo "<script>window.location.href ='signup.html'</script>";
        }
    }
}
 ?>
