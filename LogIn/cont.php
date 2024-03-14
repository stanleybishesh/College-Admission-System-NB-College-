<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["Name"];
    $email = $_POST["Email"];
    $message = $_POST["Message"];

    $stmt = $con->prepare("INSERT INTO reports (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'sanirmrz2060@gmail.com'; 
            $mail->Password = 'iuefxrsyphofhytr'; 
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('sanirmrz2060@gmail.com', 'NB COLLEGE');
            $mail->addAddress($email, $name); 

            $mail->isHTML(false);
            $mail->Subject = 'Thank you for reaching us!';
            $mail->Body = "Dear $name,\n\nThank you for contacting us.\n\nWe have received your message and will get back to you soon.\nIn the meantime, please visit our website for more information.\n www.NBCOLLEGE.com.np \n\nBest regards,\nAdmin\nNB College";
            $mail->send();

        echo "<script>alert('Message send successfully!');
        window.location.href = 'main.html';
        </script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    } else {
        echo "<script>alert('Error executing');
        window.location.href = 'main.html';
        </script>";
    }
    $stmt->close();
} else {
    echo "<script>alert('Sending Message failed. Please try again.');
    window.location.href = 'main.html';
    </script>";
}

$con->close();
?>
