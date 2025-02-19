<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full-Screen Movie Poster</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: rgba(34, 34, 34, 0.5); /* Adjust the alpha value (0.5 for 50% transparency) */
            backdrop-filter: blur(0px);
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            overflow: hidden;
        }

        /* Add transition properties for sliding animation */
        #poster-container {
            transition: transform 0.5s ease-in-out;
            position: relative;
        }

        #poster-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh;
        }

        #poster {
            width: 100vw; /* Set width to 100% of viewport width */
            height: 100vh; /* Set height to 100% of viewport height */
            object-fit: fixed; /* Maintain aspect ratio and cover entire area */
        }

        #movie-info {
            position: absolute;
            bottom: 20px;
            left: 10px;
            color: white;
            font-size: 1px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            max-width: 80%;
            background-color: rgba(0, 0, 0, 0.7); /* Background color with transparency */
            padding: 20px;
            border-radius: 15px; /* Rounded corners */
        }
    </style>
</head>
<body>
    <div id="poster-container">
        <img id="poster" src="../logo/bg.php" alt="Movie Poster">
        <div id="movie-info">
            <h2 id="movie-title"></h2>
            <p id="movie-release-date"></p>
            <p id="movie-overview"></p>
        </div>
    </div>
    <script async>
        const apiKey = '59b62063232f5adc864355aa4fa216f2'; // Replace 'YOUR_API_KEY' with your actual API key
        let currentIndex = 0;
        let movieIds = [];

        async function fetchPopularMovies() {
            try {
                const response = await fetch(`https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&sort_by=popularity.desc`);
                const data = await response.json();
                movieIds = data.results.map(movie => movie.id);
            } catch (error) {
                console.error('Failed to fetch popular movies:', error);
            }
        }

        async function updateMovieInfo() {
            if (movieIds.length === 0) {
                console.error('No movie IDs available.');
                return;
            }

            const movieId = movieIds[currentIndex];

            try {
                const response = await fetch(`https://api.themoviedb.org/3/movie/${movieId}?api_key=${apiKey}`);
                const data = await response.json();
                const posterContainer = document.getElementById('poster-container');
                const poster = document.getElementById('poster');
                const movieTitle = document.getElementById('movie-title');
                const movieReleaseDate = document.getElementById('movie-release-date');
                const movieOverview = document.getElementById('movie-overview');

                // Add a sliding-out effect by translating the container to the left
                posterContainer.style.transform = 'translateX(-100%)';

                // Preload the next image
                preloadNextImage(currentIndex);

                // Wait for the animation to complete, then update the poster and reset the position
                setTimeout(() => {
                    poster.src = `https://image.tmdb.org/t/p/original${data.poster_path}`;
                    movieTitle.textContent = data.title;
                    movieReleaseDate.textContent = `Release Date: ${data.release_date}`;
                    movieOverview.textContent = data.overview;
                    posterContainer.style.transform = 'translateX(0)';
                }, 500); // Adjust the duration as needed

                currentIndex = (currentIndex + 1) % movieIds.length;
            } catch (error) {
                console.error('Failed to fetch movie details:', error);
            }
        }

        async function preloadNextImage(index) {
            const nextIndex = (index + 1) % movieIds.length;
            const nextMovieId = movieIds[nextIndex];

            try {
                const response = await fetch(`https://api.themoviedb.org/3/movie/${nextMovieId}?api_key=${apiKey}`);
                const data = await response.json();
                const nextImage = new Image();
                nextImage.src = `https://image.tmdb.org/t/p/original${data.poster_path}`;
            } catch (error) {
                console.error('Failed to preload next image:', error);
            }
        }

        fetchPopularMovies().then(() => {
            preloadNextImage(currentIndex);
            setTimeout(updateMovieInfo, 2000);
            setInterval(updateMovieInfo, 9000);
        });
    </script>
</body>
</html>