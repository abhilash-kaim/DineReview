<?php
session_start();
require "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    exit("Unauthorized");
}

$userId = $_SESSION['user_id'];
$name = trim($_POST['name']);
$email = trim($_POST['email']);

if (empty($name) || empty($email)) {
    $_SESSION['profile_msg'] = "All fields are required.";
    header("Location: ../profile.php");
    exit;
}

$stmt = $conn->prepare(
    "UPDATE users SET name = ?, email = ? WHERE id = ?"
);
$stmt->bind_param("ssi", $name, $email, $userId);
$stmt->execute();

$_SESSION['user_name'] = $name;
$_SESSION['profile_msg'] = "Your profile has been updated successfully.";

header("Location: ../profile.php");
exit;
