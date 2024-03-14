<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles.css">
<style>
    .flex-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 50vh;
  margin-left: 20%;
  margin-right: 2%;
}

.section {
  flex: 1;
  width: 100px;
  height: 140px;
  margin: 15px;
  padding: 20px;
  background-color: #e4c142;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  text-align: center;
}
.section h2 {
  padding-top: 30px;
  color:darkgreen;
}
</style>
</head>

<body>
    <div class="sidebar">
        <header>Admin</header>
        <a href="dashboard.php" class="active">
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
        <a href="../LogIn/logout.php"><button onclick="return confirm('Are you sure you want to logout?')"
                type="submit">Logout</button></a>
    </div>
    <div class="flex-container">
        <div class="section">
        <?php
        include '../LogIn/db.php';
        $sqlCount = "SELECT COUNT(*) as count FROM users";
        $resultCount = $con->query($sqlCount);
        $row = $resultCount->fetch_assoc();
        $RegCount = $row['count'];
        echo "<h2>TOTAL USER REGISTERED</h2>";
        echo "<h2>$RegCount</h2>";
        $con->close();
        ?>
        </div>
        <div class="section">
        <?php
        include '../LogIn/db.php';
        $sqlentranceCount = "SELECT COUNT(*) as entrancecount FROM user_results";
        $entranceresultCount = $con->query($sqlentranceCount);
        $rowentrance = $entranceresultCount->fetch_assoc();
        $entranceCount = $rowentrance['entrancecount'];
        echo "<h2>TOTAL TEST APPEARANCE</h2>";
        echo "<h2>$entranceCount</h2>";
        $con->close();
        ?>
        </div>
        <div class="section">
        <?php
        include '../LogIn/db.php';
        $sqlCountadmit = "SELECT COUNT(*) as admittedcount FROM admission_users";
        $resultadmitCount = $con->query($sqlCountadmit);
        $rowadmit = $resultadmitCount->fetch_assoc();
        $admittedstudentCount = $rowadmit['admittedcount'];
        echo "<h2>TOTAL STUDENT ADMITTED</h2>";
        echo "<h2>$admittedstudentCount</h2>";
        $con->close();
        ?>
        </div>
    </div>

</body>

</body>

</html>