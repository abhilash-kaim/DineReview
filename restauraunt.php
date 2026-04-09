<?php
session_start();

// Static restaurant data (safe & reliable)
$restaurants = [
    1 => [
        "name" => "The Woollen Mills",
        "description" => "A popular Dublin restaurant serving classic Irish dishes with a modern café atmosphere.",
        "famous_for" => "Irish Breakfast, Seafood Chowder, Fresh Bread"
    ],
    2 => [
        "name" => "Chapter One",
        "description" => "Award-winning fine dining restaurant offering contemporary Irish cuisine.",
        "famous_for" => "Tasting Menus, Fine Wines"
    ],
    3 => [
        "name" => "Bunsen",
        "description" => "A relaxed burger restaurant loved by locals and tourists alike.",
        "famous_for" => "Classic Beef Burgers, Fries"
    ]
];

$id = $_GET['id'] ?? null;

if (!$id || !isset($restaurants[$id])) {
    echo "Restaurant not found.";
    exit;
}

$restaurant = $restaurants[$id];
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $restaurant['name']; ?> | DineReview</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">

    <h2><?php echo $restaurant['name']; ?></h2>

    <p class="mt-3">
        <?php echo $restaurant['description']; ?>
    </p>

    <p>
        <strong>Famous for:</strong> <?php echo $restaurant['famous_for']; ?>
    </p>

    <hr>

    <?php if (isset($_SESSION['user_id'])): ?>

        <h5 class="mb-3">What would you like to do?</h5>

        <a href="reserve.php?restaurant=<?php echo urlencode($restaurant['name']); ?>"
           class="btn btn-dark me-2">
            Reserve a Table
        </a>

        <a href="reviews.php?restaurant=<?php echo urlencode($restaurant['name']); ?>#post-review"
           class="btn btn-outline-dark">
            Share your experience
        </a>

    <?php else: ?>

        <div class="alert alert-warning mt-4">
            Please <a href="login.html">log in</a> to reserve a table or share your experience.
        </div>

    <?php endif; ?>

    <div class="mt-4">
        <a href="restaurants.php">← Back to Restaurants</a>
    </div>

</div>

</body>
</html>
