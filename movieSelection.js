
document.addEventListener('DOMContentLoaded', () => {
  const movieCards = document.querySelectorAll('.movie-card');
  
  // Define movie details for each movie
  const movieDetails = {
    "Interstellar": {
      title: "Interstellar",
      rating: "PG-13",
      duration: "169 min",
      genres: "Sci-Fi, Adventure, Drama",
      imdbRating: "8.7",
      criticsRating: "73%",
      description: "When Earth becomes uninhabitable in the future, a farmer and ex-NASA pilot, Joseph Cooper, is tasked to pilot a spacecraft, along with a team of researchers, to find a new planet for humans.",
      director: "Christopher Nolan",
      cast: "Matthew McConaughey, Anne Hathaway, Jessica Chastain, Bill Irwin",
      posterUrl: "https://m.media-amazon.com/images/M/MV5BZjdkOTU3MDktN2IxOS00OGEyLWFmMjktY2FiMmZkNWIyODZiXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_.jpg"
    },
    "The Dark Knight": {
      title: "The Dark Knight",
      rating: "PG-13",
      duration: "152 min",
      genres: "Action, Crime, Drama",
      imdbRating: "9.0",
      criticsRating: "94%",
      description: "When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.",
      director: "Christopher Nolan",
      cast: "Christian Bale, Heath Ledger, Aaron Eckhart, Michael Caine",
      posterUrl: "https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_.jpg"
    },
    "The Godfather": {
      title: "The Godfather",
      rating: "R",
      duration: "175 min",
      genres: "Crime, Drama",
      imdbRating: "9.2",
      criticsRating: "97%",
      description: "The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.",
      director: "Francis Ford Coppola",
      cast: "Marlon Brando, Al Pacino, James Caan, Diane Keaton",
      posterUrl: "https://m.media-amazon.com/images/M/MV5BMWMwMGQzZTItY2JlNC00OWZiLWIyMDctNDk2ZDQ2YjRjMWQ0XkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_.jpg"
    },
    "The Matrix": {
      title: "The Matrix",
      rating: "R",
      duration: "136 min",
      genres: "Action, Sci-Fi",
      imdbRating: "8.7",
      criticsRating: "88%",
      description: "A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.",
      director: "Lana Wachowski, Lilly Wachowski",
      cast: "Keanu Reeves, Laurence Fishburne, Carrie-Anne Moss, Hugo Weaving",
      posterUrl: "https://m.media-amazon.com/images/M/MV5BNzQzOTk3OTAtNDQ0Zi00ZTVkLWI0MTEtMDllZjNkYzNjNTc4L2ltYWdlXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_.jpg"
    },
    "Sahbek Rajel": {
      title: "Sahbek Rajel",
      rating: "R",
      duration: "154 min",
      genres: "Crime, Drama",
      imdbRating: "8.9",
      criticsRating: "92%",
      description: "The lives of two mob hitmen, a boxer, a gangster and his wife, and a pair of diner bandits intertwine in four tales of violence and redemption.",
      director: "Quentin Tarantino",
      cast: "John Travolta, Uma Thurman, Samuel L. Jackson, Bruce Willis",
      posterUrl: "assets/sahbek.jpg"
    },
    "Oppenheimer": {
      title: "Oppenheimer",
      rating: "PG-13",
      duration: "142 min",
      genres: "Drama, Romance",
      imdbRating: "8.8",
      criticsRating: "71%",
      description: "The presidencies of Kennedy and Johnson, the Vietnam War, the Watergate scandal and other historical events unfold from the perspective of an Alabama man with an IQ of 75, whose only desire is to be reunited with his childhood sweetheart.",
      director: "Robert Zemeckis",
      cast: "Tom Hanks, Robin Wright, Gary Sinise, Sally Field",
      posterUrl: "assets/oppen.jpg"
    }
  };
  
  // Function to update movie info section with selected movie details
  function updateMovieInfo(details) {
    // Update movie poster
    const moviePoster = document.querySelector('.movie-info .movie-poster img');
    if (moviePoster) {
      moviePoster.src = details.posterUrl;
      moviePoster.alt = `${details.title} poster`;
    }
    
    // Update movie title
    const movieTitle = document.querySelector('.movie-info h1');
    if (movieTitle) {
      movieTitle.textContent = details.title;
    }
    
    // Update movie meta data
    const ratingBadge = document.querySelector('.movie-meta .badge');
    if (ratingBadge) {
      ratingBadge.textContent = details.rating;
    }
    
    const movieLength = document.querySelector('.movie-meta .movie-length');
    if (movieLength) {
      movieLength.textContent = details.duration;
    }
    
    const movieGenre = document.querySelector('.movie-meta .movie-genre');
    if (movieGenre) {
      movieGenre.textContent = details.genres;
    }
    
    // Update movie ratings
    const imdbRating = document.querySelector('.rating-circle.imdb');
    if (imdbRating) {
      imdbRating.textContent = details.imdbRating;
    }
    
    const criticsRating = document.querySelector('.rating-circle.critics');
    if (criticsRating) {
      criticsRating.textContent = details.criticsRating;
    }
    
    // Update movie description
    const movieDesc = document.querySelector('.movie-description p');
    if (movieDesc) {
      movieDesc.textContent = details.description;
    }
    
    // Update director
    const director = document.querySelector('.movie-crew p');
    if (director) {
      director.textContent = details.director;
    }
    
    // Update cast
    const cast = document.querySelector('.movie-cast p');
    if (cast) {
      cast.textContent = details.cast;
    }
    
    // Update selected movie in the summary section
    const selectedMovieElement = document.querySelector('.selected-movie');
    if (selectedMovieElement) {
      selectedMovieElement.textContent = details.title;
    }
  }
  
  movieCards.forEach(card => {
    card.addEventListener('click', () => {
      // Remove 'selected' class from all cards
      movieCards.forEach(c => c.classList.remove('selected'));
      
      // Add 'selected' class to clicked card
      card.classList.add('selected');
      
      // Get the movie title from the clicked card
      const movieTitle = card.querySelector('h3').textContent;
      
      // Check if we have details for this movie
      if (movieDetails[movieTitle]) {
        const details = movieDetails[movieTitle];
        
        // Update all movie info with the selected movie's details
        updateMovieInfo(details);
        
        // Dispatch a custom event with the movie data that React components can listen for
        const event = new CustomEvent('movieSelected', {
          detail: {
            movieData: details
          }
        });
        window.dispatchEvent(event);
      }
    });
  });
  
  // Initialize with the first movie selected to ensure consistency
  if (movieCards.length > 0) {
    movieCards[0].click();
  }
});