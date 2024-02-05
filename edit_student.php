<?php
session_start();

// Check if the user is not logged in as admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php"); // Redirect to the login page if not logged in
    exit();
}

include('db_config.php');

// Check if the form is submitted for fetching details
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['fetch_submit'])) {
    $id = $_POST['id'];

    // Fetch student details for the specified ID
    $result = $conn->query("SELECT * FROM students WHERE id = $id");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $dob = $row['dob'];
        $grade = $row['grade'];
    } else {
        $error_message = "Student not found.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset(($_GET['id']))) {
    $id = $_GET['id'];

    // Fetch student details for the specified ID
    $result = $conn->query("SELECT * FROM students WHERE id = $id");

        $row = $result->fetch_assoc();
        $name = $row['name'];
        $dob = $row['dob'];
        $grade = $row['grade'];
   
}


// Check for update success message
$update_success_message = isset($_SESSION['update_success']) ? $_SESSION['update_success'] : '';
unset($_SESSION['update_success']); // Clear the session variable
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Edit Student</title>
</head>
<body style="text-align:center">
    <h2>Edit Student</h2>

    <?php

if (isset(($_GET['id']))) {
    echo "<form action='update_student.php' method='POST'>
        <input type='hidden' name='id' value='$id'>
        
        <label for='name'>Name:</label>
        <input type='text' id='name' name='name' value='$name' required style='text-align: center;'>
        
        <label for='dob'>Date of Birth:</label>
        <input type='date' id='dob' name='dob' value='$dob' required style='text-align: center;'>
        
        <label for='grade'>Grade:</label>
        <input type='text' id='grade' name='grade' value='$grade' required  style='text-align: center;'>
        
        <button type='submit'>Update</button>
    </form>";
} else{
    // Display the form for fetching details if not submitted
if (!isset($_POST['fetch_submit'])) {
    echo "<form action='edit_student.php' method='POST'>
        <label for='id'>Student ID:</label>
        <input type='text' id='id' name='id' required style='text-align:center'>
        <button type='submit' name='fetch_submit'>Fetch Details</button>
    </form>";
} else {
    // Display error message if student not found
    if (isset($error_message)) {
        echo "<p class='error-message'>$error_message</p>";
    }

    // Display the form to edit details if details are found
    if (isset($name)) {
        echo "<form action='update_student.php' method='POST'>
            <input type='hidden' name='id' value='$id'>
            
            <label for='name'>Name:</label>
            <input type='text' id='name' name='name' value='$name' required style='text-align: center;'>
            
            <label for='dob'>Date of Birth:</label>
            <input type='date' id='dob' name='dob' value='$dob' required style='text-align: center;'>
            
            <label for='grade'>Grade:</label>
            <input type='text' id='grade' name='grade' value='$grade' required  style='text-align: center;'>
            
            <button type='submit'>Update</button>
        </form>";
    }
    
}
}
?>


    <div class="btn-container">
<a class="btn logout-btn" href="SLM.php"> go back to SLM Page</a>
</div>
</body>
</html>
