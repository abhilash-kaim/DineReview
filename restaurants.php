<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require "config/db.php";

/* Build ratings array */
$ratings = [];

// Fetch average rating and total reviews for each restaurant

$sql = "
    SELECT restaurant_name,
           ROUND(AVG(rating), 1) AS avg_rating,
           COUNT(*) AS total_reviews
    FROM reviews
    GROUP BY restaurant_name
";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $ratings[$row['restaurant_name']] = $row;
}


?>


<?php
function renderStars($rating) {
    $full = floor($rating);
    $half = ($rating - $full >= 0.5);
    $empty = 5 - $full - ($half ? 1 : 0);

    $stars = '';
    for ($i = 0; $i < $full; $i++) {
        $stars .= '<i class="bi bi-star-fill text-warning"></i>';
    }
    if ($half) {
        $stars .= '<i class="bi bi-star-half text-warning"></i>';
    }
    for ($i = 0; $i < $empty; $i++) {
        $stars .= '<i class="bi bi-star text-warning"></i>';
    }
    return $stars;
}
?>

<?php
$restaurants = [
    "The Woollen Mills",
    "Chapter One",
    "Bunsen"
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Restaurants | DineReview</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap + Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="Style/style.css">
    <style>
        /* Styling for login */
        .btn-login-custom{
            background-color: #3f3f3f;
            color: #ffffff;
            border: 2px solid #5a5a5a;
            border-radius: 10px;
            padding:8px 20px;
        }

        /* Styling for signup button */
        .btn-reserve-custom{
            background-color: #ff5733;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            padding:8px 20px;
        }

        /* Defines the active (clicked) state for the reserve button, creating a 'press' effect */
        .btn-reserve-custom:active{
            box-shadow: 0 2px #c33a1e;
            transform: translateY(3px);
        }

        /* Logo sizing within the navbar */
        .navbar-logo{
            max-height: 40px;
            height: auto;
            width: 150px;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: #2c2c2c;">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="assets/DineReview_Logo.png" alt="Logo" class="navbar-logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item me-4">
              <a class="nav-link text-white" href="reviews.php">Reviews</a>
            </li>
            <li class="nav-item me-4">
              <a class="nav-link text-white" href="restaurants.php">Restaurants</a>
            </li>
            <li class="nav-item me-4">
              <a class="nav-link text-white" href="reservations.php">Reservations</a>
            </li>
          </ul>
            <div class="d-flex align-items-center">
                        <?php if (isset($_SESSION['user_name'])): ?>
                            <a href="profile.php" class="text-white me-3 text-decoration-none fw-semibold">
                                Hello, <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                            </a>
                            <a href="auth/logout.php"
                                class="btn btn-sm btn-outline-light"
                                onclick="return confirm('Are you sure you want to log out?');">
                                Logout
                            </a>
                        <?php else: ?>

                    <button class="btn-login-custom me-2" onclick="window.location.href='login.html'" type="button">
                        Login
                    </button>
                    <button class="btn-reserve-custom" onclick="window.location.href='signup.html'" type="button">
                        Sign Up
                    </button>
                <?php endif; ?>
            </div>

        </div>
        </div>
    </nav>
        

        <?php if (isset($_SESSION['review_success'])): ?>
            <div class="container mt-4">
                <div class="alert alert-success text-center">
                    <?= $_SESSION['review_success'] ?>
                </div>
            </div>
            <?php unset($_SESSION['review_success']); ?>
        <?php endif; ?>

        
    <div class="container mt-5">

    <h2>Restaurants in Dublin</h2>
    <p class="mb-4">
        Click on a restaurant to explore details, reserve a table, or share your experience.
    </p>

    
    <div class="accordion" id="restaurantAccordion">
        

        <?php foreach ($restaurants as $index => $restaurant): 
            $ratingData = $ratings[$restaurant] ?? null;
        ?>

            <!-- Rating -->
            <div class="mb-2">
                <?php if ($ratingData): ?>
                    <?= renderStars($ratingData['avg_rating']) ?>
                    <small class="text-muted">
                        <?= $ratingData['avg_rating'] ?>/5
                        (<?= $ratingData['total_reviews'] ?> reviews)
                    </small>
                <?php else: ?>
                    <span class="text-muted">No reviews yet</span>
                <?php endif; ?>
            </div>

            <!-- Accordion -->
            <div class="accordion-item mb-3">
                <h2 class="accordion-header">
                    <button class="accordion-button <?= $index > 0 ? 'collapsed' : '' ?>"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#restaurant<?= $index ?>">
                        <?= htmlspecialchars($restaurant) ?>
                    </button>

                </h2>

                <div id="restaurant<?= $index ?>"
                    class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>"
                    data-bs-parent="#restaurantAccordion">

                    <div class="accordion-body">

                        <p>Discover dining at <strong><?= htmlspecialchars($restaurant) ?></strong>.</p>

                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a href="reserve.php?restaurant=<?= urlencode($restaurant) ?>"
                            class="btn btn-dark me-2">
                                Reserve a Table
                            </a>

                            <a href="reviews/add_review_form.php?restaurant=<?= urlencode($restaurant) ?>"
                            class="btn btn-outline-dark">
                                Share your experience
                            </a>
                        <?php else: ?>
                            <div class="alert alert-warning mt-3">
                                Please <a href="login.html">log in</a> to reserve or review.
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

        <?php endforeach; ?>

        </div>
    

    </div>

    


</div>

<footer class="footer-section mt-auto">
        <div class="container">
            
            <div class="row align-items-center">
                
                <div class="col-4 text-start"> 
                    <a class="footer-logo" href="index.php">
                        <img src="assets/DineReview_Logo.png" alt="DineReview Logo" class="footer-logo">
                    </a>
                </div>

                <div class="col-4 text-center">
                    <ul class="list-inline footer-links-minimal m-0 d-flex justify-content-center"> 
                        <li class="list-inline-item"><a href="about.php" class="footer-link-minimal">About Us</a></li>
                        <li class="list-inline-item"><a href="#" class="footer-link-minimal">Careers</a></li>
                        <li class="list-inline-item"><a href="contact.php" class="footer-link-minimal">Contact Us</a></li>
                    </ul>
                </div>
                
                <div class="col-12 col-md-4 text-end"> 
                    <div class="social-links-footer">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

            </div>
            
            <hr class="footer-divider my-3">
            
            <div class="row">
                <div class="col-12 text-center">
                    <p class="footer-copyright m-0">&copy; 2025 DineReview. All rights reserved.</p>
                </div>
            </div>

        </div>
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    </body>
        
</html>
