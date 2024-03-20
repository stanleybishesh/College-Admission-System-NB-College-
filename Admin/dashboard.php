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
  padding: 100px 0px;
  display: flex;
  flex-wrap: wrap; /* Allow flex items to wrap to the next line */
  justify-content: center; /* Distribute flex items evenly along the main axis */
  align-items: flex-start; /* Align items to the start of the cross axis */
  margin-left: 10%;
  margin-right: 1%;
  gap: 50px;
}

.section {
  width: calc(32% - 20px); /* Set width to 50% of the container width minus margin */
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
            <span>Admitted Students</span>
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
            <span>Inquiries</span>
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
        echo "<h1>$RegCount</h1>";
        echo "<h2>Total Users Registered</h2>";
        echo "<button>.</button>";
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
        echo "<h1>$entranceCount</h1>";
        echo "<h2>Total Test Appearance</h2>";
        echo "<button>.</button>";
        $con->close();
        ?>
        </div>
        <div class="section">
        <?php
        include '../LogIn/db.php';
        $sqlCountadmit = "SELECT COUNT(*) as appCount FROM admission_users";
        $resultappCount = $con->query($sqlCountadmit);
        $rowapp = $resultappCount->fetch_assoc();
        $applicationCount = $rowapp['appCount'];
        echo "<h1>$applicationCount</h1>";
        echo "<h2>Total Admission Applications</h2>";
        echo "<button>.</button>";
        $con->close();
        ?>
        </div>
        <div class="section">
        <?php
        include '../LogIn/db.php';
        $sqlCountadmit = "SELECT COUNT(*) as admittedcount FROM admitted_users";
        $resultadmitCount = $con->query($sqlCountadmit);
        $rowadmit = $resultadmitCount->fetch_assoc();
        $admittedstudentCount = $rowadmit['admittedcount'];
        echo "<h1>$admittedstudentCount</h1>";
        echo "<h2>Total Admitted Students</h2>";
        echo "<button>.</button>";
        $con->close();
        ?>
        </div>
    </div>

</body>

</body>

</html>