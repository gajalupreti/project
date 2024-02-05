<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"> 
    <title>Student Signup</title>
</head>
<body>
    <h2 style="text-align:center">Student Signup</h2>
    <form action="process_signup.php" method="POST" style="text-align:center">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required style="text-align:center">

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required style="text-align:center">

        <label for="grade">Grade:</label>
        <input type="text" id="grade" name="grade" required style="text-align:center">

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required style="text-align:center">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required style="text-align:center">

        <button type="submit">Signup</button>
    </form>
    <div class="btn-container" style=" display: flex; justify-content: center; ">
        <a class="btn logout-btn" href="library.html"> GO to Main Page</a>
    </div>
</body>
</html>
