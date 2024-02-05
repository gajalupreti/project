<?php
session_start();

include('db_config.php');

// Check if the user is logged in
if (!isset($_SESSION['student_id'])) {
    header("Location: user_login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

// Retrieve student details
$query = "SELECT name FROM students WHERE id = '$student_id'";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$name = $row['name'];

// If the form for adding books is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && $_GET['action'] == 'add_books') {
    $bookTitle = isset($_GET['book_title']) ? $_GET['book_title'] : '';
    $author = isset($_GET['author']) ? $_GET['author'] : '';

    // Generate the table name based on the student's name
    $tableName = strtolower(str_replace(' ', '_', $name) . '_books');

    // Check if the table exists, if not, create it
    $checkTableQuery = "CREATE TABLE IF NOT EXISTS $tableName (
        id INT AUTO_INCREMENT PRIMARY KEY,
        book_title VARCHAR(255) NOT NULL,
        author VARCHAR(255) NOT NULL
    )";
    $conn->query($checkTableQuery);

    // Insert the book into the student's table
    $insertQuery = "INSERT INTO $tableName (book_title, author) VALUES ('$bookTitle', '$author')";
    $conn->query($insertQuery);
}

// If the user wants to view books
if (isset($_GET['action']) && $_GET['action'] == 'view_books') {
    // Generate the table name based on the student's name
    $tableName = strtolower(str_replace(' ', '_', $name) . '_books');

    // Retrieve books from the student's table
    $retrieveQuery = "SELECT book_title, author FROM $tableName";
    $result = $conn->query($retrieveQuery);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Student Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        h2, h3 {
            color: #333;
        }

        .btn-container {
            margin-top: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 0 10px;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border-radius: 5px;
        }

        .btn.logout-btn {
            background-color: #dc3545;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body style="text-align:center">
    <h2>Welcome <?php echo $name; ?> to your dashboard...</h2>

    <div class="btn-container">
        <a class="btn" href="student_dashboard.php?action=add_books">Add Books</a>
        <a class="btn logout-btn" href="user_login.php">Logout</a>
        <a class="btn" href="student_dashboard.php?action=view_books">View Books</a>
        
        <br> <br> <br>
    </div>

    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'add_books') {
        ?>
        <h3>Add Books</h3>
        <form action="student_dashboard.php" method="GET">
            <label for="book_title">Book Title:</label>
            <input type="text" id="book_title" name="book_title" required>

            <label for="author">Author:</label>
            <input type="text" id="author" name="author" required>

            <button type="submit" name="action" value="add_books">Add Book</button>
        </form>
        <?php
    }

    if (isset($_GET['action']) && $_GET['action'] == 'view_books') {
        ?>
        <h3>Your Book List</h3>
        <table>
            <tr>
                <th>Book Title</th>
                <th>Author</th>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['book_title'] . "</td>";
                echo "<td>" . $row['author'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <?php
    }
    ?>
</body>
</html>
