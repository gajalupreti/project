<?php
session_start();

include('db_config.php');
/*use this if you want to continuously edit the data: header("Location: edit_student.php?id=$id");
exit();*/
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $grade = $_POST['grade'];

    // Perform the update operation here (replace with your actual update query)
    $update_query = "UPDATE students SET name='$name', dob='$dob', grade='$grade' WHERE id=$id";
    $result = $conn->query($update_query);

    if ($result) {
        // Update successful, set success message
        $_SESSION['update_success'] = "Student updated successfully.";
        echo " <script>
        setTimeout(function() {
            window.location.href = 'view_students.php';
        }, 2000);
    </script>";
        
    } else {
        // Update failed, set error message
        $_SESSION['update_error'] = "Error updating student.";
    }
}

// Display success or error message and end script
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Update Student</title>
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
    // Display update success message
    if (!empty($_SESSION['update_success'])) {
        echo "<p class='success-message'>{$_SESSION['update_success']}</p>";
        unset($_SESSION['update_success']); // Clear the session variable
        
    }

    // Display update error message
    if (!empty($_SESSION['update_error'])) {
        echo "<p class='error-message'>{$_SESSION['update_error']}</p>";
        unset($_SESSION['update_error']); // Clear the session variable
    }
    ?>
        <div class="btn-container">
<a class="btn logout-btn" href="SLM.php"> go back to SLM Page</a>
</div>
</body>
</html>
