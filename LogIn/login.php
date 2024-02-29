    <?php
    session_start();
    error_reporting(0);

    // Simulate the login process
    $enteredemail = $_POST['email'];
    $enteredpassword = $_POST['password'];

    // Database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "nbcollege";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $recaptcha_secret = '6LcaI2kpAAAAAKW_HDMxIeenop4kGVE0e_msA2gv';
    $recaptcha_response = $_POST['g-recaptcha-response'];

    $verify_url = "https://www.google.com/recaptcha/api/siteverify?secret={$recaptcha_secret}&response={$recaptcha_response}";
    $verify_response = file_get_contents($verify_url);
    $verify_data = json_decode($verify_response);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($verify_data->success) {
        // Fetch user from the "info" table
        $fetchUserSql = "SELECT * FROM users WHERE email = '$enteredemail' LIMIT 1";
        $result = $conn->query($fetchUserSql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($enteredpassword, $user['password'])) {
                // Fetch total marks from the "user_results" table
                $fetchTotalMarksSql = "SELECT total_marks FROM user_results WHERE email = '$enteredemail' LIMIT 1";
                $marksResult = $conn->query($fetchTotalMarksSql);

                if ($marksResult->num_rows > 0) {
                    $_SESSION['uid'] = $user['ID'];
                    $row = $marksResult->fetch_assoc();
                    $totalMarks = $row['total_marks'];

                    // Check if the user has scored 5 or more marks
                    if ($totalMarks >= 5) {
                        header("Location: ../Students/dashboard.php?email=$enteredemail&total_marks=$totalMarks");
                        exit();
                    } else {
                        // Display an error message or redirect to login.php with an error parameter
                        echo "<script>alert(\"Sorry! You didn't score enough marks for admission in this college.\");</script>";
                        echo "<script>window.location.href='main.html';</script>";
                        exit(); // Important to exit after header
                    }
                } else {
                    echo "<script>alert('No result found for this user !!!');</script>";
                    echo "<script>window.location.href='login.html';</script>";
                    exit(); // Important to exit after header
                }
            } else {
                // Display an error message or redirect to login.php with an error parameter
                echo "<script>alert('Invalid Password! Please try again.');</script>";
                echo "<script>window.location.href='login.html';</script>";
                exit(); // Important to exit after header
            }
        } else {
            // Display an error message or redirect to login.php with an error parameter
            echo "<script>alert('Invalid Email! Please try again.');</script>";
            echo "<script>window.location.href='login.html';</script>";
            exit(); // Important to exit after header
        }
    } else {
        // CAPTCHA verification failed, handle accordingly
        echo "<script>alert('Captcha verification failed');</script>";
        echo "<script>window.location.href='login.html';</script>";
        exit(); // Important to exit after header
    }

    // Close the connection
    $conn->close();
    ?>
