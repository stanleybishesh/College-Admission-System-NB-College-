
<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check username and password (replace this with database authentication)
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Dummy credentials for demonstration
    $validemail = "NB@gmail.com";
    $validPassword = "admin";

    if ($email == $validemail && $password == $validPassword) {
      //session_start();
     // $_SESSION["email"] = $email;
      header("Location:dashboard.php");
      exit();
    } else {
      echo "<p>Invalid username or password.</p>";
    }
  }
  ?>
