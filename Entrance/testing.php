<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nbcollege";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch all questions
$sql = "SELECT * FROM test_questions";
$result = $conn->query($sql);

// Check if there's at least one result
if ($result->num_rows > 0) {
    // Fetch and display all questions
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
} else {
    $questions = array("No questions found.");
}

// Close the connection
$conn->close();
?>
<?php
session_start();
error_reporting(0);
include '../LogIn/db.php';
if (strlen($_SESSION['uid']==0)) {
  header('location:../LogIn/logout.php');
  } else{

  ?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

    <link rel="stylesheet" href="quizcss.css">
    <title>Quiz Platform</title>
    <!-- Add this script tag inside the <head> or at the end of the <body> -->
<script>
    // Set the countdown time in seconds
    var countdownTime = 100; // 100 seconds

    // Function to update the countdown and disable options when it reaches zero
    function updateCountdown() {
        document.getElementById("timer").innerHTML = countdownTime + "s";
        if (countdownTime === 0) {
            disableOptions();
        } else {
            countdownTime--;
            setTimeout(updateCountdown, 1000); // Update every 1 second
        }
    }

    // Function to disable radio buttons and submit button
    function disableOptions() {
        var radioButtons = document.querySelectorAll('input[type="radio"]');
       // var submitButton = document.getElementById("submitBtn");

        radioButtons.forEach(function (radioButton) {
            radioButton.disabled = true;
        });

      //  submitButton.disabled = true;
    }

    // Start the countdown when the page loads
    window.onload = function () {
        updateCountdown();
    };
</script>

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
        <a href="rules.php" target="_self" >
            <i class="fas fa-qrcode"></i>
            <span>Dashboard</span>
        </a>
        <a href="#" target="_self" class="active">
            <i class="fas fa-solid fa-file-invoice"></i>
            <span>Entrance Exam</span>
        </a>
    </div>

    <div class="navbar">
        <h2>NB College Admission System</h2>
        <a href="../LogIn/logout.php"><button onclick="return confirm('Are you sure you want to logout?')" type="submit">Logout</button></a>
    </div>
  
<div class="questions">
    <h1>Take the Test</h1>
     <div style="color:red">TIME REMAINING:</div><div id="timer">100s</div>
    <form>
<?php
// Display questions
foreach ($questions as $question) {
    echo "<p>Question: " . $question['question'] . "</p>";
    
    // Display options as radio buttons
    echo "<label><input type='radio' name='answers[".$question['ID']."]' value='1'>" . $question['option1'] . "</label><br>";
    echo "<label><input type='radio' name='answers[".$question['ID']."]' value='2'>" . $question['option2'] . "</label><br>";
    echo "<label><input type='radio' name='answers[".$question['ID']."]' value='3'>" . $question['option3'] . "</label><br>";
    echo "<label><input type='radio' name='answers[".$question['ID']."]' value='4'>" . $question['option4'] . "</label><br>";
    
    echo "<hr>";
}
?>

<button id="submitBtn" type="submit">Submit Answers</button>


</form>

</div>
</body>
</html>

<?php }  ?>