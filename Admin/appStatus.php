<?php
session_start();
error_reporting(0);
include '../LogIn/db.php';

$result = mysqli_query($con, "SELECT * FROM admission_users");

// Check if there is any data
if ($result->num_rows > 0) {
    // Fetching other data as before
    
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare data for insertion
        $status = $_POST['status'];
        $remark = $_POST['remark'];
        $fee = $_POST['fee'];
        $admission_users_id = $_POST['admission_users_id'];

        // Prepare SQL query
        $insert_query = "INSERT INTO appstatus (status, remark, fee, admission_users_id) VALUES ('$status', '$remark', '$fee', '$admission_users_id')";

        // Execute the query
        if (mysqli_query($con, $insert_query)) {
            echo "<script>alert('Form data inserted successfully');</script>";
            echo "<script>window.location.href ='dashboard.php'</script>";
        } else {
            echo "<script>alert('Error inserting data: " . mysqli_error($con) . "');</script>";
        }
    }
} else {
    // Handle the case where no data is found
    echo "<script>alert('No data found for the user!');</script>";
    echo "<script>window.location.href ='dashboard.php'</script>";
    exit();
}
?>
