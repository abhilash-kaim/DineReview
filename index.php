<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Title bar with embedded CSS -->
    <title>DineReview, The dine reservation, review app</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
     rel="stylesheet"
     />
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     <link rel="stylesheet" href="Style/style.css">
     <link rel="stylesheet" href="Style/contact.css">
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
    <!-- Displays navigation links and user login status -->
    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
      <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#">
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
            <?php if (isset($_GET['newsletter'])): ?>

            <?php if ($_GET['newsletter'] === 'success'): ?>
                <div class="alert alert-success text-center">
                    ✅ Thank you for signing up! You'll hear from us soon.
                </div>

            <?php elseif ($_GET['newsletter'] === 'exists'): ?>
                <div class="alert alert-warning text-center">
                    ⚠️ This email is already subscribed to our newsletter.
                </div>

            <?php elseif ($_GET['newsletter'] === 'invalid'): ?>
                <div class="alert alert-danger text-center">
                    ❌ Please enter a valid email address.
                </div>

            <?php endif; ?>

        <?php endif; ?>


        <?php if (isset($_SESSION['newsletter_msg'])): ?>
            <div class="container mt-3">
                <div class="alert alert-success text-center">
                    <?= htmlspecialchars($_SESSION['newsletter_msg']) ?>
                </div>
            </div>
            <?php unset($_SESSION['newsletter_msg']); ?>
        <?php endif; ?>

    <!-- Hero Section, the first section of index.html -->
    <!-- Introduces the DineReview platform to users -->
    <section class="hero-section" style="padding: 40px 0;">
        <div class="container main-content-border">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="hero-text-content">
                        <h1 class="hero-headline">
                            Discover and Reserve the Best Restaurants near you
                        </h1>
                        <p class="lead mb-4">
                            Explore reviews, make reservations, and enjoy dining experiences like never before with DineReview.
                        </p>
                        <a href="blog.php" class="btn-explore" role="button">Explore</a>
                        <a href="reserve.php" class="btn-learn-more" role="button">Reserve</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 p-0 m-0">
                    <div class="hero-image-wrapper">
                        <img src="assets/Home.png" alt="chef" class="hero-image shadow-lg">
                    </div>
            </div>
        </div>
    </section>
    <!-- This section describes the services provided by DineReview -->
   <section class="features-section">
    <div class="container">
        
        <header class="text-center mb-5">
            <p class="text-uppercase fw-bold m-0" style="letter-spacing: 2px; font-size: 0.8rem;">Features</p>
            <h2 class="display-5 fw-bold my-3">Dining made simple</h2> 
            <p class="lead">Seamless restaurant discovery and reservation experience for food lovers.</p> 
        </header>
        
        <div class="row g-4"> 
            
            <div class="col-lg-4 col-md-12">
                <div class="feature-card card-reviews card-wide"> <p class="card-title">Reviews</p>
                    <h3 class="card-headline">Authentic restaurant reviews</h3>
                    <p>Read honest experiences from real diners to make informed choices.</p>
                    <div class="mt-3">
                        <a href="reviews.php" class="btn btn-sm btn-dark me-2">Read more <span aria-hidden="true">&rsaquo;</span></a> 
                        <a href="blog.php" class="btn btn-sm btn-outline-dark">Explore <span aria-hidden="true">&rsaquo;</span></a>
                    </div>
                </div>
            </div> 
            
            <div class="col-lg-4 col-md-6">
                <div class="feature-card card-reservations card-square"> <div class="features-icon"></div>
                    <p class="card-title">Reservations</p>
                    <h3 class="card-headline">Easy table reservations</h3> 
                    <p>Book your favorite restaurants with just a few taps.</p> 
                    <div class="mt-3">
                        <a href="reserve.php" class="btn btn-sm btn-light">Reserve <span aria-hidden="true">&rsaquo;</span></a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="feature-card card-ratings card-square"> <div class="feature-icon"></div>
                    <p class="card-title">Community ratings</p>
                    <h3 class="card-headline">Community ratings</h3> 
                    <p>Trust crowd-sourced ratings to find top dining spots.</p> 
                    <div class="mt-3">
                        <a href="restaurants.php" class="btn btn-sm btn-light">Rate <span aria-hidden="true">&rsaquo;</span></a>
                    </div>
                </div> 
            </div>
            
        </div> 
        
    </div> 
</section>

<!-- This section showcases real testimonials about customer experience. -->
<section class="customer-stories-section">
    <div class="container">
        <header class="text-center mb-5">
            <h2 class="display-5 fw-bold my-3">
                Customer Stories
            </h2>
            <p class="lead">Real Diners, real experiences that speaks volumes</p>
        </header>

        <div class="row g-4">
            
            <div class="col-lg-4 col-md-6"> 
                
                <div class="customer-stories-card customer-card-square d-flex flex-column justify-content-between">
                    
                    <div>

                        
                        <div class="review-rating mb-3 d-block" >
                            &#9733; &#9733; &#9733; &#9733; &#9733;
                        </div>
                    </div>
                    
                    <p class="review-text my-3">
                        "The reviews helped me discover hidden gems, and the reservation system was top notch. Highly recommend!"
                    </p>
                    <h6 class="card-title m-0 me-3">
                        Sarah Johnson<br> Food Blogger, New York
                        
                    </h6>
                    
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="customer-stories-card customer-card-square d-flex flex-column justify-content-between">
                    <div class="d-flex align-items-center mb-2">
                        <div class="review-rating mb-2">
                            &#9733; &#9733; &#9733; &#9733; &#9734;
                        </div>
                    </div>

                    <p class="review-text my-3">
                        "Booking tables has never been this smooth and intuitive. DineReview is my go-to app for dining out!"
                    </p>

                    <h6 class="card-title m-0 me-3">
                        Mark Thompson<br> Entrepreneur, San Francisco</h6>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="customer-stories-card customer-card-square d-flex flex-column justify-content-between">
                    <div class="d-flex align-items-center mb-2">
                        <div class="review-rating">
                            &#9733; &#9733; &#9733; &#9733; &#9733;
                        </div>
                    </div>
                    <p class="review-text">
                        "Honest reviews helped me find hidden culinary gems."
                    </p>
                    <h6 class="card-title m-0 me-3">
                        Gurpreet Sandhu<br> Marketing Director, Apple Inc.
                    </h6>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- This section allows users to sign up for newsletters -->
    <section class="contact-us-section">
        <div class="container main-content-border">
            <header class="text-center mb-5">
                <h2 class="display-5 fw-bold my-3">
                    Stay in touch
                </h2>
                <p class="lead">Get latest restaurant trends, reviews, and exclusive dining offers</p>
            </header>
            <form action="newsletter/newsletter_signup.php" method="POST"
                class="d-flex justify-content-center mb-4">

                <input type="email"
                    class="form-control email-input-custom me-3"
                    name="signup"
                    placeholder="Enter email address"
                    required>

                <button type="submit" class="btn-signup">Sign Up</button>
            </form>

            <p class="text-center mb-5">By signing up, you agree to our terms and privacy policy</p>
        </div>
    </section>
    <!-- This section introduces the team behind DineReview -->
    <section class="team-section">
        <div class="container">
            <header class="text-center mb-5">
                <p class="text-uppercase fw-bold m-0" style="letter-spacing: 2px; font-size: 0.8rem;">Creators</p>
                <h2 class="display-5 fw-bold my-3">Our team</h2> 
                <p class="lead">Passionate Food lovers building the future of dining discovery</p> 
            </header>

            <div class="row text-center g-4">
                <div class="col-lg-4 col-md-6 mb-5">
                    <img src="assets/Faiz_DP.jpeg" alt="Abhilash Profile" class="team-profile-img">
                    <h3 class="team-name">Syed Faiz</h3>
                    <p class="team-role">Project Manager</p>
                    <p class="team-description mx-auto">
                        Driven by a passion for connecting food lovers with incredible dining experiences
                    </p>

                    <div class="social-links">
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a> 
                        <a href="#"><i class="bi bi-instagram"></i></a>
                    </div>

                </div>
            
                <div class="col-lg-4 col-md-6 mb-5">
                    <img src="assets/Abhilash_DP.jpg" alt="Abhilash Profile" class="team-profile-img">
                    <h3 class="team-name">Abhilash Kaim</h3>
                    <p class="team-role">Design Lead</p>
                    <p class="team-description mx-auto">
                        Creating intuitive interfaces that makes restaurant discovery effortless
                    </p>

                    <div class="social-links">
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a> 
                        <a href="#"><i class="bi bi-instagram"></i></a>
                    </div>

                    </div>

                <div class="col-lg-4 col-md-6 mb-5">
                    <img src="assets/Jasser_DP.jpeg" alt="Abhilash Profile" class="team-profile-img">
                    <h3 class="team-name">Khaja Akrama Jasser</h3>
                    <p class="team-role">Lead Data Engineer/Analyst</p>
                    <p class="team-description mx-auto">The chef who transforms raw data into perfectly prepared, actionale insights.                    </p>

                    <div class="social-links">
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a> 
                        <a href="#"><i class="bi bi-instagram"></i></a>
                    </div>

                </div>
                <div class="col-lg-4 col-md-6 mb-5">
                    <img src="assets/Nithin_DP.jpeg" alt="Nithin Profile" class="team-profile-img">
                    <h3 class="team-name">Nithin Kumar Bomma</h3>
                    <p class="team-role">Lead Developer</p>
                    <p class="team-description mx-auto">
                        Building robust, scalable solutions that power the future of dining discovery.
                    </p>

                    <div class="social-links">
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a> 
                        <a href="#"><i class="bi bi-instagram"></i></a>
                    </div>

                </div>
                <div class="col-lg-4 col-md-6 mb-5">
                    <img src="assets/default.jpg" alt="Abhilash Profile" class="team-profile-img">
                    <h3 class="team-name">You</h3>
                    <p class="team-role">User Experience (Intern)</p>
                    <p class="team-description mx-auto">
                        Ready to define the future of our UX/UI? Explore our current opening below.
                    </p>

                    <div class="social-links">
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a> 
                        <a href="#"><i class="bi bi-instagram"></i></a>
                    </div>

                </div>
                <div class="col-lg-4 col-md-6 mb-5">
                    <img src="assets/default.jpg" alt="Abhilash Profile" class="team-profile-img">
                    <h3 class="team-name">You</h3>
                    <p class="team-role">Developer (Intern)</p>
                    <p class="team-description mx-auto">
                        Love building robust, high-performance systems? View our current positions.
                    </p>

                    <div class="social-links">
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a> 
                        <a href="#"><i class="bi bi-instagram"></i></a>
                    </div>

                </div>

                <div class="text-center mb-3">
                    <h4 class="display-5 fw-bold my-3">We're Hiring</h4> 
                    <p class="lead">Join Our team and help shape the future of dining</p> 
                </div>
                <!-- when the button is clicked, it redirects the browser to positions.php-->
                <button type="button" onclick="window.location.href='positions.php'" class=" btn-positions">
                    View Positions
                </button>
            </div>
        </div>
    </section>
    <footer class="footer-section">
    <div class="container py-4">
        
        <div class="row align-items-center">
            
            <div class="col-12 col-md-4 text-start"> 
                <a class="footer-brand" href="#">
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
    