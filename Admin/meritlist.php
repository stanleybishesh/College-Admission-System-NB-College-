<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nbcollege";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT ID,username,email,total_marks FROM user_results ORDER BY total_marks DESC LIMIT 10";
$result = $conn->query($sql);
$conn->close();
?>

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
   .listbar{
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin-left:20%;
            margin-right:3%;
            text-align: center;
            flex-direction:column;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;   
        }
        td {
            background-color:#f0f0f0;
            padding: 10px;
            text-align: center;
        }
        th {
            padding: 10px;
            text-align: center;
            background-color: #0b0d92d2;
            color: white; 
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
        <a href="meritlist.php" class="active">
            <i class="fas fa-solid fa-user-tag"></i>
            <span>Merit List</span>
        </a>
        <a href="reports.html">
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
<div class="listbar">
    <h2>EXAMINANT MERIT LIST</h2>

    <?php
    if ($result->num_rows > 0){
        echo "<table><tr><th>ID</th><th>Username</th><th>Email</th><th>Total Marks</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['ID']}</td><td>{$row['username']}</td><td>{$row['email']}</td><td>{$row['total_marks']}</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No records found in the database.</p>";
    }
    ?>
</div>
</body>
</html>
