<?php 
    include 'db.php';
    if(isset($_POST['submit']))
     {
        $fullname=$_POST['fullname'];
        $number=$_POST['number'];
        $email=$_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($con, "SELECT email FROM users WHERE email=? OR number=?");
        mysqli_stmt_bind_param($stmt, "ss", $email, $number);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $result = mysqli_stmt_num_rows($stmt);
        if ($result !== false && $result > 0) {
            // Existing email or number found
            echo "<script>alert('This email or Contact Number already associated with another account');</script>";
        }        
        else
        {
        $query=mysqli_query($con, "INSERT INTO users (fullname,number,email,password) VALUE('$fullname','$number','$email','$password')");
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
