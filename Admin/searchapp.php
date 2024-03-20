<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="searchkaro.css">
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
        <a href="searchapp.php" class="active">
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
    <div>
    <h2>Search Applicants</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="searchQuery">Search By Student Name / Number / Email</label><br>
        <input type="text" name="searchQuery" id="searchInput" ><br>
        <button type="submit">Search</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['searchQuery'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "nbcollege";
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $searchQuery = $_POST['searchQuery'];
    $sql = "SELECT * FROM users WHERE fullname LIKE '%$searchQuery%' OR number LIKE '%$searchQuery%' OR email LIKE '%$searchQuery%'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<caption> Result for '$searchQuery':</caption>";
        echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Phone Number</th><th colspan='2'>Actions</th></tr>";

        while($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['ID']}</td><td>{$row['fullname']}</td><td>{$row['email']}</td><td>{$row['number']}</td>
            <td><a href='edit.php?id={$row['ID']}'>Edit</a></td><td><a href='delete.php?id={$row['ID']}'>Delete</a></td></tr>";
            }
        echo "</table>";
    } else {
        echo "No results found";
        }
        $conn->close();
        }
        ?>
    </div>
    </div>
</body>
</html>

