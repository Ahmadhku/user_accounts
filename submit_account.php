<?php
// Include the database connection file
include 'db_connection.php';

// Check if the form is submitted
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $firstName = $conn->real_escape_string($_POST['firstName']);
    $lastName = $conn->real_escape_string($_POST['lastName']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirmPassword = $conn->real_escape_string($_POST['confirmPassword']);
    $dob = $conn->real_escape_string($_POST['dob']);

    // Validate that the password and confirm password match
    if ($password !== $confirmPassword) {
        die('Passwords do not match.');
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL Query to insert user data into the database
    $sql = "INSERT INTO users (first_name, last_name, email, password, date_of_birth) VALUES (?, ?, ?, ?, ?)";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $firstName, $lastName, $email, $hashedPassword, $dob);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New account created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
