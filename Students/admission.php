<?php
session_start();
error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nbcollege";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName=$_POST["firstName"];
    $lastName=$_POST["lastName"];
    $course = $_POST["course"];
    $fatherName = $_POST["fatherName"];
    $motherName = $_POST["motherName"];
    $dob = $_POST["dob"];
    $nationality = $_POST["nationality"];
    $gender = $_POST["gender"];
    $citizenship = $_POST["citizenship"];
    $tempAddress = $_POST["tempAddress"];
    $perAddress = $_POST["perAddress"];
    $board10 = $_POST["board10"];
    $year10 = $_POST["year10"];
    $percentage10 = $_POST["percentage10"];
    $stream10 = $_POST["stream10"];
    $board12 = $_POST["board12"];
    $year12 = $_POST["year12"];
    $percentage12 = $_POST["percentage12"];
    $stream12 = $_POST["stream12"];
    $declaration = $_POST["declaration"];

    // Handle file uploads
    $studentUpload = "../uploads/StudentPhoto/";
    $citizenshipUpload = "../uploads/CitizenshipPhoto/";
    $marksheet10Upload = "../uploads/Marksheet10/";
    $marksheet12Upload = "../uploads/Marksheet12/";
    
    $studentPhoto = $_FILES["studentPhoto"]["name"];
    $studentPhotoPath = $studentUpload . $studentPhoto;
    move_uploaded_file($_FILES["studentPhoto"]["tmp_name"], $studentPhotoPath);

    $citizenshipPhoto = $_FILES["citizenshipPhoto"]["name"];
    $citizenshipPhotoPath = $citizenshipUpload . $citizenshipPhoto;
    move_uploaded_file($_FILES["citizenshipPhoto"]["tmp_name"], $citizenshipPhotoPath);

    $marksheet10 = $_FILES["marksheet10"]["name"];
    $marksheet10Path = $marksheet10Upload . $marksheet10;
    move_uploaded_file($_FILES["marksheet10"]["tmp_name"], $marksheet10Path);

    $marksheet12 = $_FILES["marksheet12"]["name"];
    $marksheet12Path = $marksheet12Upload . $marksheet12;
    move_uploaded_file($_FILES["marksheet12"]["tmp_name"], $marksheet12Path);

    // SQL query to insert data into the database
    $sql = "INSERT INTO admission_users (user_id, user_results_id, first_name, last_name, course, student_photo, father_name, mother_name, dob, nationality, gender, citizenship, citizenship_photo, temp_address, per_address, board10, year10, percentage10, stream10, board12, year12, percentage12, stream12, marksheet10, marksheet12, declaration) VALUES ('{$_SESSION['uid']}', '{$_SESSION['result_id']}', '$firstName','$lastName', '$course', '$studentPhoto', '$fatherName', '$motherName', '$dob', '$nationality', '$gender', '$citizenship', '$citizenshipPhoto', '$tempAddress', '$perAddress', '$board10', '$year10', '$percentage10', '$stream10', '$board12', '$year12', '$percentage12', '$stream12', '$marksheet10', '$marksheet12', '$declaration')";

    // Perform the query
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record Inserted Successfully !!');</script>";
        echo "<script>window.location.href ='dashboard.php'</script>";
    } else {
            // echo "Error: " . $sql . "<br>" . $conn->error;
        echo "<script>alert('Form submission failed !!');</script>";
        echo "<script>window.location.href ='form.php'</script>";
    }
}

// Close connection
$conn->close();
?>
