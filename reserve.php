<?php
session_start();
require "config/db.php";


/* Must be logged in */
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $restaurant = $_GET['restaurant'] ?? '';

    if (empty($restaurant)) {
        $_SESSION['error'] = "Invalid restaurant selection.";
        header("Location: restaurants.php");
        exit;
    }
}


$userId = $_SESSION['user_id'];


/* HANDLE FORM SUBMISSION */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $restaurant = trim($_POST['restaurant'] ?? '');
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';
    $guests = (int)($_POST['guests'] ?? 0);

    if ($restaurant === '' || $date === '' || $time === '' || $guests <= 0) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: reserve.php?restaurant=" . urlencode($restaurant));
        exit;
    }

    $stmt = $conn->prepare(
        "INSERT INTO reservations 
        (user_id, restaurant_name, reservation_date, reservation_time, guests)
        VALUES (?, ?, ?, ?, ?)"
    );

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("isssi", $userId, $restaurant, $date, $time, $guests);

    if ($stmt->execute()) {
        $reservationSuccess = true; // local flag
    } else {
        die("Execute failed: " . $stmt->error);
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reserve a Table | DineReview</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="Style/style.css">
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
<section class="page-brown-section compact-page">
    <div class="container mt-5 flex-grow-1">

        <h2>Reserve a Table</h2>

        <?php if (!isset($_SESSION['user_id'])): ?>

            <div class="alert alert-warning">
                Please <a href="login.html">log in</a> to make a reservation.
            </div>

        <?php else: ?>

            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): 
             $restaurant = trim($_POST['restaurant'] ?? '');

                if ($restaurant === '') {
                    die("Restaurant name missing");
                }
                ?>

                <div class="alert alert-success">
                    <h4>Reservation Confirmed ✅</h4>
                    <p><strong>Restaurant:</strong> <?= htmlspecialchars($_POST['restaurant']) ?></p>
                    <p><strong>Date:</strong> <?= $_POST['date'] ?></p>
                    <p><strong>Time:</strong> <?= $_POST['time'] ?></p>
                    <p><strong>Guests:</strong> <?= $_POST['guests'] ?></p>
                </div>

                <a href="restaurants.php" class="btn btn-dark mt-3">
                    Back to Restaurants
                </a>

            <?php else: ?>

                <form method="POST" class="mt-4" action="reserve.php">

                    <div class="mb-3">
                        <label class="form-label">Restaurant</label>
                        <input type="text"
                               class="form-control"
                               value="<?= htmlspecialchars($restaurant) ?>"
                               disabled>
                        <input type="hidden"
                             name="restaurant"
                             value="<?= htmlspecialchars($restaurant) ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Time</label>
                        <input type="time" name="time" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Number of Guests</label>
                        <input type="number" name="guests" class="form-control" min="1" required>
                    </div>

                    <button type="submit" class="btn btn-dark">
                        Confirm Reservation
                    </button>

                </form>

            <?php endif; ?>

        <?php endif; ?>

    </div>
</section>    

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
