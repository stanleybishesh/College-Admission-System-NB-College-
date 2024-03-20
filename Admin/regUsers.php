<?php
    session_start();
    error_reporting(0);
    include '../LogIn/db.php';

    // Fetch admitted students data with required joins
    $admittedStudentsData = mysqli_query($con, "SELECT * FROM admission_users AS adu
                                                JOIN users AS u ON u.id=adu.user_id
                                                JOIN user_results AS ur ON ur.id=adu.user_results_id
                                                JOIN admitted_users AS au ON au.admission_users_id = adu.id");
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
    <link rel="stylesheet" href="regUsers.css">
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

    <div class="admitted-students">
        <h2>Admitted Students List</h2>
        <table>
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Course</th>
                    <th>Full Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Citizenship</th>
                    <th>Score</th>
                    <th>Transaction Date</th>
                    <th>Fee Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $serialNumber = 1;
                    // Display admitted students data in table rows
                    while ($row = mysqli_fetch_assoc($admittedStudentsData)) {
                        echo "<tr>";
                        echo "<td>" . $serialNumber . "</td>";
                        echo "<td>" . $row['course'] . "</td>";
                        echo "<td>" . $row['fullname'] . "</td>";
                        echo "<td>" . $row['number'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['citizenship'] . "</td>";
                        echo "<td>" . $row['total_marks'] . "</td>";
                        echo "<td>" . $row['transaction_date'] . "</td>";
                        echo "<td>" . $row['fee_amount'] . "</td>";
                        echo "</tr>";
                        $serialNumber++;
                    }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>