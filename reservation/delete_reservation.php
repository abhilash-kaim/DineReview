<?php
session_start();
require "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit;
}

$id = $_GET['id'] ?? null;
$userId = $_SESSION['user_id'];

$stmt = $conn->prepare(
    "DELETE FROM reservations WHERE id = ? AND user_id = ?"
);
$stmt->bind_param("ii", $id, $userId);
$stmt->execute();

$_SESSION['reservation_success'] = "Reservation cancelled successfully ✓";
header("Location: ../reservations.php");
exit;
