<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="SLM.css">
    <title>Student Library Management</title>
    <script>/*typing text*/
        document.addEventListener('DOMContentLoaded', function () {
            var welcomeTextElement = document.getElementById('welcome-text');
            var welcomeText = '!!!... Welcome admin to your administration ...!!!';
            var index = 0;
            function type() {
                var currentText = welcomeText.slice(0, index + 1);
                // Display the current substring in the element
                welcomeTextElement.innerHTML = currentText;
                // Increment the index
                index++;
                // Check if there are more characters to display
                if (index < welcomeText.length) {
                    // Call the function again after a delay (adjust the delay as needed)
                    setTimeout(type, 50);
                }
            }
            // Start the typing animation
            type();
        });
    </script>
    
</head>
<body>
    <h1 onclick="location.href='SLM.php'">Student Library Management</h1>

    <div class="Welcome typing-effect" id="welcome-text" style="margin: 20px; font-family: Copperplate, Papyrus, fantasy; text-decoration: underline;">
     &lt&lt&lt!!!... Welcome admin to your administration...!!!&gt&gt&gt></div>

    <div class="container" style="margin: 20px 20px -20px;">
        <div class="box" onclick="location.href='add_student.php'" style="background-color: #feff00;">
            <a href="add_student.php">Add Student</a>
        </div>
        <div class="box" onclick="location.href='view_students.php'" style="background-color: #ff00f2">
            <a href="view_students.php">View Students</a>
        </div>
    </div>

    <div class="btn-container">
        <a class="btn logout-btn" href="admin_login.php">Log out</a>
    </div>
    
    <div class="container" style="margin: -5px 20px 20px;">
        <div class="box" onclick="location.href='edit_student.php'" style="background-color: #00faff">
            <a href="edit_student.php">Edit Students</a>
        </div>
        <div class="box" onclick="location.href='delete_student.php'" style="background-color: #45ff00">
            <a href="delete_student.php">Delete Students</a>
        </div>
    </div>
    
</body>
</html>
