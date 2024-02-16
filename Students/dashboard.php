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

</body>

</html>

<?php }  ?>