<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Careers - DineReview</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="Style/style.css">
    <style>
        /* Page Styling */
        .positions-hero {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            padding: 80px 0;
            color: #fff;
            text-align: center;
        }

        .positions-hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .positions-hero p {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Positions Section */
        .positions-section {
            padding: 60px 0;
            background-color: #f8f9fa;
        }

        .position-card {
            background: #fff;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 4px solid #ff5733;
        }

        .position-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .position-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 8px;
        }

        .position-meta {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 16px;
        }

        .position-meta span {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #666;
            font-size: 0.9rem;
        }

        .position-meta i {
            color: #ff5733;
        }

        .position-description {
            color: #555;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .position-tags {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .position-tag {
            background: #f0f0f0;
            color: #333;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .btn-apply {
            background: linear-gradient(135deg, #ff5733 0%, #ff8c42 100%);
            color: #fff;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-apply:hover {
            background: linear-gradient(135deg, #e04e2d 0%, #e07a38 100%);
            color: #fff;
            transform: scale(1.02);
        }

        /* Benefits Section */
        .benefits-section {
            padding: 60px 0;
            background: #fff;
        }

        .benefit-card {
            text-align: center;
            padding: 30px 20px;
        }

        .benefit-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #ff5733 0%, #ff8c42 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .benefit-icon i {
            font-size: 28px;
            color: #fff;
        }

        .benefit-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #1a1a2e;
            margin-bottom: 10px;
        }

        .benefit-text {
            color: #666;
            font-size: 0.95rem;
        }

        /* Navbar styling */
        .btn-login-custom {
            background-color: #3f3f3f;
            color: #ffffff;
            border: 2px solid #5a5a5a;
            border-radius: 10px;
            padding: 8px 20px;
        }

        .btn-reserve-custom {
            background-color: #ff5733;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            padding: 8px 20px;
        }

        .navbar-logo {
            max-height: 40px;
            height: auto;
            width: 150px;
        }

        .navbar-nav .nav-item {
            margin-right: 1.5rem;
        }

        /* Filter buttons */
        .filter-buttons {
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }

        .filter-btn {
            padding: 10px 24px;
            border: 2px solid #ddd;
            background: #fff;
            border-radius: 25px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-btn:hover,
        .filter-btn.active {
            border-color: #ff5733;
            background: #ff5733;
            color: #fff;
        }

        /* No positions message */
        .no-positions {
            text-align: center;
            padding: 60px;
            color: #666;
        }

        .no-positions i {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="assets/DineReview_Logo.png" alt="Logo" class="navbar-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
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

    <!-- Hero Section -->
    <section class="positions-hero">
        <div class="container">
            <h1>Join Our Team</h1>
            <p>Be part of a passionate team shaping the future of dining discovery. We're always looking for talented individuals to join DineReview.</p>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="benefits-section">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Why Work With Us?</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="bi bi-rocket-takeoff"></i>
                        </div>
                        <h4 class="benefit-title">Growth Opportunities</h4>
                        <p class="benefit-text">Accelerate your career with mentorship, learning resources, and clear advancement paths.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="bi bi-house-heart"></i>
                        </div>
                        <h4 class="benefit-title">Flexible Work</h4>
                        <p class="benefit-text">Work remotely or from our modern office. We trust you to deliver results on your terms.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="bi bi-cup-hot"></i>
                        </div>
                        <h4 class="benefit-title">Free Dining Perks</h4>
                        <p class="benefit-text">Enjoy exclusive dining credits and discounts at partner restaurants.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Open Positions Section -->
    <section class="positions-section">
        <div class="container">
            <h2 class="text-center fw-bold mb-4">Open Positions</h2>
            <p class="text-center text-muted mb-5">Find your next opportunity with us</p>

            <!-- Filter Buttons -->
            <div class="filter-buttons">
                <button class="filter-btn active" data-filter="all">All</button>
                <button class="filter-btn" data-filter="engineering">Engineering</button>
                <button class="filter-btn" data-filter="design">Design</button>
                <button class="filter-btn" data-filter="marketing">Marketing</button>
                <button class="filter-btn" data-filter="internship">Internships</button>
            </div>

            <!-- Position Cards -->
            <div class="positions-list">

                <!-- Position 1: UX/UI Designer Intern -->
                <div class="position-card" data-category="design internship">
                    <h3 class="position-title">UX/UI Designer (Intern)</h3>
                    <div class="position-meta">
                        <span><i class="bi bi-geo-alt"></i> Remote / Dublin, Ireland</span>
                        <span><i class="bi bi-clock"></i> Internship</span>
                        <span><i class="bi bi-calendar"></i> Posted: Dec 2025</span>
                    </div>
                    <p class="position-description">
                        Join our design team and help create beautiful, intuitive interfaces for our dining platform. 
                        You'll work on user research, wireframing, prototyping, and collaborating with developers to bring designs to life.
                    </p>
                    <div class="position-tags">
                        <span class="position-tag">Figma</span>
                        <span class="position-tag">User Research</span>
                        <span class="position-tag">Prototyping</span>
                        <span class="position-tag">UI Design</span>
                    </div>
                    <button class="btn-apply" onclick="alert('Thank you for your interest! Please send your portfolio to careers@dinereview.com')">
                        Apply Now <i class="bi bi-arrow-right"></i>
                    </button>
                </div>

                <!-- Position 2: Developer Intern -->
                <div class="position-card" data-category="engineering internship">
                    <h3 class="position-title">Full Stack Developer (Intern)</h3>
                    <div class="position-meta">
                        <span><i class="bi bi-geo-alt"></i> Remote / Dublin, Ireland</span>
                        <span><i class="bi bi-clock"></i> Internship</span>
                        <span><i class="bi bi-calendar"></i> Posted: Dec 2025</span>
                    </div>
                    <p class="position-description">
                        Build robust, scalable solutions that power the future of dining discovery. 
                        You'll work with PHP, MySQL, JavaScript, and modern web technologies to develop new features and improve our platform.
                    </p>
                    <div class="position-tags">
                        <span class="position-tag">PHP</span>
                        <span class="position-tag">MySQL</span>
                        <span class="position-tag">JavaScript</span>
                        <span class="position-tag">Bootstrap</span>
                    </div>
                    <button class="btn-apply" onclick="alert('Thank you for your interest! Please send your resume to careers@dinereview.com')">
                        Apply Now <i class="bi bi-arrow-right"></i>
                    </button>
                </div>

                <!-- Position 3: Senior Backend Engineer -->
                <div class="position-card" data-category="engineering">
                    <h3 class="position-title">Senior Backend Engineer</h3>
                    <div class="position-meta">
                        <span><i class="bi bi-geo-alt"></i> Dublin, Ireland</span>
                        <span><i class="bi bi-clock"></i> Full-time</span>
                        <span><i class="bi bi-calendar"></i> Posted: Dec 2025</span>
                    </div>
                    <p class="position-description">
                        Lead the development of our backend systems, design scalable APIs, and mentor junior developers. 
                        5+ years of experience with modern backend technologies required.
                    </p>
                    <div class="position-tags">
                        <span class="position-tag">PHP</span>
                        <span class="position-tag">Node.js</span>
                        <span class="position-tag">PostgreSQL</span>
                        <span class="position-tag">Redis</span>
                        <span class="position-tag">Docker</span>
                    </div>
                    <button class="btn-apply" onclick="alert('Thank you for your interest! Please send your resume to careers@dinereview.com')">
                        Apply Now <i class="bi bi-arrow-right"></i>
                    </button>
                </div>

                <!-- Position 4: Marketing Manager -->
                <div class="position-card" data-category="marketing">
                    <h3 class="position-title">Digital Marketing Manager</h3>
                    <div class="position-meta">
                        <span><i class="bi bi-geo-alt"></i> Remote / Dublin, Ireland</span>
                        <span><i class="bi bi-clock"></i> Full-time</span>
                        <span><i class="bi bi-calendar"></i> Posted: Dec 2025</span>
                    </div>
                    <p class="position-description">
                        Drive our marketing strategy across digital channels. You'll manage campaigns, analyze performance metrics, 
                        and collaborate with content creators to grow our user base.
                    </p>
                    <div class="position-tags">
                        <span class="position-tag">SEO</span>
                        <span class="position-tag">Social Media</span>
                        <span class="position-tag">Google Ads</span>
                        <span class="position-tag">Analytics</span>
                    </div>
                    <button class="btn-apply" onclick="alert('Thank you for your interest! Please send your resume to careers@dinereview.com')">
                        Apply Now <i class="bi bi-arrow-right"></i>
                    </button>
                </div>

                <!-- Position 5: Data Analyst -->
                <div class="position-card" data-category="engineering">
                    <h3 class="position-title">Data Analyst</h3>
                    <div class="position-meta">
                        <span><i class="bi bi-geo-alt"></i> Dublin, Ireland</span>
                        <span><i class="bi bi-clock"></i> Full-time</span>
                        <span><i class="bi bi-calendar"></i> Posted: Dec 2025</span>
                    </div>
                    <p class="position-description">
                        Transform raw data into actionable insights. Analyze user behavior, restaurant trends, and business metrics 
                        to help drive product decisions and company growth.
                    </p>
                    <div class="position-tags">
                        <span class="position-tag">SQL</span>
                        <span class="position-tag">Python</span>
                        <span class="position-tag">Tableau</span>
                        <span class="position-tag">Excel</span>
                    </div>
                    <button class="btn-apply" onclick="alert('Thank you for your interest! Please send your resume to careers@dinereview.com')">
                        Apply Now <i class="bi bi-arrow-right"></i>
                    </button>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
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
    <script>
        // Filter functionality
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Update active button
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const filter = this.dataset.filter;
                const cards = document.querySelectorAll('.position-card');

                cards.forEach(card => {
                    if (filter === 'all' || card.dataset.category.includes(filter)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>
