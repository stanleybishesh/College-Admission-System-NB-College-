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
    <link rel="stylesheet" href="rulesstyles.css">
    <style>
.flex-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 43vh;
  margin-left: 19%;
  margin-right: 1%;
}

.section {
  flex: 1;
  width: 100px;
  height: 100px;
  margin: 15px;
  padding: 20px;
  background-color: white;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  text-align: center;
}
.section h2 {
  padding-top: 10px;
  color:#535050;
  text-align: left;
  padding-left:10px;
}
.section h1 {
  color:#0b0d92d2;
  text-align: left;
  padding-left:10px;
}
.section button {
    width:97%;
    height:9px;
    margin-top:10px;
    color:white;
    border-radius:10px;
    border-style:none;
    background-color:rgb(238, 238, 43);
}
.info-container{
  margin-left: 21%;
  margin-right: 1%;
  line-height:40px;
}
.info-container h3{
    padding-top:14px;
}
</style>
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
        <a href="rules.php" target="_self" class="active">
            <i class="fas fa-qrcode"></i>
            <span>Dashboard</span>
        </a>
        <a href="entrancelandingpage.php" target="_self">
            <i class="fas fa-solid fa-file-invoice"></i>
            <span>Entrance Exam</span>
        </a>
    </div>

    <div class="navbar">
        <h2>NB College Admission System</h2>
        <a href="../LogIn/logout.php"><button onclick="return confirm('Are you sure you want to logout?')"
                type="submit">Logout</button></a>
    </div>
    <div class="flex-container">
        <div class="section">
        <?php
       $user_id = $_SESSION['uid'];
       $resultmark = $con->query("SELECT total_marks FROM user_results WHERE email = 
       (SELECT email FROM users WHERE ID = '$user_id')");
               $rowmark = $resultmark->fetch_assoc();
               $total_mark = $rowmark? $rowmark["total_marks"] : "0";
               echo "<h1>$total_mark</h1>";
               echo "<h2>Total Marks obtained</h2>";
               echo "<button>.</button>";
               ?>
           </div>
           <div class="section">
        <?php
       $user_id = $_SESSION['uid'];
       $entranceapp = $con->query("SELECT COUNT(email) as apperance FROM user_results WHERE email = 
       (SELECT email FROM users WHERE ID = '$user_id')");
               $approw = $entranceapp->fetch_assoc();
               $tapperance = $rowmark? $approw["apperance"] : "0";
               echo "<h1>$tapperance</h1>";
               echo "<h2>Entrance Apperance</h2>";
               echo "<button>.</button>";
               ?>
           </div>
</div>
<div class="info-container">
        <h1 style=color:red;>WHAT TO DO AFTER ENTRANCE ?</h1>
        <h3>1. If u have passed the examination with score of 60% or above:</h3>
            <p>a. Login to Admission portal with the same login details.</p>
            <p>b. Fill out the Admission form.</p>
            <p>c. Wait for Admin Approval.</p>
            <p>d. After Approval, Submit the required fees.</p>

        <h3>2. If u have cleared examination with score below 60%:</h3>
        <p>a. Contact College administrators for further details.</p>
</div>
</body>

</html>

<?php }  ?>