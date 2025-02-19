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
            background-color: #222;
            backdrop-filter: blur(0px);
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            overflow: hidden;
        }

        /* Add transition properties for sliding animation */
        #movie-poster-container {
            transition: transform 0.5s ease-in-out;
        }

        #movie-poster-container {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            width: 100%;
            height: 100vh;
        }

        #movie-poster {
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</head>
<body>
    <div id="movie-poster-container">
        <img id="movie-poster" src="" alt="Movie Poster">
    </div>
    <script async>
        const apiKey = '6b8e3eaa1a03ebb45642e9531d8a76d2';
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
                const moviePosterContainer = document.getElementById('movie-poster-container');
                const moviePoster = document.getElementById('movie-poster');

                // Add a sliding-out effect by translating the container to the left
                moviePosterContainer.style.transform = 'translateX(-100%)';

                // Preload the next image
                preloadNextImage(currentIndex);

                // Wait for the animation to complete, then update the poster and reset the position
                setTimeout(() => {
                    moviePoster.src = `https://image.tmdb.org/t/p/original${data.poster_path}`;
                    moviePosterContainer.style.transform = 'translateX(0)';
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
