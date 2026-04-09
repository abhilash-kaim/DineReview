<?php
session_start();
require "../config/db.php";

/* 🚫 Block direct access */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../restaurants.php");
    exit;
}

/* Login protection */
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit;
}

/* Safely read POST data */
$userId     = $_SESSION['user_id'];
$restaurant = trim($_POST['restaurant'] ?? '');
$rating     = trim($_POST['rating'] ?? '');
$review     = trim($_POST['review'] ?? '');

/* Validation */
if ($restaurant === '' || $rating === '' || $review === '') {
    echo "All fields are required.";
    exit;
}

/* Insert review */
$sql = "
    INSERT INTO reviews (user_id, restaurant_name, rating, review_text)
    VALUES (?, ?, ?, ?)
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("isis", $userId, $restaurant, $rating, $review);

if ($stmt->execute()) {
    $_SESSION['review_success'] =
    "Thank you for sharing your experience about <strong>" .
    htmlspecialchars($restaurant) .
    "</strong> ⭐";

    header("Location: ../restaurants.php");
    exit;
} else {
    echo "Failed to submit review.";
}

$stmt->close();
$conn->close();
