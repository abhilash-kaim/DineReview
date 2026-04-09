<?php
session_start();

// Remove all session variables
session_unset();

// Destroy the session
session_destroy();

// Optional: delete the cookie as well
if (isset($_COOKIE['user_email'])) {
    setcookie("user_email", "", time() - 3600, "/");
}

// Redirect back to index page
header("Location: ../index.php");
exit;
