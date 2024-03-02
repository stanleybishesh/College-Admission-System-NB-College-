<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Search</title>
</head>
<body>
    <h2>User Search</h2>
    <form action="searchphp.php" method="post">
        <label for="email">Enter Email:</label>
        <input type="text" name="email" required>
        <button type="submit">Search</button>
    </form>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nbcollege";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3>User Details:</h3>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Phone number</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['ID']}</td><td>{$row['fullname']}</td><td>{$row['email']}</td><td>{$row['number']}</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No user found with the provided email.</p>";
    }
    $conn->close();
}
?>
