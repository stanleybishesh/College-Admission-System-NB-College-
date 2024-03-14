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
    <title>Edit Information</title>
    <style>
body {
    font-family: 'Lato', sans-serif;
    margin: 0;
    padding: 0;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

label {
    display: block;
    margin-bottom: 10px;
}

input[type="text"],input[type="email"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

button[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

</style>
</head>
<body>

    <h2>Edit Information</h2>

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
