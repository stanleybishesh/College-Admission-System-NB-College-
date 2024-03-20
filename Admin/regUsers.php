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
        <a href="regUsers.php" class="active">
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
            type="submit">Logout</button></a>    </div>

<div class="listbar">
    <?php
   include '../LogIn/db.php';
   $sql = "SELECT au.id,au.course, au.citizenship, au.first_name, au.last_name, au.dob, au.gender
        FROM admission_users AS au JOIN appstatus AS asp ON au.id = asp.admission_users_id WHERE asp.status = 'selected'";
$result = $con->query($sql);

$bca_users = array();
$csit_users = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if ($row["course"] == "bca") {
            $bca_users[] = $row;
        } elseif ($row["course"] == "bsccsit") {
            $csit_users[] = $row;
        }
    }
}

if (!empty($bca_users)) {
    echo "<h2>BCA Course</h2>";
    echo "<table border='1'>
            <tr>
                <th>User ID</th>
                <th>Course</th>
                <th>Citizenship</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>DOB</th>
                <th>Gender</th>
            </tr>";
    foreach ($bca_users as $user) {
        echo "<tr>
                <td>".$user["id"]."</td>
                <td>".$user["course"]."</td>
                <td>".$user["citizenship"]."</td>
                <td>".$user["first_name"]."</td>
                <td>".$user["last_name"]."</td>
                <td>".$user["dob"]."</td>
                <td>".$user["gender"]."</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No BCA users found</p>";
}

if (!empty($csit_users)) {
    echo "<h2>CSIT Course</h2>";
    echo "<table border='1'>
            <tr>
                <th>User ID</th>
                <th>Course</th>
                <th>Citizenship</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>DOB</th>
                <th>Gender</th>
            </tr>";
    foreach ($csit_users as $user) {
        echo "<tr>
                <td>".$user["id"]."</td>
                <td>".$user["course"]."</td>
                <td>".$user["citizenship"]."</td>
                <td>".$user["first_name"]."</td>
                <td>".$user["last_name"]."</td>
                <td>".$user["dob"]."</td>
                <td>".$user["gender"]."</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No CSIT users found</p>";
}

    $con->close();
    ?>

</div>
</body>
</html>