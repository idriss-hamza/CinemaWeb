<?php
require_once 'config.php';

// Function to get movie details
function getMovieDetails($movie_id) {
    global $conn;
    $sql = "SELECT * FROM movies WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $movie_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Function to get reserved seats for a movie
function getReservedSeats($movie_id, $showtime) {
    global $conn;
    $sql = "SELECT seat_number FROM reservations WHERE movie_id = ? AND showtime = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $movie_id, $showtime);
    $stmt->execute();
    $result = $stmt->get_result();
    $reserved_seats = [];
    while ($row = $result->fetch_assoc()) {
        $reserved_seats[] = $row['seat_number'];
    }
    return $reserved_seats;
}

// Function to reserve seats
function reserveSeats($movie_id, $showtime, $seats, $user_id) {
    global $conn;
    $success = true;
    
    foreach ($seats as $seat) {
        $sql = "INSERT INTO reservations (movie_id, showtime, seat_number, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issi", $movie_id, $showtime, $seat, $user_id);
        
        if (!$stmt->execute()) {
            $success = false;
            break;
        }
    }
    
    return $success;
}

// Function to get all movies
function getAllMovies() {
    global $conn;
    $sql = "SELECT * FROM movies";
    $result = $conn->query($sql);
    $movies = [];
    while ($row = $result->fetch_assoc()) {
        $movies[] = $row;
    }
    return $movies;
}
?> 