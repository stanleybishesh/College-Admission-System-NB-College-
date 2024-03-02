<?php
include '../LogIn/db.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
        $deleteSql = "DELETE FROM users WHERE ID='$id'";
        if ($con->query($deleteSql) === TRUE) {
            echo "<script>
            alert('Record deleted successfully');
            window.location.href = 'searchapp.php';
          </script>";;
        } else {
            echo "<script>
            alert('Error deleting record');
            window.location.href = 'searchapp.php';
          </script>". $con->error;
        }
    } else {
        echo "<script>
            var confirmation = confirm('Are you sure you want to delete this record?');
            if (confirmation) {
                window.location.href = 'delete.php?id={$id}&confirm=true';
            } else {
                window.location.href = 'searchapp.php'; 
            }
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
