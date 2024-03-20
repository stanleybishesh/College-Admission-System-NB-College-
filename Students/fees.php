<?php
session_start();
error_reporting(0);
include '../LogIn/db.php';

$args = http_build_query(array(
'token' => 'QUao9cqFzxPgvWJNi9aKac',
'amount'  => 1000
));

$url = "https://khalti.com/api/v2/payment/verify/";

# Make the call using API.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$headers = ['Authorization: Key test_secret_key_dd0964adb98e4640894e186310aaf818'];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Response
$response = curl_exec($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$applicationData = mysqli_query($con, "SELECT * FROM admission_users WHERE user_results_id='{$_SESSION['result_id']}'");
$applicationRow = mysqli_fetch_assoc($applicationData);
$_SESSION['admission_users_id'] = $applicationRow['id'];

if (strlen($_SESSION['result_id']==0)) {
  header('location:../LogIn/logout.php');
  } else{
    $status_query = mysqli_query($con, "SELECT * FROM appstatus WHERE admission_users_id={$applicationRow['id']}");
    $status_row = mysqli_fetch_assoc($status_query);
    $remark = $status_row['remark'];
    $fee = $status_row['fee'];
    $status = $status_row['status']; // Fetch status from the database

    // Check if the user's admission ID exists in admitted_users table
    $admittedUserCheckQuery = "SELECT * FROM admitted_users WHERE admission_users_id = {$_SESSION['admission_users_id']}";
    $admittedUserCheckResult = mysqli_query($con, $admittedUserCheckQuery);
    $admittedUserExists = mysqli_num_rows($admittedUserCheckResult) > 0;

    if ($admittedUserExists) {
        echo "<script>alert('You have already paid the admission fee !');</script>";
        echo "<script>window.location.href = 'dashboard.php';</script>";
        exit; // Stop further execution
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
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="fees.css">
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
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
        <a href="dashboard.php">
            <i class="fas fa-qrcode"></i>
            <span>Dashboard</span>
        </a>
        <a href="form.php">
            <i class="fas fa-solid fa-file-invoice"></i>
            <span>Application Form</span>
        </a>
        <a href="fees.php" class="active">
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
        <h2 class="remark" style="color: <?php echo $status == 'selected' ? 'green' : 'red'; ?>"><?php echo $remark; ?></h2>
        <?php 
            if ($status == 'selected') {
        ?>
        <div class="fee-section">
            <h3>Admission Fee</h3>
            <form action="" method="post">
                <label for="fee_amount">Payment Amount</label><br>
                <input type="text" id="fee_amount" name="fee_amount" value="<?php echo $fee; ?>" disabled><br>
                <label for="mode_of_payment">Mode of Payment</label><br>
                <select name="mode_of_payment" id="mode_of_payment" required>
                    <option value="default" selected disabled>Choose Mode of Payment</option>
                    <option value="khalti">Khalti Wallet</option>
                </select><br>
                <label for="transaction_date">Date of Transaction</label><br>
                <input type="date" name="transaction_date" id="transaction_date" required><br>
                <button type="button" id='payment-button'>Pay with Khalti</button>
            </form>
        </div>
    </div>

    <script>
        var config = {
            // replace the publicKey with yours
            "publicKey": "test_public_key_cacd684b8cd342c2b7613287c5670fe6",
            "productIdentity": "1234567890",
            "productName": "Dragon",
            "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
            "paymentPreference": [
                "KHALTI",
                "EBANKING",
                "MOBILE_BANKING",
                "CONNECT_IPS",
                "SCT",
                ],
            "eventHandler": {
                onSuccess(payload) {
                    // Extract necessary data from the payload
                    // var transactionId = payload.idx;
                    var paymentAmount = document.getElementById('fee_amount').value;

                    // Get other form data
                    var mode = document.getElementById('mode_of_payment').value;
                    var transactionDate = document.getElementById('transaction_date').value;

                    // Prepare form data to be sent to the server
                    var formData = new FormData();
                    formData.append('fee_amount', paymentAmount);
                    formData.append('mode_of_payment', mode);
                    formData.append('transaction_date', transactionDate);

                    // Make an AJAX request to insert data into the admitted_users table
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'insert_admitted_users.php', true);
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            // Insertion successful
                            console.log(xhr.responseText);
                            alert("Payment Success. Your admission has been confirmed. Thank you!");
                            window.location.href = "paymentSuccess.php";
                        } else {
                            // Error handling
                            console.error(xhr.statusText);
                            alert("An error occurred while processing your admission. Please contact support.");
                            window.location.href = "fees.php"; // Redirect to fees page
                        }
                    };
                    xhr.onerror = function() {
                        console.error(xhr.statusText);
                        alert("An error occurred while processing your admission. Please contact support.");
                        window.location.href = "fees.php"; // Redirect to fees page
                    };
                    xhr.send(formData);
                },
                onError (error) {
                    console.log(error);
                    alert("Payment failed. Please try again.");
                    window.location.href = "fees.php";
                },
                onClose () {
                    console.log('widget is closing');
                }
            }
        };

        var checkout = new KhaltiCheckout(config);
        var btn = document.getElementById('payment-button');
        btn.onclick = function () {
            // minimum transaction amount must be 10, i.e 1000 in paisa.
            checkout.show({amount: 1000});
        }
    </script>
    <?php }?>
</body>

</html>

<?php }  

?>