<?php
require "../config/db.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php");
    exit;
}

$email = trim($_POST['signup'] ?? '');

/* Validate email */
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../index.php?newsletter=invalid");
    exit;
}

/* Check if email already exists */
$checkStmt = $conn->prepare(
    "SELECT id FROM newsletter_subscribers WHERE email = ?"
);
$checkStmt->bind_param("s", $email);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows > 0) {
    // Email already subscribed
    $checkStmt->close();
    header("Location: ../index.php?newsletter=exists");
    exit;
}

$checkStmt->close();

/* Insert new subscriber */
$insertStmt = $conn->prepare(
    "INSERT INTO newsletter_subscribers (email) VALUES (?)"
);
$insertStmt->bind_param("s", $email);
$insertStmt->execute();
$insertStmt->close();

header("Location: ../index.php?newsletter=success");
exit;
?>