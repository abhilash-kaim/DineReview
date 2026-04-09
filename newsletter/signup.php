<?php
session_start();
require "../config/db.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php");
    exit;
}

$email = trim($_POST['signup'] ?? '');

/* Basic validation */
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['newsletter_msg'] = "❌ Please enter a valid email address.";
    header("Location: ../index.php");
    exit;
}

/* Success message */
$_SESSION['newsletter_msg'] = "✅ Thank you for signing up! You'll hear from us soon.";

header("Location: ../index.php");
exit;
?>
