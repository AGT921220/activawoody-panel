<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autoplaying Trailers</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #222;
        }
        iframe {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <iframe id="trailer" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

    <script>
        const apiKey = '6b8e3eaa1a03ebb45642e9531d8a76d2'; // Replace with your TMDb API key
        let currentIndex = 0;
        let movieIds = [];

        async function fetchPopularMovieIds() {
            try {
                const response = await fetch(`https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&sort_by=popularity.desc`);
                const data = await response.json();
                movieIds = data.results.map(movie => movie.id);
            } catch (error) {
                console.error('Failed to fetch popular movies:', error);
            }
        }

        async function updateTrailer() {
            if (movieIds.length === 0) {
                console.error('No movie IDs available.');
                return;
            }

            const movieId = movieIds[currentIndex];

            try {
                const response = await fetch(`https://api.themoviedb.org/3/movie/${movieId}/videos?api_key=${apiKey}`);
                const data = await response.json();

                const trailer = data.results.find(video => video.type === 'Trailer');
                
                if (trailer) {
                    const trailerKey = trailer.key;
                    const trailerFrame = document.getElementById('trailer');
                    trailerFrame.src = `https://www.youtube.com/embed/${trailerKey}?autoplay=1&mute=1&controls=0`; // Add autoplay, mute, and remove controls
                } else {
                    console.error('No trailer available for the movie with ID:', movieId);
                }

                currentIndex = (currentIndex + 1) % movieIds.length;
            } catch (error) {
                console.error('Failed to fetch trailer:', error);
            }
        }

        fetchPopularMovieIds().then(() => {
            setInterval(updateTrailer, 15000); // Change trailer every 15 seconds (adjust as needed)
            updateTrailer(); // Initial update
        });
    </script>
</body>
</html>
