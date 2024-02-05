<?php
session_start();

// Check if the user is not logged in as admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php"); // Redirect to the login page if not logged in
    exit();
}

include('db_config.php');

// Initialize variables
$success_message = $error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $result = $conn->query("SELECT * FROM students WHERE id = $id");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];

        // Check if the login_details table exists, and delete if it does
        $conn->query("DELETE FROM login_details WHERE user_id = $id;");

        $tableName = strtolower(str_replace(' ', '_', $name) . '_books');
        $conn->query("DROP TABLE IF EXISTS $tableName;");

        $sql = "DELETE FROM students WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            $success_message = "Student deleted successfully.";
        } else {
            $error_message = "Error deleting student: " . $conn->error;
        }
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
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align: center;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php
    if (!empty($success_message)) {
        echo "<p class='success-message'>$success_message</p>";
    }
    ?>

    <?php
    if (!empty($error_message)) {
        echo "<p class='error-message'>$error_message</p>";
    }
    ?>
    
    <script>
        setTimeout(function() {
            window.location.href = 'view_students.php';
        }, 2000);
    </script>
</body>
</html>
