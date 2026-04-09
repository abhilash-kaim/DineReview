<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>DineReview Blog - Dining Insights</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="contact.css"> 
    <link rel="stylesheet" href="Style/blog.css">
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
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #2c2c2c;">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="assets/DineReview_Logo.png" alt="DineReview_Logo" class="navbar-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link text-white" href="reviews.php">Reviews</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="restaurants.php">Restaurants</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="reservations.php">Reservations</a></li>
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

    
    <section class="blog-header-section">
        <div class="container text-center">
            <h1 class="display-3 fw-bold">DineReview Culinary Compass</h1>
            <p class="lead">Insights, trends, and the stories behind the best dining experiences.</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                
                <article class="blog-post-card">
                    <h3 class="mb-3">The Rise of Sustainable Fine Dining</h3>
                    <p class="post-meta">
                        <i class="bi bi-person-fill"></i> By Chef Anna | 
                        <i class="bi bi-calendar-check"></i> Nov 14, 2025 | 
                        <i class="bi bi-tag-fill"></i> <span class="badge bg-secondary">Trends</span>
                    </p>
                    <p>Sustainability is moving from a buzzword to a requirement in the world of high-end cuisine. We explore how top restaurants are reducing waste, sourcing locally, and redefining luxury...</p>
                    <a href="#" class="read-more-link">Continue Reading &rsaquo;</a>
                </article>
                
                <article class="blog-post-card">
                    <h3 class="mb-3">Hidden Gems: Underrated Eateries in Metropolis City</h3>
                    <p class="post-meta">
                        <i class="bi bi-person-fill"></i> By DineReview Team | 
                        <i class="bi bi-calendar-check"></i> Nov 07, 2025 | 
                        <i class="bi bi-tag-fill"></i> <span class="badge bg-secondary">Reviews</span>
                    </p>
                    <p>Forget the tourist traps. Our local critics reveal the best spots you haven't heard of, from hole-in-the-wall bakeries to secret late-night diners...</p>
                    <a href="#" class="read-more-link">Continue Reading &rsaquo;</a>
                </article>
                
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>

            </div>

            <div class="col-lg-4">
                <div class="p-4 mb-4 bg-dark text-white rounded-3">
                    <h4 class="fst-italic text-white">About DineReview Blog</h4>
                    <p class="mb-0" style="opacity: 0.8;">Your source for the latest in dining technology, authentic restaurant reviews, and exclusive interviews with the world's best chefs.</p>
                </div>

                <div class="p-4 mb-4 bg-light rounded-3">
                    <h4>Categories</h4>
                    <ul class="list-unstyled mb-0">
                        <li><a href="#" class="read-more-link">Restaurant Reviews (12)</a></li>
                        <li><a href="#" class="read-more-link">Industry Trends (8)</a></li>
                        <li><a href="#" class="read-more-link">Chef Interviews (5)</a></li>
                        <li><a href="#" class="read-more-link">Recipe Ideas (10)</a></li>
                    </ul>
                </div>
                
                <div class="p-4 mb-4 bg-light rounded-3">
                    <h4>Stay Connected</h4>
                    <form>
                        <input type="email" class="form-control mb-2" placeholder="Email for updates" required>
                        <button type="submit" class="btn-reserve-custom w-100">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

   <footer class="footer-section">
    <div class="container py-4">
        
        <div class="row align-items-center">
            
            <div class="col-4 text-start"> 
                <a class="footer-brand" href="index.php">
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