<?php
session_start();
require "../config/db.php";

// Only allow POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Basic validation
    if (empty($name) || empty($email) || empty($password)) {
        echo "All fields are required.";
        exit;
    }

    // Check if email already exists
    $checkSql = "SELECT id FROM users WHERE email = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        echo "Email already registered. Please login.";
        exit;
    }

    // Store password as plain text
    // Insert user with plain text password
    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {

        // AUTO LOGIN AFTER SIGNUP
        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['user_name'] = $name;

        // Store cookie
        setcookie("user_email", $email, time() + 3600, "/");

        // Redirect to index page
        header("Location: ../index.php");
        exit;

    } else {
        echo "Registration failed. Please try again.";
    }
}
?>