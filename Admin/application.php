<?php
session_start();
error_reporting(0);
include '../LogIn/db.php';
$applicationData = mysqli_query($con, "SELECT * FROM admission_users
                                        JOIN users ON admission_users.user_id=users.id
                                        JOIN user_results ON admission_users.user_results_id=user_results.ID 
                                        ORDER BY user_results.total_marks DESC");
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
    <link rel="stylesheet" href="../Students/dashboard.css">
    <style>
        .selected {
            color: green;
        }

        .rejected {
            color: red;
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
            <span>Registered Users</span>
        </a>
        <a href="application.php" class="active">
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

    <div class="application-status">
        <h2>Application Status</h2>
        <table>
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Course</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Score</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $serialNumber = 1;
                    // Display fetched data in the table rows
                    while ($applicationRow = mysqli_fetch_assoc($applicationData)) {
                        // Fetch status for the current application
                        $statusQuery = mysqli_query($con, "SELECT status FROM appstatus WHERE admission_users_id = '{$applicationRow['id']}'");
                        $statusRow = mysqli_fetch_assoc($statusQuery);
                        $status = isset($statusRow['status']) ? $statusRow['status'] : 'pending';
                        $statusClass = ($status === 'selected') ? 'selected' : (($status === 'rejected') ? 'rejected' : '');

                        echo "<tr>";
                        echo "<td>" . $serialNumber . "</td>";
                        echo "<td>" . $applicationRow['course'] . "</td>";
                        echo "<td>" . $applicationRow['first_name'] . "</td>";
                        echo "<td>" . $applicationRow['last_name'] . "</td>";
                        echo "<td>" . $applicationRow['number'] . "</td>";
                        echo "<td>" . $applicationRow['email'] . "</td>";
                        echo "<td>" . $applicationRow['total_marks'] . "</td>";
                        echo "<td class='$statusClass'>$status</td>";
                        
                        // Conditionally show/hide the view link based on status
                        if ($status === 'pending') {
                            echo "<td><a href='selectOrReject.php?user_results_id=" . $applicationRow['user_results_id'] . "'><i class='fas fa-solid fa-eye'></i> View</a></td>";
                        } else {
                            echo "<td><i class='fas fa-solid fa-eye-slash'></i></i> View</td>";
                        }
                        
                        echo "</tr>";
                        $serialNumber++;
                    }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>

<?php ?>