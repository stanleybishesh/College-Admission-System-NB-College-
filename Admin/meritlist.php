<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nbcollege";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Initialize default row count
$rowCount = isset($_GET['rowCount']) ? intval($_GET['rowCount']) : 10;

$sql = "SELECT ID, username, email, total_marks FROM user_results ORDER BY total_marks DESC LIMIT $rowCount";
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
            width: 75%;
            margin: 100px 330px;
            position: absolute;
            display: flex;
            flex-direction:column;
        }
        table {
            /* border-collapse: collapse; */
            width: 100%;
            margin-top: 10px;
        }
        td {
            background-color:rgba(152, 152, 152, 0.66);
            padding: 10px;
        }
        th {
            padding: 10px;
            text-align: left;
            background-color: rgba(89, 89, 242, 0.871);
        }
        .options {
            margin-top: 10px;
        }
        .options input[type="number"] {
            background-color: white;
            border-radius: 5px;
            margin: 5px 10px 5px 0px;
            padding:5px 10px;
            width: 100px;
        }
        .options button{
            border: 2px solid black;
            width: 30px;
        }
        .options button:hover{
            background-color: lightblue;
            cursor: pointer;
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
        <a href="meritlist.php" class="active">
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
    <div class="listbar">
        <h2>Examinees Merit List</h2>

        <div class="options">
            <label for="rowCount">Show:</label><br>
            <input type="number" id="rowCount" min="1" max="100" value="10">
            <button onclick="updateRows()"><i class="fas fa-solid fa-check"></i></i></button>
        </div>

        <?php
            $serialNumber = 1;
            if ($result->num_rows > 0){
                echo "<table><tr><th>SN</th><th>Username</th><th>Email</th><th>Total Marks</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $serialNumber . "</td><td>{$row['username']}</td><td>{$row['email']}</td><td>{$row['total_marks']}</td></tr>";
                    $serialNumber++;
                }
                echo "</table>";
            } else {
                echo "<script>alert('No records found in the database.');</script>";
                echo "<script>window.location.href='dashboard.php';</script>";
            }
        ?>
    </div>
    <script>
        function updateRows() {
            var rowCount = document.getElementById("rowCount").value;
            window.location.href = "meritlist.php?rowCount=" + rowCount;
        }
    </script>
</body>
</html>
