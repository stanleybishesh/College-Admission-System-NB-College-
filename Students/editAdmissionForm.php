<?php
session_start();
error_reporting(0);
include '../LogIn/db.php';

if (strlen($_SESSION['result_id'] == 0)) {
    header('location:../LogIn/logout.php');
} else {
    $result_id = $_SESSION['result_id'];

    // Check if the user has already submitted the form
    $editAdmission = mysqli_query($con, "SELECT * FROM admission_users WHERE user_results_id = '$result_id'");

    if (mysqli_num_rows($editAdmission) > 0) {
        // User has already submitted the form, fetch data for editing
        $admissionData = mysqli_fetch_assoc($editAdmission);
    } else {
        // Redirect to the form page if the user has not submitted the form
        header('location: form.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form submission and update data in admission_users table
    $firstName = mysqli_real_escape_string($con, $_POST["firstName"]);
    $lastName = mysqli_real_escape_string($con, $_POST["lastName"]);
    $course = mysqli_real_escape_string($con, $_POST["course"]);
    $fatherName = mysqli_real_escape_string($con, $_POST["fatherName"]);
    $motherName = mysqli_real_escape_string($con, $_POST["motherName"]);
    $dob = mysqli_real_escape_string($con, $_POST["dob"]);
    $nationality = mysqli_real_escape_string($con, $_POST["nationality"]);
    $gender = mysqli_real_escape_string($con, $_POST["gender"]);
    $citizenship = mysqli_real_escape_string($con, $_POST["citizenship"]);
    $tempAddress = mysqli_real_escape_string($con, $_POST["tempAddress"]);
    $perAddress = mysqli_real_escape_string($con, $_POST["perAddress"]);
    $board10 = mysqli_real_escape_string($con, $_POST["board10"]);
    $year10 = mysqli_real_escape_string($con, $_POST["year10"]);
    $percentage10 = mysqli_real_escape_string($con, $_POST["percentage10"]);
    $stream10 = mysqli_real_escape_string($con, $_POST["stream10"]);
    $board12 = mysqli_real_escape_string($con, $_POST["board12"]);
    $year12 = mysqli_real_escape_string($con, $_POST["year12"]);
    $percentage12 = mysqli_real_escape_string($con, $_POST["percentage12"]);
    $stream12 = mysqli_real_escape_string($con, $_POST["stream12"]);
    $declaration = mysqli_real_escape_string($con, $_POST["declaration"]);

    // Handle file uploads
    $studentUpload = "../uploads/StudentPhoto/";
    $citizenshipUpload = "../uploads/CitizenshipPhoto/";
    $marksheet10Upload = "../uploads/Marksheet10/";
    $marksheet12Upload = "../uploads/Marksheet12/";

    if ($_FILES["studentPhoto"]["name"] != "") {
        $studentPhoto = $_FILES["studentPhoto"]["name"];
        $studentPhotoPath = $studentUpload . $studentPhoto;
        move_uploaded_file($_FILES["studentPhoto"]["tmp_name"], $studentPhotoPath);
        $studentPhotoPath = "', student_photo = '$studentPhoto";
    } else {
        // If no new file is provided, keep the existing file path
        $studentPhotoPath = "";
    }
    
    if ($_FILES["citizenshipPhoto"]["name"] != "") {
        $citizenshipPhoto = $_FILES["citizenshipPhoto"]["name"];
        $citizenshipPhotoPath = $citizenshipUpload . $citizenshipPhoto;
        move_uploaded_file($_FILES["citizenshipPhoto"]["tmp_name"], $citizenshipPhotoPath);
        $citizenshipPhotoPath = "', citizenship_photo = '$citizenshipPhoto";
    } else {
        $citizenshipPhotoPath = "";
    }
    
    if ($_FILES["marksheet10"]["name"] != "") {
        $marksheet10 = $_FILES["marksheet10"]["name"];
        $marksheet10Path = $marksheet10Upload . $marksheet10;
        move_uploaded_file($_FILES["marksheet10"]["tmp_name"], $marksheet10Path);
        $marksheet10Path = "', marksheet10 = '$marksheet10";
    } else {
        $marksheet10Path = "";
    }
    
    if ($_FILES["marksheet12"]["name"] != "") {
        $marksheet12 = $_FILES["marksheet12"]["name"];
        $marksheet12Path = $marksheet12Upload . $marksheet12;
        move_uploaded_file($_FILES["marksheet12"]["tmp_name"], $marksheet12Path);
        $marksheet12Path = "', marksheet12 = '$marksheet12";
    } else {
        $marksheet12Path = "";
    }

    // Update data in admission_users table
    $updateQuery = "UPDATE admission_users SET
        first_name = '$firstName',
        last_name = '$lastName',
        course = '$course',
        father_name = '$fatherName',
        mother_name = '$motherName',
        dob = '$dob',
        nationality = '$nationality',
        gender = '$gender',
        citizenship = '$citizenship',
        temp_address = '$tempAddress',
        per_address = '$perAddress',
        board10 = '$board10',
        year10 = '$year10',
        percentage10 = '$percentage10',
        stream10 = '$stream10',
        board12 = '$board12',
        year12 = '$year12',
        percentage12 = '$percentage12',
        stream12 = '$stream12',
        declaration = '$declaration',
        student_photo = '$studentPhotoPath',
        citizenship_photo = '$citizenshipPhotoPath',
        marksheet10 = '$marksheet10Path',
        marksheet12 = '$marksheet12Path'
        WHERE user_results_id = '$result_id'";

    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        // Redirect to a success page or perform other actions
        echo "<script>alert('Records Edited Successfully.');</script>";
        echo "<script>window.location.href='dashboard.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error updating data.');</script>";
        echo "<script>window.location.href='editAdmissionForm.php';</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Students</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="form.css">
    <script src="admission.js"></script>
</head>

<body>
    <?php
        $uid=$_SESSION['uid'];
        $ret=mysqli_query($con,"SELECT fullname FROM users WHERE ID='$uid'");
        $row=mysqli_fetch_array($ret);
        $fullname=$row['fullname'];
    ?>

    <div class="sidebar">
        <header><?php echo $fullname;?></header>
        <a href="dashboard.php">
            <i class="fas fa-qrcode"></i>
            <span>Dashboard</span>
        </a>
        <a href="form.php">
            <i class="fas fa-solid fa-file-invoice"></i>
            <span>Application Form</span>
        </a>
        <a href="fees.php">
            <i class="fas fa-regular fa-credit-card"></i>
            <span>Submit Fees</span>
        </a>
    </div>

    <div class="navbar">
        <div class="logo">
            <img src="../image/nblogo.png" alt="Logo">
            <h2>NB College Admission System</h2>
        </div>
        <a href="../LogIn/logout.php"><button onclick="return confirm('Are you sure you want to logout?')" type="submit">Logout</button></a>
    </div>

    <header class="heading">Admission Application Form</header>

    <div class="form-content">
        <form method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <h3>Admission Form</h3>
            
            <input type="hidden" name="result_id" value="<?php echo $result_id; ?>">

            <div class="row-2">
                <div>
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName" value="<?php echo $admissionData['first_name']; ?>" required>
                </div>
                <div>
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName" value="<?php echo $admissionData['last_name']; ?>" required>
                </div>
            </div>

            <div class="row-2">
                <div>
                    <label for="course">Course Applied</label>
                    <select name="course" id="course" required>
                        <option value="default" disabled selected>Default</option>
                        <option value="bsccsit" <?php echo ($admissionData['course'] == 'bsccsit') ? 'selected' : ''; ?>>Bsc CSIT</option>
                        <option value="bca" <?php echo ($admissionData['course'] == 'bca') ? 'selected' : ''; ?>>BCA</option>
                    </select>
                </div>
                <div>
                    <label for="studentPhoto">Student Photo [ *File should be in png format ]</label>
                    <input type="file" id="studentPhoto" name="studentPhoto" accept=".png" value="<?php echo $admissionData['student_photo']; ?>" required>
                </div>
            </div>

            <div class="row-2">
                <div>
                    <label for="fatherName">Father's Name</label>
                    <input type="text" id="fatherName" name="fatherName" value="<?php echo $admissionData['father_name']; ?>" required>
                </div>
                <div>
                    <label for="motherName">Mother's Name</label>
                    <input type="text" id="motherName" name="motherName" value="<?php echo $admissionData['mother_name']; ?>" required>
                </div>
            </div>

            <div class="row-3">
                <div>
                    <label for="dob">DOB</label>
                    <input type="date" id="dob" name="dob" value="<?php echo $admissionData['dob']; ?>" required>
                </div>
                <div>
                    <label for="nationality">Nationality</label>
                    <input type="text" id="nationality" name="nationality" value="<?php echo $admissionData['nationality']; ?>" required>
                </div>
                <div>
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" required>
                        <option value="default" selected>Default</option>
                        <option value="male" <?php echo ($admissionData['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                        <option value="female" <?php echo ($admissionData['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                        <option value="others" <?php echo ($admissionData['gender'] == 'others') ? 'selected' : ''; ?>>Others</option>
                    </select>
                </div>
            </div>

            <div class="row-2">
                <div>
                    <label for="citizenship">Citizenship No.</label>
                    <input type="text" id="citizenship" name="citizenship" value="<?php echo $admissionData['citizenship']; ?>" required>
                </div>
                <div>
                    <label for="citizenshipPhoto">Citizenship Photo</label>
                    <input type="file" id="citizenshipPhoto" name="citizenshipPhoto" accept=".png,.jpg,.jpeg" required>
                    <!-- <p>Current Photo: <?php echo $admissionData['citizenship_photo']; ?></p> -->
                </div>
            </div>

            <div class="row-1">
                <div>
                    <label for="tempAddress">Temporary Address</label>
                    <textarea name="tempAddress" id="tempAddress" cols="128" rows="4"><?php echo $admissionData['temp_address']; ?></textarea>
                </div>
                <div>
                    <label for="perAddress">Permanent Address</label>
                    <textarea name="perAddress" id="perAddress" cols="128" rows="4" required><?php echo $admissionData['per_address']; ?></textarea>
                </div>
            </div>

            <div class="qualification">
                <label for="qualification">Educational Qualification</label>
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Board</th>
                            <th>Year</th>
                            <th>Percentage</th>
                            <th>Stream</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>10th (Secondary)</th>
                            <td><input type="text" id="board10" name="board10" value="<?php echo $admissionData['board10']; ?>" required></td>
                            <td><input type="text" id="year10" name="year10" value="<?php echo $admissionData['year10']; ?>"    required></td>
                            <td><input type="text" id="percentage10" name="percentage10" value="<?php echo $admissionData['percentage10']; ?>" required></td>
                            <td><input type="text" id="stream10" name="stream10" value="<?php echo $admissionData['stream10']; ?>" required></td>
                        </tr>
                        <tr>
                            <th>12th (Higher Secondary)</th>
                            <td><input type="text" id="board12" name="board12" value="<?php echo $admissionData['board12']; ?>" required></td>
                            <td><input type="text" id="year12" name="year12" value="<?php echo $admissionData['year12']; ?>" required></td>
                            <td><input type="text" id="percentage12" name="percentage12" value="<?php echo $admissionData['percentage12']; ?>" required></td>
                            <td><input type="text" id="stream12" name="stream12" value="<?php echo $admissionData['stream12']; ?>" required></td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <div class="row-2">
                <div>
                    <label for="marksheet10">10th Marksheet</label>
                    <input type="file" id="marksheet10" name="marksheet10" required>
                </div>
                <div>
                    <label for="marksheet12">12th Marksheet</label>
                    <input type="file" id="marksheet12" name="marksheet12" required>
                </div>
            </div>

            <h4>Declaration</h4>
            <p>I hereby state that the facts mentioned above are true to the best
                of my knowledge and belief.</p>

            <div class="signature">
                <input type="text" id="declaration" name="declaration" value="<?php echo $admissionData['declaration']; ?>" required>
            </div>

            <div class="submit">
                <input type="submit" value="Update">
            </div>
        </form>
    </div>
</body>

</html>
