<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Banner</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-image: url('https://i.pinimg.com/originals/16/03/fb/1603fb7077abb9093f4af305b4e5ce79.gif'); /* Replace 'your_background.gif' with the URL of your GIF */
            background-size: cover;
            background-repeat: no-repeat;
        }

        .banner-container {
            width: 100%;
            overflow-x: hidden; /* Hide the horizontal scrollbar */
            white-space: nowrap;
            padding-bottom: 10px; /* Add some space below the banner */
            scroll-behavior: smooth; /* Enable smooth scrolling */
            margin-bottom: -10px; /* Adjust for padding */
        }

        .movie-poster {
            width: auto;
            max-height: 100vh; /* Adjust the maximum height of posters */
            margin-right: 20px; /* Adjust the spacing between posters */
        }
    </style>
</head>
<body>
    <div class="banner-container" id="movie-banner">
        <!-- Movie posters will be added here dynamically -->
    </div>

    <script>
        const apiKey = '6b8e3eaa1a03ebb45642e9531d8a76d2'; // Replace with your TMDb API key
        let movieIds = [];
        let scrollInterval;

        async function fetchPopularMovieIds() {
            try {
                const response = await fetch(`https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&sort_by=popularity.desc`);
                const data = await response.json();
                movieIds = data.results.map(movie => movie.id);
            } catch (error) {
                console.error(error);
            }
        }

        async function updateMovieBanner() {
            if (movieIds.length === 0) {
                console.error('Failed to fetch movie IDs.');
                return;
            }

            const movieId = movieIds.shift();

            fetch(`https://api.themoviedb.org/3/movie/${movieId}?api_key=${apiKey}`)
                .then((response) => response.json())
                .then((data) => {
                    const movieBanner = document.getElementById('movie-banner');
                    const posterPath = `https://image.tmdb.org/t/p/original${data.poster_path}`;
                    const moviePoster = document.createElement('img');
                    moviePoster.src = posterPath;
                    moviePoster.alt = data.title;
                    moviePoster.className = 'movie-poster';
                    movieBanner.appendChild(moviePoster);
                    movieIds.push(movieId); // Add the movie ID back to the end of the array for continuous scrolling
                })
                .catch((error) => console.error(error));
        }

        fetchPopularMovieIds().then(() => {
            // Set an interval to add movie posters every few seconds
            scrollInterval = setInterval(updateMovieBanner, 2000); // Adjust the interval here (milliseconds)
            
            // Set an interval to automatically scroll the banner
            setInterval(() => {
                const bannerContainer = document.getElementById('movie-banner');
                bannerContainer.scrollLeft += 6; // Adjust the scrolling speed as needed
            }, 50); // Adjust the interval for smoother or faster scrolling
        });
    </script>
</body>
</html>


