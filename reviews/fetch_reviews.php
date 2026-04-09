<?php
require "../config/db.php";         // users DB

$sql = "SELECT * FROM reviews ORDER BY created_at DESC";
$result = $conn_reviews->query($sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $userId = $row['user_id'];

        // Fetch username from users database
        $userSql = "SELECT name FROM users WHERE id = $userId";
        $userResult = $conn->query($userSql);
        $user = $userResult->fetch_assoc();

        echo "<div class='mb-3'>";
        echo "<strong>{$row['restaurant_name']}</strong><br>";
        echo "Rating: {$row['rating']}<br>";
        echo "{$row['review_text']}<br>";
        echo "<small>By {$user['name']}</small>";
        echo "</div><hr>";
    }

} else {
    echo "<p>No reviews yet.</p>";
}
?>
