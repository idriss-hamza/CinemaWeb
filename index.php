<?php
session_start();
require_once 'config.php';

$isLoggedIn = isset($_SESSION['user_id']);

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
$movies = getAllMovies();

$selectedmovie = null;
$movieId = null;
$selectedDate = null;
$selectedTime = null;


if (isset($_GET['movie_id'])) {
    $movieId = $_GET['movie_id'];
    foreach ($movies as $movie) {
        if ($movie['id'] == $movieId) {
            $selectedmovie = $movie;
            break;
        }
    }
}

if (isset($_GET['selected_date'])) {
    $selectedDate = $_GET['selected_date'];
}

if (isset($_GET['selected_time'])) {
    $selectedTime = $_GET['selected_time'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FourCinema - Movies</title>
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
            <?php if ($isLoggedIn): ?>
                <span class="welcome-text">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <button class="btn-primary" onclick="window.location.href='logout.php'">Logout</button>
            <?php else: ?>
                <button class="btn-primary" onclick="window.location.href='signin.html'">Sign In</button>
            <?php endif; ?>
        </div>
    </header>
<main>
    <section id="movies" class="movie-selection">
        <h2>Now Showing</h2>
        <div class="movie-carousel">
        <?php foreach ($movies as $movie): ?>
            <div class="movie-card <?php echo ($selectedmovie && $selectedmovie['id'] == $movie['id']) ? 'selected' : ''; ?>" 
                 onclick="window.location.href='index.php?movie_id=<?= $movie['id'] ?>#movie-info'">
                <div class="movie-card-poster">
                    <img src="<?php echo htmlspecialchars($movie['image_url']); ?>" alt="<?php echo htmlspecialchars($movie['title']); ?>">
                    <div class="movie-rating"><?php echo htmlspecialchars($movie['rating']); ?></div>
                </div>
                <h3><?php echo htmlspecialchars($movie['title']); ?></h3>
                <p class="genre"><?php echo htmlspecialchars($movie['genre']); ?></p>
            </div>
        <?php endforeach; ?>
        </div>
    </section>

    <?php if ($selectedmovie): ?>
    <section id="movie-info" class="movie-info">
        <div class="movie-poster">
            <img src="<?php echo htmlspecialchars($selectedmovie['image_url']); ?>" alt="<?php echo htmlspecialchars($selectedmovie['title']); ?>">
        </div>

        <div class="movie-details">
            <h1><?php echo htmlspecialchars($selectedmovie['title']); ?></h1>
            <div class="movie-meta">
                <span class="movie-length"><?php echo htmlspecialchars($selectedmovie['duration']); ?> Minutes</span>
                <span class="movie-genre"><?php echo htmlspecialchars($selectedmovie['genre']); ?></span>
            </div>
            <div class="rating">
                <div class="rating-circle imdb"><?php echo htmlspecialchars($selectedmovie['rating']); ?></div>
                <span>IMDb</span>
            </div>
            
            <div class="movie-description">
                <p><?php echo htmlspecialchars($selectedmovie['description']); ?></p>
            </div>
            <div class="movie-crew">
                <h3>Director</h3>
                <p><?php echo htmlspecialchars($selectedmovie['director']); ?></p>
            </div>
            <div class="movie-cast">
                <h3>Cast</h3>
                <p><?php echo htmlspecialchars($selectedmovie['cast']); ?></p>
            </div>
        </div>
    </section>

    <section id="date-time" class="date-time-selection">
        <h2>Select the Date and Time</h2>
        
        <div class="date-selector">
            <?php
            $sql = "SELECT dates FROM movies WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $movieId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $row = $result->fetch_assoc()) {
                $datesString = $row['dates'];
                $datesArray = explode(',', $datesString);
                foreach ($datesArray as $dateItem) {
                    if (preg_match('/^([A-Za-z]{3})(\d{1,2})([A-Za-z]+)$/', $dateItem, $matches)) {
                        $day = $matches[1];
                        $number = $matches[2];
                        $month = $matches[3];
                        $dateValue = $day.$number.$month;
                        $isSelected = $selectedDate === $dateValue;
                        ?>
                        <div class="date-item <?php echo $isSelected ? 'selected' : ''; ?>" 
                             onclick="window.location.href='index.php?movie_id=<?= $movieId ?><?= $isSelected ? '' : '&selected_date=' . urlencode($dateValue) ?>#date-time'">
                            <div class="date-day"><?= htmlspecialchars($day) ?></div>
                            <div class="date-number"><?= htmlspecialchars($number) ?></div>
                            <div class="date-month"><?= htmlspecialchars($month) ?></div>
                        </div>
                        <?php
                    }
                }
            } else {
                echo '<p>No dates found for this movie.</p>';
            }
            ?>
        </div>

        <?php if ($selectedDate): ?>
        <div class="time-selector">
            <?php
            $sql = "SELECT times FROM movies WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $movieId);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result && $row = $result->fetch_assoc()) {
                $timesString = str_replace(["\r", "\n"], '', $row['times']);
                $timesArray = explode(',', $timesString);
                foreach ($timesArray as $timeItem) {
                    $timeItem = trim($timeItem);
                    if (!empty($timeItem)) {
                        $isSelected = $selectedTime === $timeItem;
                        ?>
                        <div class="time-item <?php echo $isSelected ? 'selected' : ''; ?>" 
                             onclick="window.location.href='index.php?movie_id=<?= $movieId ?>&selected_date=<?= urlencode($selectedDate) ?><?= $isSelected ? '' : '&selected_time=' . urlencode($timeItem) ?>#date-time'">
                            <?= htmlspecialchars($timeItem) ?>
                        </div>
                        <?php
                    }
                }
            } else {
                echo '<p>No times found for this movie.</p>';
            }
            ?>
        </div>
          <?php if ($selectedTime): ?>
            <div class="seat-map">
              <?php
              $sql = "SELECT seat_number FROM reservations WHERE movie_id = ? AND date = ? AND time = ?";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("sss", $movieId, $selectedDate, $selectedTime);
              $stmt->execute();
              $result = $stmt->get_result();

              $reservedSeats = [];
              if ($result) {
                while ($row = $result->fetch_assoc()) {

                  $seats = array_map('trim', explode(',', $row['seat_number']));
                  $reservedSeats = array_merge($reservedSeats, $seats);
                }
              }
              $rows = range('A', 'H'); 
              $seatsPerRow = 12; 
              foreach ($rows as $rowLetter) {
                echo '<div class="seat-row">';
                echo '<div class="seat-label">' . $rowLetter . '</div>';
                for ($seatNumber = 1; $seatNumber <= $seatsPerRow; $seatNumber++) {
                  $seatId = $rowLetter . $seatNumber;
                  $seatClass = in_array($seatId, $reservedSeats) ? 'unavailable' : 'available';
                  echo '<div class="seat ' . $seatClass . '" data-seat-id="' . $seatId . '"></div>';
                }
                echo '<div class="seat-label">' . $rowLetter . '</div>';
                echo '</div>';
              }
              ?>
            </div>
            <div class="seat-legend">
            <div class="legend-item">
              <div class="seat mini available"></div>
              <span>Available</span>
            </div>
            <div class="legend-item">
              <div class="seat mini selected"></div>
              <span>Selected</span>
            </div>
            <div class="legend-item">
              <div class="seat mini unavailable"></div>
              <span>Unavailable</span>
            </div>
          </div>
        </div>
        <div class="selected-seats text-center mt-6"></div>
      </section>
      <form action="reserve.php" method="POST">
      <section class="summary-section">
        <div class="order-summary">
          <h2>Summary</h2>
          <div class="summary-details">
            <div class="summary-row">
              <span>Movie</span>
              <span class="selected-movie"><?php echo htmlspecialchars($selectedmovie['title']); ?></span>
            </div>
            <div class="summary-row">
              <span>Date</span>
              <span class="selected-date"><?php echo htmlspecialchars($selectedDate); ?></span>
            </div>
            <div class="summary-row">
              <span>Show time</span>
              <span class="selected-time"><?php echo htmlspecialchars($selectedTime); ?></span>
            </div>
            <div class="summary-row">
              <span>Theater</span>
              <span><?php echo htmlspecialchars($selectedmovie['theater']); ?></span>
            </div>
            <hr>
            <hr>
            <div class="summary-row total">
              <span>Total Amount</span>
              <span class="total-amount">0.00 DT</span>
            </div>
          </div>
          <input type="hidden" name="movie_id" value="<?php echo htmlspecialchars($movieId); ?>">
          <input type="hidden" name="date" value="<?php echo htmlspecialchars($selectedDate); ?>">
          <input type="hidden" name="time" value="<?php echo htmlspecialchars($selectedTime); ?>">
          <input type="hidden" name="seat_number" id="seat_number_input" value="">
          <?php if ($isLoggedIn): ?>
            <button class="payment-button btn-primary full-width disabled" type="submit">
              Reserve
            </button>
          <?php else: ?>
            <div class="login-required" style="text-align:center; color:#888; margin-top:1rem;">
              <button class="payment-button btn-primary full-width disabled" disabled>
                Reserve
              </button>
              <div style="margin-top:0.5rem;">Please <a href="signin.html">sign in</a> to Reserve.</div>
            </div>
          <?php endif; ?>
        </div>
      </section>
      </form>
          <?php endif; ?>
        <?php endif; ?>
    </section>
    <?php endif; ?>
</main>
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
      window.isLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;
    </script>
    <script src="seatSelection.js"></script>
</body>
</html> 