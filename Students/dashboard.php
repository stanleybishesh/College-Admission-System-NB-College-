<?php
session_start();
error_reporting(0);
include '../LogIn/db.php';
// echo $_SESSION['result_id'];
if (strlen($_SESSION['result_id']==0)) {
    header('location:../LogIn/logout.php');
  } else{
    $result_id=$_SESSION['result_id'];
    $applicationData = mysqli_query($con, "SELECT * FROM admission_users WHERE user_results_id='$result_id'");
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
    <link rel="stylesheet" href="dashboard.css">
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
        <a href="dashboard.php" class="active">
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

    <div class="application-status">
        <h2>Application Status</h2>
        <table>
            <thead>
                <tr>
                    <th>Applied Date</th>
                    <th>Course</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Display fetched data in the table rows
                    while ($applicationRow = mysqli_fetch_assoc($applicationData)) {
                        echo "<tr>";
                        echo "<td>" . $applicationRow['submission_date'] . "</td>";
                        echo "<td>" . $applicationRow['course'] . "</td>";
                        echo "<td>Pending</td>";
                        echo "<td><a href='editAdmissionForm.php'>Edit</a></td>";
                        echo "<td><a href='displayAdmissionForm.php'>View</a></td>";
                        echo "</tr>";
                    }
                    ?>
            </tbody>
        </table>
    </div>

</body>

</html>

<?php }  ?>