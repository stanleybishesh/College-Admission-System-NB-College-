<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles.css">
    <Style>
        .searchbar{
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin-left:20%;
            margin-right:3%;
            text-align: center;
            flex-direction:column;
        }
        label{
            font-size:20px;
            margin-right:15px;
        }
        input {
           height:35px;
           width:400px;
           border-radius:10px;
           border-style:none;
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
        <a href="searchapp.php" class="active">
            <i class="fas fa-search"></i>
            <span>Search Application</span>
        </a>
        <a href="meritlist.php">
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

    <div class="searchbar">

        <h2>SEARCH USER</h2>
        <br>
        <form method="post">
        <label for="email">Enter Email:</label>
        <input type="text" name="email" required>
        <button type="submit">Search</button><br>
        </form>
        <br>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "nbcollege";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];

            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
            echo "<h2>USER DETAILS:</h2><br>";
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Phone number</th><th></th><th></th></tr>";
         while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['ID']}</td><td>{$row['fullname']}</td><td>{$row['email']}</td><td>{$row['number']}</td>
            <td><a href='edit.php?id={$row['ID']}'>Edit</a></td><td><a href='delete.php?id={$row['ID']}'>Delete</a></td></tr>";
            }
            echo "</table>";
         } else {
            echo "<p>No user found with the provided email.</p>";  
         }
          $conn->close();
        }
        ?>
    </div>
</body>
</html>

