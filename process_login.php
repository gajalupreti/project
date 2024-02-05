<?php
session_start();

include('db_config.php'); // Include your database configuration file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate inputs (you might want to add more checks based on your requirements)
    if (empty($username) || empty($password)) {
        $_SESSION['login_error'] = "Please enter both Username and Password.";
        header("Location: user_login.php"); // Redirect back to the login page
        exit();
    }

    // Check if the user exists in the database
    $query = "SELECT user_id, password FROM login_details WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $stored_password = $row['password'];

        // Check if the password is valid
        if (password_verify($password, $stored_password)) {
            // Set a session variable to identify the logged-in student
            $_SESSION['student_id'] = $user_id;

            // Redirect to the student dashboard
            header("Location: student_dashboard.php");
            exit();
        } else {
            $_SESSION['login_error'] = "Invalid password. Please try again.";
            header("Location: user_login.php"); // Redirect back to the login page
            exit();
        }
    } 
    else {
        $_SESSION['login_error'] = "User not found. Please check your username and try again.";
        header("Location: user_login.php"); // Redirect back to the login page
        exit();
    }
}
 else {
    header("Location: user_login.php"); // Redirect back to the login page if the form is not submitted
    exit();
}
?>
