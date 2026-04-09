<?php
session_start();

// Include database connection
require "../config/db.php";

// Check if form was submitted using POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get form values using POST
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Basic validation (from notes: if / else)
    if (empty($email) || empty($password)) {
        echo "Please fill in all fields.";
        exit;
    }

    // Prepare SQL to prevent SQL injection
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password using plain text comparison
        if ($password === $user['password']) {

            // Store data in SESSION (server-side)
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            // Store email in COOKIE (client-side)
            setcookie("user_email", $email, time() + 3600, "/");

            // Redirect to dashboard
            header("Location: ../index.php");
            exit;
        } else {
            echo "Incorrect password. Please try again.";
        }

    } else {
        echo"<script>
        alert('No account found with this email');
        window.history.back();
        </script>";
        exit;
    }

} else {
    echo "Invalid request.";
}
?>
