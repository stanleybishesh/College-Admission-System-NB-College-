<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course = $_POST["course"];
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    // Check if email or phone number already exists
    $checkQuery = "SELECT * FROM applicants WHERE email='$email' OR phone='$phone'";
    $result = $con->query($checkQuery);
    if ($result->num_rows > 0) {
        // Email or phone number already exists
        echo "<script>alert('You have already booked for counselling !!');
              window.location.href = 'main.html';
              </script>";
    } else {
        // Insert the record into the database
        $stmt = "INSERT INTO applicants (course, fullname, email, phone, address) 
                 VALUES ('$course', '$fullname', '$email', '$phone', '$address')";
        
        if ($con->query($stmt) === TRUE) {
            $mail = new PHPMailer(true);
            /*Disabling SSL certificate verification*/
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            try {
                // Mail configuration
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; 
                $mail->SMTPAuth = true;
                $mail->Username = 'sanirmrz2060@gmail.com'; 
                $mail->Password = 'iuefxrsyphofhytr'; 
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                // Recipient
                $mail->setFrom('sanirmrz2060@gmail.com', 'NB COLLEGE');
                $mail->addAddress($email, $fullname); 

                // Content
                $mail->isHTML(false);
                $mail->Subject = 'Thank you for your application!';
                $mail->Body = "Dear $fullname,\n\nThank you for applying to our course.\n\nYour details:\nCourse: $course\nFull Name: $fullname\nEmail: $email\nPhone: $phone\nAddress: $address\n\nWe will review your application and get back to you soon till then you can visit our college website.\n www.NBCOLLEGE.com.np \n Watch video:  \n https://youtu.be/WMmqVsW5RTk \n\nBest regards,\nAdmin\nNB College";
                
                // Send email
                $mail->send();

                // Success message
                echo "<script>alert('Application submitted successfully! We have sent you a confirmation email.');
                      window.location.href = 'main.html';
                      </script>";
            } catch (Exception $e) {
                // Error message if email could not be sent
                echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');
                      window.location.href = 'main.html';
                      </script>";
            }
        } else {
            // Error message if query execution failed
            echo "<script>alert('Error executing');
                  window.location.href = 'main.html';
                  </script>";
        }
    }
}

$con->close();
?>
