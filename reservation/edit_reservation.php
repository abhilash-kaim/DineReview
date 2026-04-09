<?php
session_start();
require "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit;
}

$id = $_GET['id'] ?? null;
$userId = $_SESSION['user_id'];

/* Fetch reservation */
$stmt = $conn->prepare(
    "SELECT restaurant_name, reservation_date, reservation_time, guests
     FROM reservations
     WHERE id = ? AND user_id = ?"
);
$stmt->bind_param("ii", $id, $userId);
$stmt->execute();
$reservation = $stmt->get_result()->fetch_assoc();

if (!$reservation) {
    echo "Reservation not found.";
    exit;
}

/* Update */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $date = $_POST['date'];
    $time = $_POST['time'];
    $guests = $_POST['guests'];

    $update = $conn->prepare(
        "UPDATE reservations
         SET reservation_date = ?, reservation_time = ?, guests = ?
         WHERE id = ? AND user_id = ?"
    );
    $update->bind_param("ssiii", $date, $time, $guests, $id, $userId);
    $update->execute();

    $_SESSION['profile_msg'] = "Reservation updated successfully ✅";
    header("Location: ../reservations.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Reservation</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h3>Edit Reservation – <?= htmlspecialchars($reservation['restaurant_name']) ?></h3>

    <form method="POST">

        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="date"
                   class="form-control"
                   value="<?= $reservation['reservation_date'] ?>" required>
        </div>

        <div class="mb-3">
            <label>Time</label>
            <input type="time" name="time"
                   class="form-control"
                   value="<?= $reservation['reservation_time'] ?>" required>
        </div>

        <div class="mb-3">
            <label>Guests</label>
            <input type="number" name="guests"
                   class="form-control"
                   value="<?= $reservation['guests'] ?>" min="1" required>
        </div>

        <button class="btn btn-dark">Update Reservation</button>
        <a href="../reservations.php" class="btn btn-secondary ms-2">Cancel</a>

    </form>
</div>

</body>
</html>
