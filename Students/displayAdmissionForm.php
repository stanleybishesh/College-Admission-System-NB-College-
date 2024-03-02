    <?php
    session_start();
    error_reporting(0);
    include '../LogIn/db.php';
    if (strlen($_SESSION['result_id']==0)) {
    header('location:../LogIn/logout.php');
    } else{
        $result_id = $_SESSION['result_id'];
        $result = mysqli_query($con, "SELECT * FROM admission_users WHERE user_results_id = '$result_id'");

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
    <link rel="stylesheet" href="displayAdmissionForm.css">
    <script>
        //Javascript function to trigger download
        function downloadContent() {
    var contentElement = document.querySelector('.displayForm');
    var content = contentElement.outerHTML;

    // Fetch CSS
    fetch('displayAdmissionForm.css')
        .then(response => response.text())
        .then(styles => {
            // Convert images to base64-encoded data URLs
            var promises = [];
            contentElement.querySelectorAll('img').forEach(img => {
                promises.push(
                    new Promise(resolve => {
                        var canvas = document.createElement('canvas');
                        var ctx = canvas.getContext('2d');

                        // Load image and draw it on the canvas
                        var imgElement = new Image();
                        imgElement.crossOrigin = 'Anonymous'; // Enable CORS for the image
                        imgElement.onload = function () {
                            canvas.width = imgElement.width;
                            canvas.height = imgElement.height;
                            ctx.drawImage(imgElement, 0, 0);

                            // Convert canvas content to base64-encoded data URL
                            var dataUrl = canvas.toDataURL('image/png');
                            img.src = dataUrl; // Replace the original image with the data URL
                            resolve();
                        };

                        imgElement.onerror = function () {
                            console.error('Failed to load image: ' + img.src);
                            resolve(); // Continue even if an image fails to load
                        };

                        imgElement.src = img.src; // Trigger the image load
                    })
                );
            });

            // Wait for all promises to resolve
            Promise.all(promises).then(() => {
                // Combine styles and HTML content
                var htmlContent = '<!DOCTYPE html><html lang="en"><head>' +
                    '<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">' +
                    '<title>Admission Form</title>' +
                    '<style>' + styles + '</style>' +
                    '</head><body>' +
                    content +
                    '</body></html>';

                // Create and trigger download
                var blob = new Blob([htmlContent], { type: 'text/html' });
                var a = document.createElement('a');
                a.href = URL.createObjectURL(blob);
                a.download = 'student_profile.html';
                a.click();
            });
        })
        .catch(error => console.error('Failed to fetch CSS: ', error));
}


        // JavaScript function to trigger print
        function printPage() {
            window.print();
        }
    </script>
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
        </div>
    </div>
    
    <div class="buttons">
        <button class="download" onclick="downloadContent()">Download</button>
        <button class="print" onclick="printPage()">Print</button>
    </div>
</body>

</html>

<?php }

?>