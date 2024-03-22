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
        margin-left:320px ;  
        padding-top: 100px;
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
            padding: 20px 30px;
            margin-top: 20px;
            border-radius: 20px;
            width: 800px;
        }
        .report-button{
            height: 35px;
            width: 110px;
            margin-top: 20px;
            margin-left:20px;
            color: white;
            background-color:#0b0d92d2;
            border-style: none;
            border-radius: 10px;
        }
        .report-button a{
            text-decoration: none;
            color: white;
        }
        button:hover{
            background-color: #0b0d929e;
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
        <a href="meritlist.php">
            <i class="fas fa-solid fa-user-tag"></i>
            <span>Merit List</span>
        </a>
        <a href="reports.php" class="active">
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
    <div class="heading-container">Inquiries</div>
    <div class="report-container">
        <?php
            include '../LogIn/db.php';

            if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['report_id'])) {
                $report_id = $_GET['report_id'];
                $deletesql = "DELETE FROM reports WHERE report_id = $report_id";
                if ($con->query($deletesql) === TRUE) {
                    echo "<script>alert('Report deleted successfully');</script>";
                    echo "<script>window.location.href ='reports.php'</script>";
                    exit; 
                } else {
                    echo "Error deleting report: " . $con->error;
                }
            }

            $sql = "SELECT * FROM reports";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div>';
                    echo '<p>Name: ' . $row["name"] . '</p>';
                    echo '<p>Email: ' . $row["email"] . '</p>';
                    echo '<p>Message: ' . $row["message"] . '</p>';
                    echo '<button class="report-button" onclick="replyToEmail(\'' . $row["email"] . '\')">Reply</button>';
                    echo '<button class="report-button" onclick="confirmDelete(' . $row["report_id"] . ')">Delete</button>';
                    echo '</div>'; 
                }
            } else {
                echo "<script>alert('No report for now');</script>";
                echo "<script>window.location.href ='dashboard.php'</script>";
            }
            $con->close();
        ?>
    </div>
    <script>
        function confirmDelete(report_id) {
            if (confirm("Are you sure you want to delete this report?")) {
                window.location.href = 'reports.php?action=delete&report_id=' + report_id;
            }
        }

        function replyToEmail(email) {
            var encodedEmail = encodeURIComponent(email);
            var mailtoLink = 'mailto:' + encodedEmail;
            window.open(mailtoLink, '_blank');
        }
    </script>
</body>
</html>