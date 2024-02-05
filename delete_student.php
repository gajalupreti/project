<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

include('db_config.php');

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    
    $result = $conn->query("SELECT * FROM students WHERE id = $id");
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $dob = $row['dob'];
        $grade = $row['grade'];
        echo "<form action='confirm_delete.php' method='POST'>
        <input type='hidden' name='id' value='$id'>
        
        <label for='name'>Name:</label>
        <input type='text' id='name' name='name' value='$name' required style='text-align: center;'>
        
        <label for='dob'>Date of Birth:</label>
        <input type='date' id='dob' name='dob' value='$dob' required style='text-align: center;'>
        
        <label for='grade'>Grade:</label>
        <input type='text' id='grade' name='grade' value='$grade' required  style='text-align: center;'>
        
        <button type='submit'>Confirn Delete</button>
    </form>";

    } else {
        $error_message = "Student not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Delete Student</title>
</head>
<body style="text-align:center">
    <h2>Delete Student</h2>
    <form action="delete_student.php" method="POST">
        <label for="id">Student ID:</label>
        <input type="text" id="id" name="id" required>
        <button type="submit">Fetch Details</button>
    </form>

    <?php
    if (!empty($error_message)) {
        echo "<p class='error-message'>$error_message</p>";
    }
    ?>
    <div class="btn-container">
<a class="btn logout-btn" href="SLM.php"> go back to SLM Page</a>
</div>

</body>
</html>
