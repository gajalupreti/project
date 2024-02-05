<?php
session_start();

// Check if the user is not logged in as admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php"); // Redirect to the login page if not logged in
    exit();
}

include('db_config.php');

// Initialize variables to store messages
$success_message = $error_message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $grade = $_POST['grade'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


    // Insert new student into the students table
    $sql_students = "INSERT INTO students (name, dob, grade) VALUES ('$name', '$dob', '$grade')";

    if ($conn->query($sql_students) === TRUE) {
        // Student added successfully, now add an entry in the login_details table
        $student_id = $conn->insert_id;  // Get the ID of the newly added student

        // Insert the login details into the login_details table
        $sql_login = "INSERT INTO login_details (user_id, username, password) VALUES ('$student_id', '$username', '$password')";

        if ($conn->query($sql_login) === TRUE) {
            $success_message = "Student added successfully.";
        } else {
            $error_message = "Error adding login details: " . $conn->error;
        }
    } else {
        $error_message = "Error adding student: " . $conn->error;
    }
}
?>

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
    
  <?php if (!empty($success_message)) : ?>
        <script>
            setTimeout(function() {
                window.location.href = 'view_students.php';
            }, 2000);
        </script>
    <?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Add Student</title>
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
<body style='text-align: center;'>
    <h2>Add Student</h2>

  

    <form action="add_student.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required style='text-align: center;'>
        
        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required style='text-align: center;'>
        
        <label for="grade">Grade:</label>
        <input type="text" id="grade" name="grade" required style='text-align: center;'>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required style='text-align: center;'>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required style='text-align: center;'>
        
        <button type="submit">Add Student</button>
    </form>
</body>
</html>
