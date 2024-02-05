<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
   
    $correctUsername = 'admin';
    $correctPassword = 'password123';
    if ($username === $correctUsername && $password === $correctPassword) {
        // Set session variables to mark user as logged in
        $_SESSION['admin_logged_in'] = true;
        header("Location: SLM.php");
        exit();
    } else {
        $error_message = "Invalid credentials. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Admin Login</title>
</head>
<body style="background-color: #e5e5e5 ">
    <div class="login-container" style="background-color: #0000;">
        <h2 style=" font-family: Copperplate, Papyrus, fantasy; text-decoration: underline;" >Admin Login</h2>
        <?php
        if (isset($error_message)) {
            echo "<p class='error-message'>$error_message</p>";
        }
        ?>
        <form action="admin_login.php" method="POST">
            <label for="username" style="font-family: Copperplate, Papyrus, fantasy; text-decoration: underline;">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password" style="font-family: Copperplate, Papyrus, fantasy; text-decoration: underline;">Password:</label>
            <div class="password-container">
                <input type="password" id="password" name="password" required>
                <button type="button" id="togglePassword">Show</button>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>

    <div class="btn-container" style=" display: flex; justify-content: center; ">
        <a class="btn logout-btn" href="library.html"> GO to Main Page</a>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const togglePasswordButton = document.getElementById('togglePassword');

        togglePasswordButton.addEventListener('click', function () {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                togglePasswordButton.textContent = 'Hide';
            } else {
                passwordInput.type = 'password';
                togglePasswordButton.textContent = 'Show';
            }
        });
    </script>
</body>
</html>
