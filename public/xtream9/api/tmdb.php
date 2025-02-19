<?php
header('Content-Type: text/html; charset=utf-8');

// Leer el estado de la marquesina y el texto desde config.txt
$configFile = 'config.txt';
if (file_exists($configFile)) {
    $configContent = file_get_contents($configFile);
    list($marquesinaStatus, $marquesinaTexto) = explode("\n", $configContent);
    $marquesinaStatus = trim($marquesinaStatus);
    $marquesinaTexto = trim($marquesinaTexto);
} else {
    $marquesinaStatus = 'activo';
    $marquesinaTexto = 'Este es el texto en movimiento dentro de la marquesina.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie-TV-Cast3-Ratings-Random-Interleave-TweakedSizes</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: #222;
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            position: relative;
            font-size: 1.5vw; /* Ajusta el tamaño base del texto */
        }
        .backdrop-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        .backdrop {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .content-container {
            position: absolute;
            top: 5em;
            left: 2em;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 25vw; /* 20% of viewport width */
        }
        .poster-container {
            width: 100%;
            padding: 0.5em;
            background: radial-gradient(circle at 50% 50%, rgba(0, 0, 0, 0.7), rgba(166, 104, 103, 0.2));
            border-radius: 1em;
            color: #fff;
            text-align: center;
             margin-bottom: 0.5em; /* Reduced margin-bottom */
            box-sizing: border-box;
        }
        .logo {
            max-width: 80%;
            height: auto;
            margin-bottom: 0.25em;
        }
        .movie-info {
            font-size: 0.8em; /* Adjusted font size */
            margin-bottom: 0.1em; /* Reduced margin-bottom */
        }
        .rating-container {
            text-align: center;
            font-size: 2em; /* Increased font size for stars */
            margin-bottom: 0.2em; /* Reduced margin-bottom */
        }
        .star {
            color: #FFAB40; /* Gold color for filled stars */
            font-size: 0.9em;
            line-height: 0.5;
            
            /* Option 1: Glow effect */
            text-shadow: 0 0 5px rgba(255, 171, 64, 0.7), 0 0 10px rgba(255, 171, 64, 0.5);
            
            /* Option 2: Stroke effect (uncomment to use) */
            /*
            -webkit-text-stroke: 1px rgba(0, 0, 0, 0.5);
            text-stroke: 1px rgba(0, 0, 0, 0.5);
            text-shadow: 
                2px 2px 0 rgba(0, 0, 0, 0.5),
                -2px -2px 0 rgba(0, 0, 0, 0.5),
                2px -2px 0 rgba(0, 0, 0, 0.5),
                -2px 2px 0 rgba(0, 0, 0, 0.5);
            */
        }
        
        .star.empty {
            color: #888; /* Brighter color for empty stars */
            font-size: 0.65em;
            
            /* If using Option 2, you might want to adjust the empty star glow as well */
            /*
            text-shadow: 
                2px 2px 0 rgba(0, 0, 0, 0.3),
                -2px -2px 0 rgba(0, 0, 0, 0.3),
                2px -2px 0 rgba(0, 0, 0, 0.3),
                -2px 2px 0 rgba(0, 0, 0, 0.3);
            */
        }
        .vote-info {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 0.1em; /* Reduced margin-top */
            font-size: 0.8em;
        }
        .based-on {
            margin-right: 0.4em;
            font-size: 0.5em;
        }
        .vote-count {
            color: #FFF;
            font-size: 0.5em;
        }
        .actors-container {
            width: 60;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 0.5em;
            margin-bottom: 2.2em;
        }
        .actor {
            text-align: center;
            width: calc(33.3% - 0.5em); /* Adjust based on how many actors per row you want */
        }
        .actor-wrapper {
            position: relative;
            width: 100%;
            padding-top: 100%; /* Aspect ratio of 1:1 */
            overflow: hidden;
            border-radius: 50%;
            border: 2px solid #FFAB40;
            box-shadow: 0 0 8px rgba(255, 171, 64, 0.8);
        }
        .headshot {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }
        .actor-name {
            margin-top: 0.25em;
            background: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            color: #FFF;
            font-size: 0.5em;
            padding: 0.15em;
            border-radius: 0.5em;
            text-align: center;
            white-space: normal; /* Allow text wrapping */
            overflow: hidden; /* Hide text overflow */
            text-overflow: ellipsis; /* Handle overflow */
        }
        .marquesina-container {
    width: 50%; /* Ajusta el ancho a un porcentaje */
    max-width: 400px; /* Añade un ancho máximo para pantallas grandes */
    height: 50px; /* Ajusta la altura de la marquesina */
    overflow: hidden;
    background-color: rgba(0, 0, 0, 0.5); /* Negro con 50% de transparencia */
    border-radius: 15px;
    white-space: nowrap;
    position: fixed; /* Mantiene la marquesina en una posición fija */
    top: 100px; /* Mantiene la marquesina a 20px del borde superior */
    right: 1em; /* Mantiene la marquesina a 20px del borde derecho */
    z-index: 2; /* Asegurarse de que la marquesina esté por encima de todo */
    display: <?php echo $marquesinaStatus === 'activo' ? 'block' : 'none'; ?>;
}

.marquesina-texto {
    display: inline-block;
    padding: 4px;
    color: white;
    font-size: 1.5em; /* Ajusta el tamaño base del texto */
    animation: mover 8s linear infinite;
}

        @keyframes mover {
            from {
                transform: translateX(100%);
            }
            to {
                transform: translateX(-100%);
            }
        }
        @media (max-width: 768px) {
            .marquesina-container {
                width: 80%;
                bottom: 10%;
                left: 50%;
            }
            .marquesina-texto {
                font-size: 1em;
            }
        }
        @media (max-width: 480px) {
            .marquesina-container {
                width: 90%;
                bottom: 15%;
                left: 50%;
            }
            .marquesina-texto {
                font-size: 0.75em;
            }
        }
    </style>
</head>
<body>
    <div class="backdrop-container">
        <img id="backdrop" class="backdrop" src="" alt="Backdrop">
    </div>
    <div class="content-container">
        <div class="poster-container">
            <img id="logo" class="logo" src="" alt="Logo">
            <div id="movie-info" class="movie-info"></div>
            <div id="rating-container" class="rating-container"></div>
        </div>
        <div id="actors-container" class="actors-container"></div>
    </div>
    <div class="marquesina-container">
        <div class="marquesina-texto">
            <?php echo htmlspecialchars($marquesinaTexto, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    </div>
    <script>
        const apiKey = '6b8e3eaa1a03ebb45642e9531d8a76d2';
        let currentIndex = 0;
        let mediaIds = [];
        const numberOfActors = 3; // Maximum number of actors to display
        const numberOfMovies = 10; // Change this value to fetch more/less movies
        const numberOfTvShows = 20; // Change this value to fetch more/less TV shows

        function fisherYatesShuffle(array) {
            let currentIndex = array.length, randomIndex;
            // While there remain elements to shuffle.
            while (currentIndex !== 0) {
                // Pick a remaining element.
                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex--;
                // Swap it with the current element.
                [array[currentIndex], array[randomIndex]] = [array[randomIndex], array[currentIndex]];
            }
            return array;
        }

        async function fetchPopularEnglishMovieIds(count) {
            try {
                const response = await fetch(`https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&sort_by=popularity.desc&language=en`);
                if (!response.ok) {
                    throw new Error('Failed to fetch popular English movies');
                }
                const data = await response.json();
                return data.results
                    .filter(movie => movie.original_language === 'en')
                    .slice(0, count)
                    .map(movie => ({ id: movie.id, type: 'movie' }));
            } catch (error) {
                console.error('Error fetching popular English movies:', error);
                return [];
            }
        }

        async function fetchTrendingTvShowIds(count) {
            try {
                const response = await fetch(`https://api.themoviedb.org/3/trending/tv/day?api_key=${apiKey}&language=en`);
                if (!response.ok) {
                    throw new Error('Failed to fetch trending TV shows');
                }
                const data = await response.json();
                return data.results
                    .filter(tvShow => tvShow.original_language === 'en')
                    .slice(0, count)
                    .map(tvShow => ({ id: tvShow.id, type: 'tv' }));
            } catch (error) {
                console.error('Error fetching trending TV shows:', error);
                return [];
            }
        }

        async function fetchMediaBackdrop(media) {
            try {
                const endpoint = media.type === 'movie' ? 'movie' : 'tv';
                const response = await fetch(`https://api.themoviedb.org/3/${endpoint}/${media.id}?api_key=${apiKey}&language=en`);
                if (!response.ok) {
                    throw new Error('Failed to fetch media details');
                }
                const data = await response.json();
                return `https://image.tmdb.org/t/p/original${data.backdrop_path}`;
            } catch (error) {
                console.error('Error fetching media backdrop:', error);
                return null;
            }
        }

        async function fetchMediaLogo(media) {
            try {
                const endpoint = media.type === 'movie' ? 'movie' : 'tv';
                const response = await fetch(`https://api.themoviedb.org/3/${endpoint}/${media.id}?api_key=${apiKey}&append_to_response=images`);
                if (!response.ok) {
                    throw new Error('Failed to fetch media details');
                }
                const data = await response.json();

                // Try to find the logo in Spanish first
                let logoPath = data.images.logos ? data.images.logos.find(logo => logo.iso_639_1 === 'es')?.file_path : null;

                // If not found, try to find the logo in English
                if (!logoPath) {
                    logoPath = data.images.logos ? data.images.logos.find(logo => logo.iso_639_1 === 'en')?.file_path : null;
                }

                // If a logo was found, return its path
                if (logoPath) {
                    return `https://image.tmdb.org/t/p/w500${logoPath}`;
                }

                // If no logo was found, return null
                return null;
            } catch (error) {
                console.error('Error fetching media logo:', error);
                return null;
            }
        }

        async function fetchMediaInfo(media) {
            try {
                const endpoint = media.type === 'movie' ? 'movie' : 'tv';
                const response = await fetch(`https://api.themoviedb.org/3/${endpoint}/${media.id}?api_key=${apiKey}&language=es`);
                if (!response.ok) {
                    throw new Error('Failed to fetch media details');
                }
                return response.json();
            } catch (error) {
                console.error('Error fetching media info:', error);
                return {};
            }
        }

        async function fetchMediaActors(media) {
            try {
                const endpoint = media.type === 'movie' ? 'movie' : 'tv';
                const response = await fetch(`https://api.themoviedb.org/3/${endpoint}/${media.id}/credits?api_key=${apiKey}`);
                if (!response.ok) {
                    throw new Error('Failed to fetch media actors');
                }
                const data = await response.json();
                return data.cast.slice(0, numberOfActors);
            } catch (error) {
                console.error('Error fetching media actors:', error);
                return [];
            }
        }

        function renderStarRating(voteAverage) {
            const fullStars = Math.floor(voteAverage / 2);
            const halfStar = voteAverage % 2 >= 1 ? 1 : 0;
            const emptyStars = 5 - fullStars - halfStar;

            let starsHtml = '';
            for (let i = 0; i < fullStars; i++) {
                starsHtml += '<span class="star">★</span>';
            }
            if (halfStar) {
                starsHtml += '<span class="star">☆</span>';
            }
            for (let i = 0; i < emptyStars; i++) {
                starsHtml += '<span class="star empty">☆</span>';
            }
            return starsHtml;
        }

        const MAX_DESCRIPTION_LENGTH = 250;

        async function updateContent() {
            const media = mediaIds[currentIndex];
            const backdropUrl = await fetchMediaBackdrop(media);
            const logoUrl = await fetchMediaLogo(media);
            const mediaInfo = await fetchMediaInfo(media);
            const actors = await fetchMediaActors(media);

            if (backdropUrl) document.getElementById('backdrop').src = backdropUrl;
            if (logoUrl) document.getElementById('logo').src = logoUrl; // Ensure correct logo assignment

            // Acorta el texto de la descripción si es muy largo
            let description = mediaInfo.overview || '';
            if (description.length > MAX_DESCRIPTION_LENGTH) {
                description = description.substring(0, MAX_DESCRIPTION_LENGTH) + '...';
            }

            document.getElementById('movie-info').innerHTML = `
                ${description}
            `;

            document.getElementById('rating-container').innerHTML = `
                ${renderStarRating(mediaInfo.vote_average)}
                <div class="vote-info">
                    <span class="based-on">Based On:</span>
                    <span class="vote-count">${mediaInfo.vote_count || 0} votes</span>
                </div>
            `;

            const actorsContainer = document.getElementById('actors-container');
            actorsContainer.innerHTML = '';
            actors.forEach(actor => {
                const actorElement = document.createElement('div');
                actorElement.className = 'actor';
                const actorWrapper = document.createElement('div');
                actorWrapper.className = 'actor-wrapper';
                const actorHeadshot = document.createElement('img');
                actorHeadshot.src = `https://image.tmdb.org/t/p/w185${actor.profile_path}`;
                actorHeadshot.className = 'headshot';
                const actorName = document.createElement('div');
                actorName.className = 'actor-name';
                actorName.textContent = actor.name;
                actorWrapper.appendChild(actorHeadshot);
                actorElement.appendChild(actorWrapper);
                actorElement.appendChild(actorName);
                actorsContainer.appendChild(actorElement);
            });

            currentIndex = (currentIndex + 1) % mediaIds.length;
        }

        document.addEventListener('DOMContentLoaded', async () => {
            const movies = await fetchPopularEnglishMovieIds(numberOfMovies);
            const tvShows = await fetchTrendingTvShowIds(numberOfTvShows);

            // Shuffle the movies and TV shows
            fisherYatesShuffle(movies);
            fisherYatesShuffle(tvShows);

            // Interleave movies and TV shows
            mediaIds = [];
            let i = 0, j = 0;
            while (i < movies.length || j < tvShows.length) {
                if (i < movies.length) mediaIds.push(movies[i++]);
                if (j < tvShows.length) mediaIds.push(tvShows[j++]);
            }

            if (mediaIds.length > 0) {
                updateContent();
                setInterval(updateContent, 6000); // Change media every 10 seconds
            } else {
                console.error('No media IDs available to display.');
            }
        });
    </script>
</body>
</html>
