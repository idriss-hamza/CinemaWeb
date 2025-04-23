<?php
session_start();
require_once 'config.php';

// Check if user is logged in
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

if (isset($_GET['movie_id'])) {
    $movieId = $_GET['movie_id'];
    foreach ($movies as $movie) {
        if ($movie['id'] == $movieId) {
            $selectedmovie = $movie;
            break;
        }
    }
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
            <div class="movie-card" onclick="window.location.href='index.php?movie_id=<?= $movie['id'] ?>'">
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

      <section class="movie-info">
      <?php if ($selectedmovie): ?>

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

        <?php else: ?>
            <h2>Select a movie to see details</h2>
        <?php endif; ?>

      </section>
      <?php if ($selectedmovie): ?>
      <section class="date-time-selection">
        <h2>Select the Date and Time</h2>
        
        <div class="date-selector">
          <div class="date-item">
            <div class="date-day">Mon</div>
            <div class="date-number">7</div>
            <div class="date-month">April</div>
          </div>
          <div class="date-item">
            <div class="date-day">Tue</div>
            <div class="date-number">8</div>
            <div class="date-month">April</div>
          </div>
          <div class="date-item">
            <div class="date-day">Wed</div>
            <div class="date-number">9</div>
            <div class="date-month">April</div>
          </div>
          <div class="date-item">
            <div class="date-day">Thu</div>
            <div class="date-number">10</div>
            <div class="date-month">April</div>
          </div>
          <div class="date-item">
            <div class="date-day">Fri</div>
            <div class="date-number">11</div>
            <div class="date-month">April</div>
          </div>
          <div class="date-item">
            <div class="date-day">Sat</div>
            <div class="date-number">12</div>
            <div class="date-month">April</div>
          </div>
          <div class="date-item">
            <div class="date-day">Sun</div>
            <div class="date-number">13</div>
            <div class="date-month">April</div>
          </div>
        </div>
        <div class="time-selector">
          <div class="time-item">10:30 AM</div>
          <div class="time-item">1:00 PM</div>
          <div class="time-item">3:30 PM</div>
          <div class="time-item">6:00 PM</div>
          <div class="time-item">8:30 PM</div>
          <div class="time-item">11:00 PM</div>
        </div>
      </section>
      <section class="seat-selection">
        <h2>Select Your Seats</h2>
        <div class="screen-container">
          <div class="screen"></div>
          <div class="screen-label">SCREEN</div>
        </div>   



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
    <script src="dateTimeSelection.js"></script>
</body>
</html> 