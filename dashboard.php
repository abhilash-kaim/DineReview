<?php
session_start();

// Protect the page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
</head>
<body>

<h2>Welcome, <?php echo $_SESSION['user_name']; ?> 👋</h2>

<p>You have successfully logged in.</p>

<?php
// Show cookie value (client-side storage)
if (isset($_COOKIE['user_email'])) {
    echo "<p><strong>Logged in as:</strong> " . $_COOKIE['user_email'] . "</p>";
}
?>

<hr>

<p>This page is protected using PHP sessions.</p>

<a href="auth/logout.php">Logout</a>

</body>
</html>
