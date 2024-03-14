<?php
    session_start();
    error_reporting(0);
    include '../LogIn/db.php';

    $user_results_id = $_GET['user_results_id'];
    $result = mysqli_query($con, "SELECT * FROM admission_users WHERE user_results_id = '$user_results_id'");

    // Check if there is any data
    if ($result->num_rows > 0) {
        $admissionRow = $result->fetch_assoc();
        $firstName = $admissionRow['first_name'];
        $lastName = $admissionRow['last_name'];
        $course = $admissionRow['course'];
        $fatherName = $admissionRow['father_name'];
        $motherName = $admissionRow['mother_name'];
        $dob = $admissionRow['dob'];
        $nationality = $admissionRow['nationality'];
        $gender = $admissionRow['gender'];
        $citizenship = $admissionRow['citizenship'];
        $tempAddress = $admissionRow['temp_address'];
        $perAddress = $admissionRow['per_address'];
        $board10 = $admissionRow['board10'];
        $year10 = $admissionRow['year10'];
        $percentage10 = $admissionRow['percentage10'];
        $stream10 = $admissionRow['stream10'];
        $board12 = $admissionRow['board12'];
        $year12 = $admissionRow['year12'];
        $percentage12 = $admissionRow['percentage12'];
        $stream12 = $admissionRow['stream12'];
        $declaration = $admissionRow['declaration'];
        $studentPhotoPath = "../uploads/StudentPhoto/" . $admissionRow['student_photo'];
        $citizenshipPhotoPath = "../uploads/CitizenshipPhoto/" . $admissionRow['citizenship_photo'];
        $marksheet10Path = "../uploads/Marksheet10/" . $admissionRow['marksheet10'];
        $marksheet12Path = "../uploads/Marksheet12/" . $admissionRow['marksheet12'];
    } else {
        // Handle the case where no data is found
        echo "<script>alert('No data found for the user!');</script>";
        echo "<script>window.location.href ='dashboard.php'</script>";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Form</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../Students/displayAdmissionForm.css">
    <script>
        function toggleFeeInput() {
            var statusSelect = document.getElementById("status");
            var feeRow = document.getElementById("feeRow");

            if (statusSelect.value === "selected") {
                feeRow.style.display = "table-row";
                document.getElementById("fee").setAttribute("required", "required");
            } else {
                feeRow.style.display = "none";
                document.getElementById("fee").removeAttribute("required");
            }
        }
    </script>
</head>

<body>
<div class="sidebar">
        <header>Admin</header>
        <a href="dashboard.php">
            <i class="fas fa-qrcode"></i>
            <span>Dashboard</span>
        </a>
        <a href="course.php">
            <i class="fas fa-solid fa-graduation-cap"></i>
            <span>Course</span>
        </a>
        <a href="regUsers.php">
            <i class="fas fa-solid fa-users"></i>
            <span>Registered Users</span>
        </a>
        <a href="application.php">
            <i class="fas fa-solid fa-folder-open"></i>
            <span>Admission application</span>
        </a>
        <a href="searchapp.php">
            <i class="fas fa-search"></i>
            <span>Search Application</span>
        </a>
        <a href="meritlist.php">
            <i class="fas fa-solid fa-user-tag"></i>
            <span>Merit List</span>
        </a>
        <a href="reports.php">
            <i class="fas fa-solid fa-envelope"></i>
            <span>Reports</span>
        </a>
    </div>

    <div class="navbar">
        <div class="logo">
            <img src="../image/nblogo.png" alt="Logo">
            <h2>NB College Admission System</h2>
        </div>
        <a href="../LogIn/logout.php"><button onclick="return confirm('Are you sure you want to logout?')" type="submit">Logout</button></a>
    </div>

    <div class="displayForm">
        <div class="profile-header">
            <img src="../image/nblogo.png" alt="colz logo">
            <h2>NB COLLEGE</h2>
            <?php echo "<img src='$studentPhotoPath' alt='Student Photo'>"; ?>
        </div>

        <div class="profile-data">
            <h3>Personal Information</h3>
            <table>
                <tr>
                    <th>Name:</th>
                    <td><?php echo $firstName." ".$lastName; ?></td>
                    <th>Nationality:</th>
                    <td><?php echo $nationality; ?></td>
                </tr>
                <tr>
                    <th>Course:</th>
                    <td><?php echo $course; ?></td>
                    <th>Gender:</th>
                    <td><?php echo $gender; ?></td>
                </tr>
                <tr>
                    <th>Father's Name:</th>
                    <td><?php echo $fatherName; ?></td>
                    <th>Citizenship:</th>
                    <td><?php echo $citizenship; ?></td>
                </tr>
                <tr>
                    <th>Mother's Name:</th>
                    <td><?php echo $motherName; ?></td>
                    <th>Temporary Address:</th>
                    <td><?php echo $tempAddress; ?></td>
                </tr>
                <tr>
                    <th>Date of Birth:</th>
                    <td><?php echo $dob; ?></td>
                    <th>Permanent Address:</th>
                    <td><?php echo $perAddress; ?></td>
                </tr>
                <!-- Add more rows for other personal information -->
            </table>

            <h3>Educational Information</h3>
            <table>
                <tr>
                    <th>10th Board:</th>
                    <td><?php echo $board10; ?></td>
                    <th>12th Board:</th>
                    <td><?php echo $board12; ?></td>
                </tr>
                <tr>
                    <th>10th Year:</th>
                    <td><?php echo $year10; ?></td>
                    <th>12th Year:</th>
                    <td><?php echo $year12; ?></td>
                </tr>
                <tr>
                    <th>10th Percentage:</th>
                    <td><?php echo $percentage10; ?></td>
                    <th>12th Percentage:</th>
                    <td><?php echo $percentage12; ?></td>
                </tr>
                <tr>
                    <th>10th Stream:</th>
                    <td><?php echo $stream10; ?></td>
                    <th>12th Stream:</th>
                    <td><?php echo $stream12; ?></td>
                </tr>
                <!-- Add rows for other educational information -->
            </table>

            <h3>Documents</h3>
            <table>
                <tr>
                    <th>Citizenship Photo:</th>
                    <td><a href="<?php echo $citizenshipPhotoPath; ?>" target="_blank">View citizenship photo</a></td>
                <tr>
                    <th>Marksheet 10:</th>
                    <td><a href="<?php echo $marksheet10Path; ?>" target="_blank">View 10th grade marksheet</a></td>
                </tr>
                <tr> 
                    <th>Marksheet 12:</th>
                    <td><a href="<?php echo $marksheet12Path; ?>" target="_blank">View 12th grade marksheet</a></td>
                </tr>
            </table>

            <h3>Application</h3>
            <form action="appStatus.php" method="post" id="form">
                <table>
                    <tr>
                        <th>Application Status:</th>
                        <td>
                            <select name="status" id="status" onchange="toggleFeeInput()">
                                <option value="default" selected disabled>Default</option>
                                <option value="selected">Selected</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Application Remark:</th>
                        <td><textarea name="remark" id="remark" cols="65" rows="3" required></textarea></td>
                    </tr>
                    <tr id="feeRow" style="display: none;">
                        <th>Fee Amount:</th>
                        <td><input type="text" name="fee" id="fee"></td>
                    </tr>
                </table>
                <input type="hidden" name="admission_users_id" value="<?php echo $admissionRow['id']; ?>">
                <input type="submit" id="button" value="Submit">
            </form>
        </div>
    </div>
</body>

</html>

<?php 

?>