<?php
session_start();
error_reporting(0);
include '../LogIn/db.php';

if (isset($_SESSION['admission_users_id'])) {
    $admission_users_id = $_SESSION['admission_users_id'];
    $admittedUserData = mysqli_query($con, "SELECT * FROM admitted_users 
                                            JOIN admission_users ON admitted_users.admission_users_id = admission_users.id 
                                            WHERE admitted_users.admission_users_id = '$admission_users_id'");
    $admittedUserRow = mysqli_fetch_assoc($admittedUserData);
    $course = $admittedUserRow['course'];
    $admissionDate = $admittedUserRow['submission_date'];
    $transactionDate = $admittedUserRow['transaction_date'];
    $mode = $admittedUserRow['mode_of_payment'];
    $paymentAmount = $admittedUserRow['fee_amount'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Students</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="paymentSuccess.css">
    <style>
        <?php
        // Read CSS file contents and output them
        $cssFile = file_get_contents('paymentSuccess.css');
        echo $cssFile;
        ?>
    </style>    
</head>

<body>

    <?php
    $uid = $_SESSION['uid'];
    $ret = mysqli_query($con, "SELECT * FROM users WHERE ID='$uid'");
    $row = mysqli_fetch_array($ret);
    $fullname = $row['fullname'];
    $number = $row['number'];
    $email = $row['email'];
    ?>

    <div class="sidebar">
        <header><?php echo $fullname; ?></header>
        <a href="dashboard.php">
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

    <div class="fee-content">
        <h2>Congratulations, you are officially a student of NB College !</h2>
        <div class="success-info">
            <div class="images">
            <img src="../image/checkmark.png" alt="payment success">
            <h3>Payment Successful</h3>
            <img src="../image/nblogo.png" id="collegeLogo" alt="college logo">
            </div>
            <table>
                <tr>
                    <th>Mode of Payment:</th>
                    <td><?php echo $mode; ?></td>
                </tr>
                <tr>
                    <th>Course:</th>
                    <td><?php echo $course; ?></td>
                </tr>
                <tr>
                    <th>Full Name:</th>
                    <td><?php echo $fullname; ?></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><?php echo $email; ?></td>
                </tr>
                <tr>
                    <th>Phone Number:</th>
                    <td><?php echo $number; ?></td>
                </tr>
                <tr>
                    <th>Transaction Date:</th>
                    <td><?php echo $transactionDate; ?></td>
                </tr>
                <tr>
                    <th class="fee">Payment Amount:</th>
                    <td class="fee">Rs. <?php echo $paymentAmount; ?></td>
                </tr>
            </table>
            <div class="buttons">
                <button class="download" onclick="downloadContent()">Download</button>
                <button class="print" onclick="printPage()">Print</button>
                <button class="close" onclick="window.location.href='dashboard.php'">Close</button>
            </div>
        </div>
    </div>

    <script>
        function printPage() {
            window.print();
        }
        function downloadContent() {
            var contentElement = document.querySelector('.success-info');
            var content = contentElement.outerHTML;

            // Fetch CSS
            fetch('paymentSuccess.css')
                .then(response => response.text())
                .then(styles => {
                    // Convert images to base64-encoded data URLs
                    var promises = [];
                    contentElement.querySelectorAll('img').forEach(img => {
                        promises.push(
                            new Promise(resolve => {
                                var canvas = document.createElement('canvas');
                                var ctx = canvas.getContext('2d');

                                // Load image and draw it on the canvas
                                var imgElement = new Image();
                                imgElement.crossOrigin = 'Anonymous'; // Enable CORS for the image
                                imgElement.onload = function () {
                                    canvas.width = imgElement.width;
                                    canvas.height = imgElement.height;
                                    ctx.drawImage(imgElement, 0, 0);

                                    // Convert canvas content to base64-encoded data URL
                                    var dataUrl = canvas.toDataURL('image/png');
                                    img.src = dataUrl; // Replace the original image with the data URL
                                    resolve();
                                };

                                imgElement.onerror = function () {
                                    console.error('Failed to load image: ' + img.src);
                                    resolve(); // Continue even if an image fails to load
                                };

                                imgElement.src = img.src; // Trigger the image load
                            })
                        );
                    });

                    // Wait for all promises to resolve
                    Promise.all(promises).then(() => {
                        // Combine styles and HTML content
                        var htmlContent = '<!DOCTYPE html><html lang="en"><head>' +
                            '<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">' +
                            '<title>Admission Form</title>' +
                            '<style>' + styles + '</style>' +
                            '</head><body>' +
                            content +
                            '</body></html>';

                        // Create and trigger download
                        var blob = new Blob([htmlContent], { type: 'text/html' });
                        var a = document.createElement('a');
                        a.href = URL.createObjectURL(blob);
                        a.download = 'payment_success.html';
                        a.click();
                    });
                })
                .catch(error => console.error('Failed to fetch CSS: ', error));
        }
    </script>
</body>

</html>

