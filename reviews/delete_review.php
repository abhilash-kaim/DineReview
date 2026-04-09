<?php
session_start();
require "../config/db.php";

if (!isset($_SESSION['user_id'], $_GET['id'])) {
    exit("Unauthorized access");
}

$userId = $_SESSION['user_id'];
$reviewId = (int) $_GET['id'];

$stmt = $conn->prepare(
    "DELETE FROM reviews WHERE id = ? AND user_id = ?"
);
$stmt->bind_param("ii", $reviewId, $userId);
$stmt->execute();

/* Success message */
$_SESSION['profile_msg'] = "Review deleted successfully.";

header("Location: ../profile.php");
exit;
?>