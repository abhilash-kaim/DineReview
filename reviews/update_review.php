<?php
session_start();
require "../config/db_reviews.php";

if (!isset($_SESSION['user_id'], $_POST['id'])) {
    exit("Unauthorized access");
}

$userId = $_SESSION['user_id'];
$reviewId = (int) $_POST['id'];
$rating = trim($_POST['rating']);
$reviewText = trim($_POST['review']);

if (empty($rating) || empty($reviewText)) {
    exit("All fields are required");
}

$stmt = $conn_reviews->prepare(
    "UPDATE reviews
     SET rating = ?, review_text = ?
     WHERE id = ? AND user_id = ?"
);
$stmt->bind_param("isii", $rating, $reviewText, $reviewId, $userId);
$stmt->execute();

/* Success message */
$_SESSION['profile_msg'] = "Your review has been updated.";

header("Location: ../profile.php");
exit;
