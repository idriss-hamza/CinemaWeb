<?php
session_start();
require_once 'movie_data.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please sign in to reserve seats']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['movie_id']) || !isset($data['showtime']) || !isset($data['seats'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request data']);
    exit();
}

$movie_id = $data['movie_id'];
$showtime = $data['showtime'];
$seats = $data['seats'];
$user_id = $_SESSION['user_id'];

// Check if any of the selected seats are already reserved
$reserved_seats = getReservedSeats($movie_id, $showtime);
$conflicting_seats = array_intersect($seats, $reserved_seats);

if (!empty($conflicting_seats)) {
    echo json_encode(['success' => false, 'message' => 'Some seats are already reserved']);
    exit();
}

// Reserve the seats
if (reserveSeats($movie_id, $showtime, $seats, $user_id)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to reserve seats']);
}
?> 