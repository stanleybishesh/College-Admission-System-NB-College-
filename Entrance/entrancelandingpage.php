<?php
session_start();
error_reporting(0);
include '../LogIn/db.php';
if (strlen($_SESSION['uid']==0)) {
  header('location:../LogIn/logout.php');
  } else{

  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Students</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="landing.css">
</head>

<body>
    <?php
        $uid=$_SESSION['uid'];
        $ret=mysqli_query($con,"SELECT fullname FROM users WHERE ID='$uid'");
        $row=mysqli_fetch_array($ret);
        $fullname=$row['fullname'];
    ?>

    <div class="sidebar">
        <header><?php echo $fullname;?></header>
        <a href="rules.php" target="_self">
            <i class="fas fa-qrcode"></i>
            <span>Dashboard</span>
        </a>
        <a href="entrancelandingpage.php" target="_self" class="active">
            <i class="fas fa-solid fa-file-invoice"></i>
            <span>Entrance Exam</span>
        </a>
    </div>

    <div class="navbar">
        <h2>NB College Admission System</h2>
        <a href="../LogIn/logout.php"><button onclick="return confirm('Are you sure you want to logout?')"
                type="submit">Logout</button></a>
    </div>
    <div class="top-wrapper">
        <div class="top-container">
            <h1 style="color: yellow;">WELCOME TO NB COLLEGE ENTRANCE PORTAL</h1>
            <p style="color: white; text-align: justify;">Before starting Test, read the criteria give below carefully
            </p>
            <ul class="rules-lists">
                <li>1. A examinee is eligible for admission only if he/she scores 80% or above.</li>
                <li>2. In case of Failure ,examinee is requested to visit college for further enquires.</li>
            </ul>
        </div>
    </div>
    <div class="display">
        <div class="container">
            <h1>Mock Test Rules</h1>
            <p>Before starting the mock test, please read and follow these rules:</p>
            <ul class="rules-list">
                <li>1. Ensure that you have a stable internet connection.</li>
                <li>2. Do not use any external resources during the test.</li>
                <li>3. Answer all the questions within the given time limit.</li>
                <li>4. Submit your answers before the timer runs out.</li>
                <li>5. Examinee cant give entrance exam twice.</li>
                <li>6. Keep exam content confidential after completion.</li>

            </ul>
        </div>
    </div>
    <div class="wrapper">
        <div class="containers">
            <h1>परीक्षण नियमहरू</h1>
            <p>परीक्षा सुरु गर्नु अघि, कृपया यी नियमहरू पढ्नुहोस् र पालना गर्नुहोस्:</p>
            <ul class="rules-lists">
                <li>1. तपाईंसँग स्थिर इन्टरनेट जडान छ भनी सुनिश्चित गर्नुहोस्।</li>
                <li>2. परीक्षणको क्रममा कुनै पनि बाह्य स्रोतहरू प्रयोग नगर्नुहोस्।</li>
                <li>3. दिइएको समय सीमा भित्र सबै प्रश्नहरूको जवाफ दिनुहोस्।</li>
                <li>4. टाइमर सकिन अघि आफ्नो जवाफ पेश गर्नुहोस्।</li>
                <li>5. परीक्षार्थीले दुई पटक प्रवेश परीक्षा दिन सक्दैनन्।</li>
                <li>6. परीक्षा समाप्त भएपछि परीक्षा सम्बन्धित प्रश्नहरू गोप्य राख्नुहोस्।</li>
            </ul>

        </div>
    </div>
    <div class="startbutton">
        <a href="testing.php">
            <button>Start test</button>
        </a>
    </div>

</body>


</html>

<?php }  ?>