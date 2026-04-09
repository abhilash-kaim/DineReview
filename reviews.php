<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require "config/db.php";

/* Fetch all reviews with user names */
$sql = "
    SELECT 
        r.restaurant_name,
        r.rating,
        r.review_text,
        r.created_at,
        u.name AS user_name
    FROM reviews r
    JOIN users u ON r.user_id = u.id
    ORDER BY r.created_at DESC
";

$result = $conn->query($sql);

$reviewsByRestaurant = [];

while ($row = $result->fetch_assoc()) {
    $restaurant = $row['restaurant_name'];
    $reviewsByRestaurant[$restaurant][] = $row;
}


/* Star helper */
function renderStars($rating) {
    $stars = '';
    for ($i = 1; $i <= 5; $i++) {
        $stars .= $i <= $rating
            ? '<i class="bi bi-star-fill text-warning"></i>'
            : '<i class="bi bi-star text-warning"></i>';
    }
    return $stars;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>All Reviews | DineReview</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
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

        /* Custom styling for the 'More' dropdown menu background and border */

        .dropdown-men-dark-custom{
            background-color: #3f3f3f;
            border:1px solid #5a5a5a;
        }

        /* Custom styling for the dropdown menu items */
        .dropdown-men-dark-custom .dropdown-item{
            color: #ffffff;
        }

        /* Custom styling for the dropdown menu items */
        .dropdown-men-dark-custom .dropdown-item:hover{
            background-color: #5a5a5a;
        }
        /* Logo sizing within the navbar */
        .navbar-logo{
            max-height: 40px;
            height: auto;
            width: 150px;
        }

        /* Spacing between navbar items */
        .navbar-nav .nav-item{
            margin-right:1.5rem;
        }
     </style>
</head>
<body>

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
                <a class="nav-link text-white" href="reviews.php">
                    Reviews
                </a>    
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

<div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Community Reviews</h2>
            <a href="restaurants.php" class="btn btn-dark">
                View Restaurants
            </a>
        </div>

        <?php if (empty($reviewsByRestaurant)): ?>
        <p class="text-muted">No reviews yet.</p>
    <?php else: ?>

        <?php foreach ($reviewsByRestaurant as $restaurant => $reviews): ?>

            <div class="card mb-4 shadow-sm">
                <div class="card-body">

                    <h4 class="mb-3">
                        <?= htmlspecialchars($restaurant) ?>
                    </h4>

                    <?php foreach ($reviews as $review): ?>
                        <div class="mb-3 pb-3 border-bottom">

                            <div class="mb-1">
                                <?= renderStars($review['rating']) ?>
                            </div>

                            <p class="mb-1">
                                <?= htmlspecialchars($review['review_text']) ?>
                            </p>    

                            <small class="text-muted">
                                — <?= htmlspecialchars($review['user_name']) ?> |
                                <?= date("d M Y", strtotime($review['created_at'])) ?>
                            </small>

                        </div>
                    <?php endforeach; ?>

                    <a href="restaurants.php" class="btn btn-sm btn-outline-dark mt-2">
                        Reserve / Write Review
                    </a>

                </div>
            </div>

        <?php endforeach; ?>

    <?php endif; ?>
</div>
<footer class="footer-section">
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


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
