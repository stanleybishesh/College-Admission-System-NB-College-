<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result Message</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .message-container {
            max-width: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            
        }

        .success-message {
            color: green;
        }

        .failure-message {
            color: red;
        }
        .success-score {
            color: green;
            font-size: x-large;
            text-transform: uppercase;
        }

        .failure-score {
            color: red;
            font-size: x-large;
            text-transform: uppercase;
        }

        .celebration {
            width: 350px;
            height:350px;
            margin-top: 10px;
        }
        .proceed-button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <?php
            // Check if the 'message' parameter is set in the URL
            if (isset($_GET['message'])) {
                $message = htmlspecialchars($_GET['message']);
                
                // Check if it's a success or failure message and apply corresponding CSS class
                if (strpos($message, 'Congratulations') !== false) {
                    echo "<img class='celebration' src='../image/nblogo.png' alt='Congratulations'>";
                    echo "<p class='success-score'>$message</p>";
                    echo "<h3 >WHAT TO DO NEXT?</h3>";
                    echo "<p class='success-message'>1. Proceed to Student Admission Portal</p>";
                    echo "<p class='success-message'>2. Login using your registered Email and Password</p>";
                    echo "<p class='success-message'>3. Fill Up the Admission Form.</p>";
                    echo "<button class='proceed-button' onclick=\"window.location.href='rules.php'\">Proceed to Dashboard</button>";
                   
                   
                } else {
                    echo "<img class='celebration' src='../image/nblogo.png' alt='Congratulations'>";
                    echo "<p class='failure-score'>$message</p>";
                    echo "<h3 >WHAT TO DO NEXT?</h3>";
                    echo "<p class='failure-message'>1. Visit college for further discussion.</p>";
                    echo "<p class='failure-message'>2. Bring any identity card for verification.</p>";
                    echo "<p class='failure-message'>3. Sorry Try next time.</p>";
                    echo "<button class='proceed-button' onclick=\"window.location.href='rules.php'\">Proceed to Dashboard</button>";

                }
            } else {
                echo "<p>Invalid request</p>";
                
            }
        ?>
    </div>
      
</body>
</html>
