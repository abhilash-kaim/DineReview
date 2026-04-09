<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit;
}

$restaurant = $_GET['restaurant'] ?? '';
if (!$restaurant) {
    echo "Restaurant not specified.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Review</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h3>Review: <?= htmlspecialchars($restaurant) ?></h3>

            <form action="add_review.php" method="POST">

            <!-- REQUIRED -->
            <input type="hidden" name="restaurant"
                value="<?= htmlspecialchars($_GET['restaurant']) ?>">

            <div class="mb-3">
                <label>Rating</label>
                <select name="rating" class="form-control" required>
                    <option value="">Select rating</option>
                    <option value="5">★★★★★</option>
                    <option value="4">★★★★</option>
                    <option value="3">★★★</option>
                    <option value="2">★★</option>
                    <option value="1">★</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Your Review</label>
                <textarea name="review"
                        class="form-control"
                        rows="4"
                        required></textarea>
            </div>

            <button type="submit" class="btn btn-dark">
                Submit Review
            </button>

        </form>

</div>

</body>
</html>
