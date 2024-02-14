<?php
session_start();
error_reporting(0);
include '../LogIn/db.php';
if (strlen($_SESSION['uid']==0)) {
  header('location:../LogIn/logout.php');
  } else{

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
        <a href="form.php" class="active">
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
        <form action="admission.php" method="post" enctype="multipart/form-data">
            <h3>Admission Form</h3>

            <div class="row-2">
                <div>
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName" required>
                </div>
                <div>
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName" required>
                </div>
            </div>

            <div class="row-2">
                <div>
                    <label for="course">Course Applied</label>
                    <select name="course" id="course" required>
                        <option value="default" selected>Default</option>
                        <option value="bsccsit">Bsc CSIT</option>
                        <option value="bca">BCA</option>
                    </select>
                </div>
                <div>
                    <label for="studentPhoto">Student Photo [ *File should be in png format ]</label>
                    <input type="file" id="studentPhoto" name="studentPhoto" accept=".png" required>
                </div>
            </div>

            <div class="row-2">
                <div>
                    <label for="fatherName">Father's Name</label>
                    <input type="text" id="fatherName" name="fatherName" required>
                </div>
                <div>
                    <label for="motherName">Mother's Name</label>
                    <input type="text" id="motherName" name="motherName" required>
                </div>
            </div>

            <div class="row-3">
                <div>
                    <label for="dob">DOB</label>
                    <input type="date" id="dob" name="dob" required>
                </div>
                <div>
                    <label for="nationality">Nationality</label>
                    <input type="text" id="nationality" name="nationality" required>
                </div>
                <div>
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" required>
                        <option value="default" selected>Default</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="others">Others</option>
                    </select>
                </div>
            </div>

            <div class="row-2">
                <div>
                    <label for="citizenship">Citizenship No.</label>
                    <input type="text" id="citizenship" name="citizenship" required>
                </div>
                <div>
                    <label for="citizenshipPhoto">Citizenship Photo</label>
                    <input type="file" id="citizenshipPhoto" name="citizenshipPhoto" accept=".png,.jpg,.jpeg" multiple
                        required>
                </div>
            </div>

            <div class="row-1">
                <div>
                    <label for="tempAddress">Temporary Address</label>
                    <textarea name="tempAddress" id="tempAddress" cols="128" rows="4"></textarea>
                </div>
                <div>
                    <label for="perAddress">Permanent Address</label>
                    <textarea name="perAddress" id="perAddress" cols="128" rows="4" required></textarea>
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
                            <td><input type="text" id="board10" name="board10" required></td>
                            <td><input type="text" id="year10" name="year10" required></td>
                            <td><input type="text" id="percentage10" name="percentage10" required></td>
                            <td><input type="text" id="stream10" name="stream10" required></td>
                        </tr>
                        <tr>
                            <th>12th (Higher Secondary)</th>
                            <td><input type="text" id="board12" name="board12" required></td>
                            <td><input type="text" id="year12" name="year12" required></td>
                            <td><input type="text" id="percentage12" name="percentage12" required></td>
                            <td><input type="text" id="stream12" name="stream12" required></td>
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
                <input type="text" id="declaration" name="declaration" required>
            </div>

            <div class="submit">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>

</body>

</html>

<?php }  ?>

