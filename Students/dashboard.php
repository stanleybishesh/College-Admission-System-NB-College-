<?php
session_start();
error_reporting(0);
include '../LogIn/db.php';

if (strlen($_SESSION['result_id']) == 0) {
    header('location:../LogIn/logout.php');
} else {
    $result_id = $_SESSION['result_id'];
    $applicationData = mysqli_query($con, "SELECT * FROM admission_users WHERE user_results_id='$result_id'");
    $admData = mysqli_query($con, "SELECT * FROM admission_users WHERE user_results_id='{$_SESSION['result_id']}'");
    $admRow = mysqli_fetch_assoc($admData);
    $_SESSION['admission_users_id'] = $admRow['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Students</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.2.0/uicons-solid-straight/css/uicons-solid-straight.css'>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="dashboard.css">
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

    <?php
    $uid = $_SESSION['uid'];
    $ret = mysqli_query($con, "SELECT fullname FROM users WHERE ID='$uid'");
    $row = mysqli_fetch_array($ret);
    $fullname = $row['fullname'];
    ?>

    <div class="sidebar">
        <header><?php echo $fullname; ?></header>
        <a href="dashboard.php" class="active">
            <i class="fas fa-qrcode"></i>
            <span>Dashboard</span>
        </a>
        <a href="form.php">
            <i class="fas fa-solid fa-file-invoice"></i>
            <span>Application Form</span>
        </a>
        <a href="fees.php">
            <i class="fas fa-regular fa-credit-card"></i>
            <span>Submit Fees</span>
        </a>
    </div>

    <div class="navbar">
        <div class="logo">
            <img src="../image/nblogo.png" alt="Logo">
            <h2>NB College Admission System</h2>
        </div>
        <a href="../LogIn/logout.php"><button onclick="return confirm('Are you sure you want to logout?')" type="submit">Logout</button></a>
    </div>

    <div class="application-status">
        <h2>Application Status</h2>
        <table>
            <thead>
                <tr>
                    <th>Applied Date</th>
                    <th>Course</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>View</th>
                    <th>Payment</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display fetched data in the table rows
                while ($applicationRow = mysqli_fetch_assoc($applicationData)) {
                    // Fetch status for each application
                    $statusQuery = mysqli_query($con, "SELECT status FROM appstatus WHERE admission_users_id='{$applicationRow['id']}'");
                    $statusRow = mysqli_fetch_assoc($statusQuery);
                    $status = ($statusRow) ? $statusRow['status'] : "pending";
                    // Apply color based on status
                    $statusClass = ($status === 'selected') ? 'selected' : (($status === 'rejected') ? 'rejected' : '');

                    echo "<tr>";
                    echo "<td>" . $applicationRow['submission_date'] . "</td>";
                    echo "<td>" . $applicationRow['course'] . "</td>";
                    echo "<td class='$statusClass'>$status</td>";
                    if ($status === 'pending') {
                        echo "<td><a href='editAdmissionForm.php'><i class='fas fa-solid fa-pen'></i> Edit</a></td>";
                    } else {
                        echo "<td><i class='fi fi-ss-pen-slash'></i> Edit</span></td>";
                    }
                    echo "<td><a href='displayAdmissionForm.php'><i class='fas fa-solid fa-eye'></i> View</a></td>";
                    // Check if the user has paid the fee
                    $admittedQuery = mysqli_query($con, "SELECT * FROM admitted_users WHERE admission_users_id = '{$applicationRow['id']}'");
                    $isAdmitted = mysqli_num_rows($admittedQuery) > 0;
                    if ($isAdmitted) {
                        echo "<td><a href='paymentSuccess.php'><i class='fas fa-solid fa-dollar-sign'></i> Fee Receipt</a></td>";
                    } else {
                        echo "<td>Fees not paid</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>

<?php }  ?>
