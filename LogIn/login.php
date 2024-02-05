<?php
session_start();
error_reporting(0);
$con = mysqli_connect("localhost", "root", "", "nbcollege");

if (mysqli_connect_errno()) {
    echo "Connection Fail" . mysqli_connect_error();
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $enteredPassword = $_POST['password'];

    // Fetch the hashed password from the database based on the entered email or number
    $query = mysqli_query($con, "SELECT ID, password FROM users WHERE (email='$email' OR number='$email')");
    $result = mysqli_fetch_assoc($query);

    if ($result && password_verify($enteredPassword, $result['password'])) {
        $_SESSION['uid'] = $result['ID'];
        //echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
        header('location: ../dashboard.php');
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>
