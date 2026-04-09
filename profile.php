<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require "config/db.php";          // ✅ users DB


if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}
?>

<?php
$userId = $_SESSION['user_id'];

/* Fetch user info */
$stmtUser = $conn->prepare(
    "SELECT name, email FROM users WHERE id = ?"
);
$stmtUser->bind_param("i", $userId);
$stmtUser->execute();
$user = $stmtUser->get_result()->fetch_assoc();

/* Fetch user reviews */
$stmtReviews = $conn->prepare(
    "SELECT id, restaurant_name, rating, review_text
     FROM reviews
     WHERE user_id = ?
     ORDER BY created_at DESC"
);
$stmtReviews->bind_param("i", $userId);
$stmtReviews->execute();
$reviews = $stmtReviews->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Profile | DineReview</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap + Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Same CSS as index.php -->
    <link rel="stylesheet" href="Style/style.css">
</head>

<body>

<!-- NAVBAR (copied from index.php) -->
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

<?php if (isset($_SESSION['profile_msg'])): ?>
            <div class="alert alert-success text-center m-3">
                <?= htmlspecialchars($_SESSION['profile_msg']) ?>
            </div>
            <?php unset($_SESSION['profile_msg']); ?>
<?php endif; ?>
<!-- MAIN CONTENT -->
<section class="features-section">
    <div class="container">

        <header class="text-center mb-5">
            <h2 class="display-5 fw-bold">My Profile</h2>
            <p class="lead">Manage your details and reviews</p>
        </header>

        <!-- USER DETAILS -->
        <div class="card mb-5 shadow-sm">
            <div class="card-body">
                <h4 class="mb-3">Account Details</h4>

                <form action="user/update_profile.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name"
                               class="form-control"
                               value="<?= htmlspecialchars($user['name']) ?>"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email"
                               class="form-control"
                               value="<?= htmlspecialchars($user['email']) ?>"
                               required>
                    </div>

                    <button class="btn btn-dark">
                        Update Profile
                    </button>
                </form>
            </div>
        </div>

        <!-- USER REVIEWS -->
        <h3 class="mb-4">My Reviews</h3>

        <?php while ($r = $reviews->fetch_assoc()): ?>
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5><?= htmlspecialchars($r['restaurant_name']) ?></h5>
                    <p><?= htmlspecialchars($r['review_text']) ?></p>
                    <p>Rating: <?= $r['rating'] ?>/5</p>

                    <!-- EDIT -->
                    <a href="reviews/edit_review.php?id=<?= $r['id'] ?>"
                    class="btn btn-sm btn-outline-dark me-2">
                    Edit
                    </a>

                    <!-- DELETE -->
                    <a href="reviews/delete_review.php?id=<?= $r['id'] ?>"
                    class="btn btn-sm btn-outline-danger"
                    onclick="return confirm('Are you sure you want to delete this review?');">
                    Delete
                    </a>
                </div>
            </div>
        <?php endwhile; ?>

    </div>
</section>

<!-- FOOTER -->
<footer class="footer-section">
    <div class="container py-4">
        
        <div class="row align-items-center">
            
            <div class="col-12 col-md-4 text-start"> 
                <a class="footer-brand" href="index.php">
                    <img src="assets/DineReview_Logo.png" alt="Logo" class="footer-logo">
                </a>
            </div>

            <div class="col-12 col-md-4 text-center">
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
        
        <hr class="footer-full-divider my-3">
        
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
