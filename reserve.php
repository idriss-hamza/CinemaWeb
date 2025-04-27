<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {

    header('Location: signin.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $movie_id = isset($_POST['movie_id']) ? $_POST['movie_id'] : null;
    $date = isset($_POST['date']) ? $_POST['date'] : null;
    $time = isset($_POST['time']) ? $_POST['time'] : null;
    $seat_number = isset($_POST['seat_number']) ? $_POST['seat_number'] : null;
    $created_at = date('Y-m-d H:i:s');
    
    if ($movie_id && $date && $time && $seat_number) {
        $sql = "SELECT seat_number FROM reservations WHERE movie_id = ? AND date = ? AND time = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $movie_id, $date, $time);
        $stmt->execute();
        $result = $stmt->get_result();
        $reservedSeats = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $seats = array_map('trim', explode(',', $row['seat_number']));
                $reservedSeats = array_merge($reservedSeats, $seats);
            }
        }
        $selectedSeats = array_map('trim', explode(',', $seat_number));
        $conflicts = array_intersect($selectedSeats, $reservedSeats);
        if (count($conflicts) > 0) {
            echo "<script>alert('Some selected seats are already reserved: " . implode(', ', $conflicts) . ". Please choose different seats.'); window.history.back();</script>";
            exit();
        }
        $sql = "INSERT INTO reservations (movie_id, time, date, seat_number, user_id, created_at) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $movie_id, $time, $date, $seat_number, $user_id, $created_at);
        if ($stmt->execute()) {
            echo "<script>alert('Reservation successful!'); window.location.href='index.php';</script>";
            exit();
        } else {
            echo "<script>alert('Failed to reserve seats. Please try again.'); window.history.back();</script>";
            exit();
        }
    } else {
        echo "<script>alert('Missing required information.'); window.history.back();</script>";
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}
