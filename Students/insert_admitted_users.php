<?php
session_start();
include '../LogIn/db.php';

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the POST request
    $paymentAmount = $_POST['fee_amount'];
    $mode = $_POST['mode_of_payment'];
    $transactionDate = $_POST['transaction_date'];

    // Additional data you may want to insert into the table
    // For example, you may retrieve these data from the session or other sources
    // $userId = $_SESSION['user_id'];
    // $applicationId = $_SESSION['application_id'];
    
    // Insert data into the "admitted_users" table
    $insertQuery = "INSERT INTO admitted_users (admission_users_id, fee_amount, mode_of_payment, transaction_date) 
                    VALUES ('{$_SESSION['admission_users_id']}', '$paymentAmount', '$mode', '$transactionDate')";

    // Execute the insert query
    if (mysqli_query($con, $insertQuery)) {
        // Insertion successful
        echo "<script>alert('Data inserted succesfully')</script>";
        echo "<script>window.location.href='dashboard.php'</script>";
    } else {
        // Insertion failed
        echo "Error: " . $insertQuery . "<br>" . mysqli_error($con);
    }
} else {
    // If the request is not a POST request, redirect to an error page or homepage
    echo "<script>alert('Failed inserting data')</script>";
    echo "<script>window.location.href='fees.php'</script>";
    exit;
}
?>
