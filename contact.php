<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>About Us</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
     rel="stylesheet"/>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     <link rel="stylesheet" href="Style/contact.css">
     <style>
        /* Styling for login button */
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

        /* Custom styling for the dropdown menu items to generate hover effect */
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
                    <li class="nav-item"><a class="nav-link text-white" href="index.php">Reviews</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Restaurants</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Reservations</a></li>
                </ul>
                        <div class="d-flex align-items-center">
                    <?php if (isset($_SESSION['user_name'])): ?>
                        <span class="text-white me-3">
                            Hello, <?php echo $_SESSION['user_name']; ?>
                        </span>
                        <a href="auth/logout.php"
                        class="btn btn-sm btn-outline-light"
                        onclick="return confirm('Are you sure you want to log out?');">
                        Logout
                        </a>
                    <?php else: ?>
                        <a href="login.html" class="btn-login-custom me-2" type="button">
                            Login
                        </a>
                        <button class="btn-reserve-custom"
                                onclick="window.location.href='signup.html'"
                                type="button">
                            Sign Up
                        </button>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </nav>


    <section class="contact-section">
        <div class="container">
            <div class="contact-form-wrapper">
                
                <header class="text-center mb-5">
                    <h1 class="display-5 fw-bold mb-3">Get In Touch</h1>
                    <p class="lead">We'd love to hear your feedback, questions, or partnership inquiries.</p>
                </header>
                
                <form action="#" method="POST">
                    
                    <div class="mb-4">
                        <label for="contact-name" class="form-label">Name</label>
                        <input type="text" id="contact-name" class="form-control form-control-custom" required>
                    </div>

                    <div class="mb-4">
                        <label for="contact-email" class="form-label">Email</label>
                        <input type="email" id="contact-email" class="form-control form-control-custom" required>
                    </div>

                    <div class="mb-4">
                        <label for="message" class="form-label">Message</label>
                        <textarea id="message" class="form-control form-control-custom form-control-textarea" rows="5" required></textarea>
                    </div>
                    
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-explore">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <footer class="footer-section">
        <div class="container py-4">
            
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

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>-->
</body>
</html>