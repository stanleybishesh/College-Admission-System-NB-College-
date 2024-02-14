<?php
session_start();
error_reporting(0);
$con = mysqli_connect("localhost", "root", "", "nbcollege");

$recaptcha_secret = '6LcaI2kpAAAAAKW_HDMxIeenop4kGVE0e_msA2gv';
$recaptcha_response = $_POST['g-recaptcha-response'];

$verify_url = "https://www.google.com/recaptcha/api/siteverify?secret={$recaptcha_secret}&response={$recaptcha_response}";
$verify_response = file_get_contents($verify_url);
$verify_data = json_decode($verify_response);

if (mysqli_connect_errno()) {
    echo "Connection Fail" . mysqli_connect_error();
}

if ($verify_data->success) {
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $enteredPassword = $_POST['password'];

        // Fetch the hashed password from the database based on the entered email or number
        $query = mysqli_query($con, "SELECT ID, password FROM users WHERE (email='$email' OR number='$email')");
        $result = mysqli_fetch_assoc($query);

        if ($result && password_verify($enteredPassword, $result['password'])) {
            $_SESSION['uid'] = $result['ID'];
            //echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
            header('location: ../Entrance/rules.php');
        }   else {
            echo "<script>alert('Invalid Details');</script>";
        }
    }
}else{
        // CAPTCHA verification failed, handle accordingly
        echo  "<script>alert('Captcha verification failed');</script>";
    }
?>
