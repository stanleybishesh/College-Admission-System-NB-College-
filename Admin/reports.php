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
.heading-container{
 margin-left:310px ;  
 padding-top: 100px;
 padding-bottom: 10px;
 font-size: xx-large;
 font-weight:bold;

}
.report-container{
    display: flex;
    flex-direction: column;
    width: 98%;
}
.report-container > div {
    background-color: #fffefef6;
    margin-left: 310px;
    padding: 20px;
    margin-top: 10px;
    border-radius: 20px;
    width: 800px;
}
    </style>
</head>

<body>
    <div class="sidebar">
        <header>Admin</header>
        <a href="dashboard.php">
            <i class="fas fa-qrcode"></i>
            <span>Dashboard</span>
        </a>
        <a href="course.html">
            <i class="fas fa-solid fa-graduation-cap"></i>
            <span>Course</span>
        </a>
        <a href="regUsers.html">
            <i class="fas fa-solid fa-users"></i>
            <span>Registered Users</span>
        </a>
        <a href="application.html">
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
        <a href="reports.php" class="active">
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
            type="submit">Logout</button></a>    </div>
<div class="heading-container">Reports</div>
<div class="report-container">
<?php
include '../LogIn/db.php';
$sql = "SELECT * FROM reports";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div>';
        echo '<p>Name: ' . $row["name"] . '</p>';
        echo '<p>Email: ' . $row["email"] . '</p>';
        echo '<p>Message: ' . $row["message"] . '</p>';
        echo '</div>'; 
    }
} else {
    echo "No form data found in the database.";
}
$con->close();
?>
</div>
</body>
</html>