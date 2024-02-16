<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "nbcollege";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $course = $_POST["course"];
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    // $dob = $_POST["dob"]; // Uncomment if you want to include date of birth
    $address = $_POST["address"];

    // SQL query to insert data into the 'applicants' table
    $sql = "INSERT INTO applicants (course, fullname, email, phone, address) 
            VALUES ('$course', '$fullname', '$email', '$phone', '$address')";

    // Execute query
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Application submitted successfully!');</script>";
        echo "<script>window.location.href='main.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
