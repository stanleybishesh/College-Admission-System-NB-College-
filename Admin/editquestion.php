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
    <style>
        input[type=submit] {
            background-color:#0b0d92d2;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
        }
        input[type=submit]:hover {
            cursor: pointer;
            background-color:#0b0d92a3;
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
 <h2>Edit Questions</h2>
    <?php
    include '../LogIn/db.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        foreach ($_POST as $key => $value) {
            // Check if key corresponds to a question field
            if (strpos($key, 'question_') === 0) {
                $question_id = substr($key, strlen('question_'));
                $question = mysqli_real_escape_string($con, $_POST['question_' . $question_id]);
                $option1 = mysqli_real_escape_string($con, $_POST['option1_' . $question_id]);
                $option2 = mysqli_real_escape_string($con, $_POST['option2_' . $question_id]);
                $option3 = mysqli_real_escape_string($con, $_POST['option3_' . $question_id]);
                $option4 = mysqli_real_escape_string($con, $_POST['option4_' . $question_id]);
                $correct_answer = mysqli_real_escape_string($con, $_POST['correct_answer_' . $question_id]);

                // Update the question in the database
                $updatesql = "UPDATE test_questions SET question='$question', option1='$option1', option2='$option2', option3='$option3', option4='$option4', correct_answer='$correct_answer' WHERE ID='$question_id'";
                if (!mysqli_query($con, $updatesql)) {
                    echo "Error updating question: " . mysqli_error($con);
                }
            }
        }
        echo "<script>alert('Questions updated successfully!');
        window.location.href = 'course.php';
      </script>";
    }
    $sql = "SELECT * FROM test_questions";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">';
        while($row = mysqli_fetch_assoc($result)) {
            
            echo "<label for='question_" . $row["ID"] . "'>Question:</label><br>";
            echo "<input type='text' id='question_" . $row["ID"] . "' name='question_" . $row["ID"] . "' value='" . $row["question"] . "' 
            style='width: 800px;height:40px;color:white;background-color:#0b0d92d2;padding-left:15px;font-size: large;border-style:none;'><br>";

            echo "<label for='option1_" . $row["ID"] . "'>Option 1:</label><br>";
            echo "<input type='text' id='option1_" . $row["ID"] . "' name='option1_" . $row["ID"] . "' value='" . $row["option1"] . "' style='width: 500px;height:30px;padding-left:15px;'><br>";

            echo "<label for='option2_" . $row["ID"] . "'>Option 2:</label><br>";
            echo "<input type='text' id='option2_" . $row["ID"] . "' name='option2_" . $row["ID"] . "' value='" . $row["option2"] . "'style='width: 500px;height:30px;padding-left:15px;'><br>";

            echo "<label for='option3_" . $row["ID"] . "'>Option 3:</label><br>";
            echo "<input type='text' id='option3_" . $row["ID"] . "' name='option3_" . $row["ID"] . "' value='" . $row["option3"] . "'style='width: 500px;height:30px;padding-left:15px;'><br>";

            echo "<label for='option4_" . $row["ID"] . "'>Option 4:</label><br>";
            echo "<input type='text' id='option4_" . $row["ID"] . "' name='option4_" . $row["ID"] . "' value='" . $row["option4"] . "'style='width: 500px;height:30px;padding-left:15px;'><br>";

            echo "<label for='correct_answer_" . $row["ID"] . "'>Correct Answer:</label><br>";
            echo "<input type='text' id='correct_answer_" . $row["ID"] . "' name='correct_answer_" . $row["ID"] . "' value='" . $row["correct_answer"] . "'
            style='width: 300px;height:30px;padding-left:15px;background-color:green;color:white;'><br><br>";
        }
        echo '<input type="submit" value="Update Questions">';
        echo '</form>';
    } else {
        echo "0 results";
    }

    mysqli_close($con);
    ?>
</div>
<div>
    <form action="addquestion.php" method="post">
    <h2>Add a New Question</h2>
        <label for="question">Question:</label><br>
        <input type="text" id="question" name="question" style='width: 800px;height:40px;padding-left:15px;font-size: large;' required><br><br>
        
        <label for="option1">Option 1:</label><br>
        <input type="text" id="option1" name="option1" style='width: 500px;height:30px;padding-left:15px;' required><br><br>
        
        <label for="option2">Option 2:</label><br>
        <input type="text" id="option2" name="option2" style='width: 500px;height:30px;padding-left:15px;' required><br><br>
        
        <label for="option3">Option 3:</label><br>
        <input type="text" id="option3" name="option3" style='width: 500px;height:30px;padding-left:15px;' required><br><br>
        
        <label for="option4">Option 4:</label><br>
        <input type="text" id="option4" name="option4" style='width: 500px;height:30px;padding-left:15px;' required><br><br>
        
        <label for="correct_answer">Correct Answer:</label><br>
        <input type="text" id="correct_answer" name="correct_answer" style='width: 300px;height:30px;padding-left:15px;' required><br><br>
        
        <input type="submit" value="Submit">
    </form>
</div>
</div>

</body>

</html>