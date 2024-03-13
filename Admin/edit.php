<?php
include '../LogIn/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $newName = $_POST["newName"];
    $newEmail = $_POST["newEmail"];
    $newNumber = $_POST["newNumber"];
    $updateSql = "UPDATE users SET fullname='$newName', email='$newEmail', number='$newNumber' WHERE ID='$id'";

    if ($con->query($updateSql) === TRUE) {
        echo "<script>
        alert('Record updated successfully');
        window.location.href = 'searchapp.php';
      </script>";
    } else {
        echo "<script>
        alert('Error updating Record !');
        window.location.href = 'searchapp.php';
      </script>" . $con->error;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $selectSql = "SELECT * FROM users WHERE ID='$id'";
    $result = $con->query($selectSql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['fullname'];
        $email = $row['email'];
        $number = $row['number'];
    } else {
        echo "<script>
        alert('User not found !');
        window.location.href = 'searchapp.php';
      </script>";
    }
} else {
    echo "<script>
    alert('Invalid Request !');
    window.location.href = 'searchapp.php';
  </script>";
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>

    <h2>Edit User</h2>

    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="newName">Name:</label>
        <input type="text" name="newName" value="<?php echo $name; ?>" required><br>
        
        <label for="newEmail">Email:</label>
        <input type="email" name="newEmail" value="<?php echo $email; ?>" required><br>
        
        <label for="newNumber">Phone number:</label>
        <input type="text" name="newNumber" value="<?php echo $number; ?>" required><br>
        
        <button type="submit">Update</button>
    </form>

</body>
</html>
