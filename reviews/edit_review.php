<?php
session_start();
require "../config/db.php";

if (!isset($_SESSION['user_id'], $_GET['id'])) {
    exit("Unauthorized access");
}

$userId = $_SESSION['user_id'];
$reviewId = (int) $_GET['id'];

$stmt = $conn->prepare(
    "SELECT rating, review_text FROM reviews
     WHERE id = ? AND user_id = ?"
);
$stmt->bind_param("ii", $reviewId, $userId);
$stmt->execute();
$review = $stmt->get_result()->fetch_assoc();

if (!$review) {
    exit("Review not found");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Review</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h3>Edit Review</h3>

    <form action="update_review.php" method="POST">
        <input type="hidden" name="id" value="<?= $reviewId ?>">

        <div class="mb-3">
            <label class="form-label">Rating (1–5)</label>
            <input type="number" name="rating"
                   class="form-control"
                   min="1" max="5"
                   value="<?= $review['rating'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Review</label>
            <textarea name="review"
                      class="form-control"
                      rows="4"
                      required><?= htmlspecialchars($review['review_text']) ?></textarea>
        </div>

        <button class="btn btn-dark">Update Review</button>
        <a href="../profile.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

</body>
</html>
