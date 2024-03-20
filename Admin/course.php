<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="courseapply.css">
</head>

<body>
    <div class="sidebar">
        <header>Admin</header>
        <a href="dashboard.php">
            <i class="fas fa-qrcode"></i>
            <span>Dashboard</span>
        </a>
        <a href="course.php" class="active">
            <i class="fas fa-solid fa-graduation-cap"></i>
            <span>Course</span>
        </a>
        <a href="regUsers.php">
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
                type="submit">Logout</button></a>
    </div>
    <div class="flex-container">
        <div>
            <h2>COURSE AVAILABLE</h2>
      <div class="section">
        <h1>BCA</h1>
        <h3>Department of Humanities and Social Science<h3>
        <button onclick="window.location.href='editquestion.php'">Edit Questions</button>
        <button onclick="addNewStaff()">Add New Staff</button>
        <button onclick="window.location.href='regUsers.php'">View Students</button>
</div>
      <div class="section">
        <h1>Bsc.CSIT</h1>
        <h3>Department of Information and Technology<h3>
        <button onclick="window.location.href='editquestion.php'">Edit Questions</button>
        <button onclick="addNewStaff()">Add New Staff</button>
        <button onclick="window.location.href='regUsers.php'">View Students</button>
      </div>
      <script>
    function addNewStaff() {
        const staffName = prompt('Enter the name of the new staff:');
        const staffrole = prompt('Enter the position of the new staff:');
        if (staffName !== null && staffName !=='' && staffrole !== null && staffrole !== '') {
            alert('Successfully registered!');
        } else {
          
            return;
        }
    }
</script>

</div>
</div>

</body>

</html>