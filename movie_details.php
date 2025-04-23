<?php
session_start();
require_once 'movie_data.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$movie_id = $_GET['id'];
$movie = getMovieDetails($movie_id);

if (!$movie) {
    header("Location: index.php");
    exit();
}

// Get reserved seats for the selected showtime
$showtime = isset($_GET['showtime']) ? $_GET['showtime'] : date('Y-m-d H:i:s');
$reserved_seats = getReservedSeats($movie_id, $showtime);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($movie['title']); ?> - FourCinema</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="assets/logo.png">
</head>
<body>
    <header class="header">
        <div class="logo">
            <h1><span class="text-blue">Four</span><span class="font-light">Cinema</span></h1>
        </div>
        <nav class="desktop-nav">
            <a href="index.php">Movies</a>
        </nav>
        <div>
            <?php if (isset($_SESSION['user_id'])): ?>
                <span class="welcome-text">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <button class="btn-primary" onclick="window.location.href='logout.php'">Logout</button>
            <?php else: ?>
                <button class="btn-primary" onclick="window.location.href='signin.html'">Sign In</button>
            <?php endif; ?>
        </div>
    </header>

    <div class="movie-details">
        <div class="movie-info">
            <img src="<?php echo htmlspecialchars($movie['image_url']); ?>" alt="<?php echo htmlspecialchars($movie['title']); ?>">
            <div class="movie-text">
                <h1><?php echo htmlspecialchars($movie['title']); ?></h1>
                <p class="genre"><?php echo htmlspecialchars($movie['genre']); ?></p>
                <p class="rating"><?php echo htmlspecialchars($movie['rating']); ?></p>
                <p class="duration">Duration: <?php echo htmlspecialchars($movie['duration']); ?> minutes</p>
                <p class="description"><?php echo htmlspecialchars($movie['description']); ?></p>
            </div>
        </div>

        <div class="seat-selection">
            <h2>Select Seats</h2>
            <div class="screen">Screen</div>
            <div class="seats-grid">
                <?php
                $rows = 8;
                $cols = 10;
                for ($row = 1; $row <= $rows; $row++) {
                    for ($col = 1; $col <= $cols; $col++) {
                        $seat_number = $row . chr(64 + $col);
                        $isReserved = in_array($seat_number, $reserved_seats);
                        $class = $isReserved ? 'seat reserved' : 'seat';
                        echo "<div class='$class' data-seat='$seat_number' " . 
                             ($isReserved ? "style='background-color: #ff4444;'" : "") . 
                             "></div>";
                    }
                    echo "<br>";
                }
                ?>
            </div>
            <div class="seat-legend">
                <div class="legend-item">
                    <div class="seat available"></div>
                    <span>Available</span>
                </div>
                <div class="legend-item">
                    <div class="seat reserved"></div>
                    <span>Reserved</span>
                </div>
                <div class="legend-item">
                    <div class="seat selected"></div>
                    <span>Selected</span>
                </div>
            </div>
            <?php if (isset($_SESSION['user_id'])): ?>
                <button id="reserve-btn" class="btn-primary" onclick="reserveSeats()">Reserve Selected Seats</button>
            <?php else: ?>
                <p class="login-required">Please <a href="signin.html">sign in</a> to reserve seats.</p>
            <?php endif; ?>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <div class="footer-copyright">
                <p>&copy; 2025 FourCinema. All rights reserved.</p>
            </div>
            <div class="footer-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Contact Us</a>
            </div>
        </div>
    </footer>

    <script>
        let selectedSeats = [];

        document.querySelectorAll('.seat:not(.reserved)').forEach(seat => {
            seat.addEventListener('click', () => {
                seat.classList.toggle('selected');
                const seatNumber = seat.getAttribute('data-seat');
                if (seat.classList.contains('selected')) {
                    selectedSeats.push(seatNumber);
                } else {
                    selectedSeats = selectedSeats.filter(s => s !== seatNumber);
                }
            });
        });

        function reserveSeats() {
            if (selectedSeats.length === 0) {
                alert('Please select at least one seat');
                return;
            }

            fetch('reserve_seats.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    movie_id: <?php echo $movie_id; ?>,
                    showtime: '<?php echo $showtime; ?>',
                    seats: selectedSeats
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Seats reserved successfully!');
                    window.location.reload();
                } else {
                    alert('Error reserving seats: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while reserving seats');
            });
        }
    </script>
</body>
</html> 