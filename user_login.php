<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
</head>
<body style="text-align:center">
    <h2>Login</h2>

    <?php
    session_start();
    if (isset($_SESSION['login_error'])) {
        echo "<p class='error-message'>{$_SESSION['login_error']}</p>";
        unset($_SESSION['login_error']); // Clear the session variable
    }
    ?>

    <form action="process_login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required style="text-align:center">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required style="text-align:center">

        <button type="submit">Login</button>
    </form>
    <div class="btn-container" style=" display: flex; justify-content: center; ">
        <a class="btn logout-btn" href="library.html"> GO to Main Page</a>
    </div>
</body>
</html>
