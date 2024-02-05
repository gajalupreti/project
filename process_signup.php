<?php
include('db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $grade = $_POST['grade'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert data into the students table
    $insert_students_query = "INSERT INTO students (name, dob, grade) VALUES ('$name', '$dob', '$grade')";
    $conn->query($insert_students_query);

    // Retrieve the id of the newly inserted student
    $user_id = $conn->insert_id;

    // Insert data into the login_details table
    $insert_login_details_query = "INSERT INTO login_details (user_id, username, password) VALUES ($user_id, '$username', '$password')";
    $conn->query($insert_login_details_query);

    echo "Signup successful!";
}
?>
