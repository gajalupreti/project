<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>View Students</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align: center;
        }

        h1 {
            background-color: #007BFF;
            color: #fff;
            padding: 20px;
            margin: 0;
            cursor: pointer;
        }

        .table-container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: #fff;
        }

        td.actions {
            display: flex;
            justify-content: space-around;
        }

        .edit-link,
        .delete-link {
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #007BFF;
            color: #007BFF;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .edit-link:hover,
        .delete-link:hover {
            background-color: #007BFF;
            color: #fff;
        }
  
    </style>
</head>
<body>
    <h1 onclick="location.href='SLM.php'">Student Library Management</h1>
    <div class="table-container">
        <h2>View Students</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Grade</th>
                    <th>Username</th> <!-- New column header -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                session_start();

                // Check if the user is not logged in as admin
                if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
                    header("Location: admin_login.php"); // Redirect to the login page if not logged in
                    exit();
                }

                include('db_config.php');

                // Fetch all students from the database along with username
                $result = $conn->query("SELECT students.id, students.name, students.dob, students.grade, login_details.username FROM students JOIN login_details ON students.id = login_details.user_id;");

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['dob']}</td>
                        <td>{$row['grade']}</td>
                        <td>{$row['username']}</td> <!-- New column data -->
                        <td class='actions'>
                            <a href='edit_student.php?id={$row['id']}' class='edit-link'>Edit</a>
                            <a href='delete_student.php?id={$row['id']}' class='delete-link'>Delete</a>
                        </td>
                    </tr>";
                }

                $conn->close();
            ?>
            </tbody>
        </table>
    </div>
    <div class="btn-container">

        <a class="btn return-btn" onclick="goBack()">Return to Previous Page</a>
        <a class="btn logout-btn" href="SLM.php"> go back to SLM Page</a>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
