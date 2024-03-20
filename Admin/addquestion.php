<?php
include '../LogIn/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correct_answer = $_POST['correct_answer'];
    $sql = "INSERT INTO test_questions (question, option1, option2, option3, option4, correct_answer) VALUES ('$question', '$option1', '$option2', '$option3', '$option4', '$correct_answer')";
    if (mysqli_query($con, $sql)) {
        echo "<script>
        alert('Question added successfully');
        window.location.href = 'editquestion.php';
      </script>";
    } else {
        echo "<script>
        alert('Error adding question');
        window.location.href = 'editquestion.php';
      </script>";
    }
} else {
    echo "<script>
        alert('Error');
        window.location.href = 'editquestion.php';
      </script>";
}
?>
