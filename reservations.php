<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require "config/db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Reservations | DineReview</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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

        /* Spacing between navbar items */
        .navbar-nav .nav-item{
            margin-right:1.5rem;
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

<div class="page-brown-section compact-page flex-grow-1">

<?php if (!isset($_SESSION['user_id'])): ?>

    <!-- NOT LOGGED IN -->
    <div class="alert alert-warning text-center">
        <h5>Please log in to view your reservations</h5>
        <a href="login.html" class="btn btn-dark mt-2">Log In</a>
    </div>

<?php else: ?>

    <h2 class="mb-4">My Reservations</h2>

    <?php
    $userId = $_SESSION['user_id'];

    $stmt = $conn->prepare(
        "SELECT id, restaurant_name, reservation_date, reservation_time
         FROM reservations
         WHERE user_id = ?
         ORDER BY reservation_date DESC"
    );
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    

    $reservations = $stmt->get_result();
    ?>

    <?php if ($reservations->num_rows === 0): ?>

        <p class="text-muted">You have no reservations yet.</p>
        <a href="restaurants.php" class="btn btn-dark">
            Browse Restaurants
        </a>

    <?php else: ?>

        <?php while ($r = $reservations->fetch_assoc()): ?>
            <div class="card mb-3 shadow-sm">
                <div class="card-body">

                    <h5><?= htmlspecialchars($r['restaurant_name']) ?></h5>

                    <p class="mb-1">
                        📅 <?= htmlspecialchars($r['reservation_date']) ?>
                        ⏰ <?= htmlspecialchars($r['reservation_time']) ?>
                    </p>

                    <div class="mt-2">
                        <a href="reservation/edit_reservation.php?id=<?= (int)$r['id'] ?>"
                           class="btn btn-sm btn-outline-dark me-2">
                            Edit
                        </a>

                        <a href="reservation/delete_reservation.php?id=<?= (int)$r['id'] ?>"
                           class="btn btn-sm btn-outline-danger"
                           onclick="return confirm('Cancel this reservation?');">
                            Cancel
                        </a>
                    </div>

                </div>
            </div>
        <?php endwhile; ?>

    <?php endif; ?>

    <?php $stmt->close(); ?>

<?php endif; ?>
<?php if (isset($_SESSION['reservation_success'])): ?>
    <div class="alert alert-success text-center">
        <?= htmlspecialchars($_SESSION['reservation_success']) ?>
    </div>
    <?php unset($_SESSION['reservation_success']); ?>
<?php endif; ?>

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
                        <li class="list-inline-item"><a href="positions.php" class="footer-link-minimal">Careers</a></li>
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
