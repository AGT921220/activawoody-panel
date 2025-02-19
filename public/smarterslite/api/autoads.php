<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmes em Alta</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: #222;
            backdrop-filter: blur(0px);
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            overflow: hidden;
        }

        #movie-container {
            opacity: 0;
            transition: opacity 0.2s ease-in-out;
            width: 60%;
            padding: 20px;
            position: fixed;
            bottom: 0;
            right: 0;
        }

        #movie-poster-container {
            width: 100%;
            max-height: 100%;
            margin-bottom: 20px;
        }

        #movie-poster {
            width: 100%;
            height: 100%;
            -webkit-mask-image: -webkit-gradient(linear, right top, left top, from(rgba(0,0,0,0)), to(rgba(0,0,0,1)));
        }

        .overlay {
            position: relative;
            width: 100%;
            height: 100%;
            background: transparent;
            z-index: 1;
        }

        .movie-details {
            color: #fff;
        }

        .movie-info {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .subtitial-info {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .ratingbar-location {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .overview-location {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .movie-info-overview {
            font-size: 16px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="movie-container" id="movie-container">
        <div class="overlay" id="viewport_capture">
            <div id="movie-poster-container">
                <!-- Adicione a tag de imagem do pôster do filme aqui -->
            </div>
            <div class="movie-details">
                <h1 id="movie-title" class="movie-info"></h1>
                <p id="msubtitial" class="subtitial-info"></p>
                <rating-bar class="ratingbar-location" id="rating-rtx"></rating-bar>
                <h1 id="overview-title" class="overview-location"></h1>
                <h3 id="movie-overview" class="movie-info-overview"></h3>
            </div>
        </div>
    </div>

    <script>
        const apiKey = '042ca3561d20c34adcc98489df9cc4b2'; // Replace with your TMDb API key
        let currentIndex = 0;
        let currentPage = 1; // Start with page 1
        let totalPageCount = 15;
        let movieIds = []; // Array to store movie IDs
        let nextImage = null; // Variable to store the next image

        // Function to fetch popular movie IDs for this week from TMDb API
async function fetchPopularMovieIds_old() {
    const currentDate = new Date();
    const lastWeekDate = new Date(currentDate.getTime() - 7 * 24 * 60 * 60 * 1000); 
    const currentDateString = currentDate.toISOString().split('T')[0];
    const lastWeekDateString = lastWeekDate.toISOString().split('T')[0];

    try {
        const response = await fetch(`https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&primary_release_date.gte=${lastWeekDateString}&primary_release_date.lte=${currentDateString}&sort_by=popularity.desc&language=pt-BR`);
        const data = await response.json();
        movieIds = data.results.map(movie => movie.id);
    } catch (error) {
        console.error(error);
    }
}

        
function preloadNextImage() {
    if (movieIds.length === 0) {
        console.error('Falha ao obter IDs dos filmes.');
        return;
    }

    const nextIndex = (currentIndex + 1) % movieIds.length;
    const nextMovieId = movieIds[nextIndex];

    fetch(`https://api.themoviedb.org/3/movie/${nextMovieId}?api_key=${apiKey}&language=pt-BR`)
        .then((response) => response.json())
        .then((data) => {
           
            nextImage = new Image();
            nextImage.src = `https://image.tmdb.org/t/p/original${data.backdrop_path}`;
        })
        .catch((error) => console.error(error));
}
async function fetchPopularMovieIds() {
    while (currentPage <= totalPageCount) {
        try {
            const response = await fetch(`https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&page=${currentPage}&sort_by=popularity.desc&language=pt-BR`);
            const data = await response.json();
            
            
            movieIds = [...movieIds, ...data.results.map(movie => movie.id)];
            
            currentPage++; 
        } catch (error) {
            console.error(error);
            break; 
        }
    }
}


        // Function to preload the next image
function preloadNextImage() {
    if (movieIds.length === 0) {
        console.error('Falha ao obter IDs dos filmes.');
        return;
    }

    const nextIndex = (currentIndex + 1) % movieIds.length;
    const nextMovieId = movieIds[nextIndex];

    fetch(`https://api.themoviedb.org/3/movie/${nextMovieId}?api_key=${apiKey}&language=pt-BR`)
        .then((response) => response.json())
        .then((data) => {
            // Pré-carregue a próxima imagem
            nextImage = new Image();
            nextImage.src = `https://image.tmdb.org/t/p/original${data.backdrop_path}`;
        })
        .catch((error) => console.error(error));
}

        // Function to update movie information
async function updateMovieInfo() {
    if (movieIds.length === 0) {
        console.error('Falha ao obter IDs dos filmes.');
        return;
    }

    const movieId = movieIds[currentIndex];

    fetch(`https://api.themoviedb.org/3/movie/${movieId}?api_key=${apiKey}&language=pt-BR`)
        .then((response) => response.json())
        .then((data) => {
            const movieContainer = document.getElementById('movie-container');
            const movieContainer2 = document.getElementById('viewport_capture');

            movieContainer.style.opacity = 0;


                    setTimeout(() => {
                        preloadNextImage();
                        
                        const moviePoster = document.getElementById('movie-poster');
                        const movieTitle = document.getElementById('movie-title');
                        const mcategory = document.getElementById('msubtitial');
                        const movieOverview = document.getElementById('movie-overview');
                        const rtxratingbar = document.getElementById('rating-rtx');

                        // Update your DOM elements here
                        const posterPath = `https://image.tmdb.org/t/p/original${data.backdrop_path}`;
                        document.body.style.backgroundImage = `url('${posterPath}')`;
                        /*moviePoster.src = `https://image.tmdb.org/t/p/original${data.poster_path}`;*/

                        /****Movies tital section**/
                        var movieTitleh = document.getElementById("movie-title");
                        const releaseDate = data.release_date;
                        const releaseYear = new Date(releaseDate).getFullYear();
                        var maintital = data.title + ` (`+releaseYear+`)`;
                        
                        if(maintital.length > 45){
                            movieTitleh.classList.remove('movie-info-larger-forty');
                            movieTitleh.classList.remove('movie-info-larger-thertyfive');
                            movieTitleh.classList.remove('movie-info-larger');
                            movieTitleh.classList.remove('movie-info-twoventryfive');
                            movieTitleh.classList.remove('movie-info');
                            
                             movieTitleh.classList.add("movie-info-larger-fortyfive");
                        }else if (maintital.length > 40){
                            movieTitleh.classList.remove('movie-info-larger-thertyfive');
                            movieTitleh.classList.remove('movie-info-larger');
                            movieTitleh.classList.remove('movie-info-twoventryfive');
                            movieTitleh.classList.remove('movie-info');
                            movieTitleh.classList.remove("movie-info-larger-fortyfive");
                            movieTitleh.classList.add("movie-info-larger-forty");
                        }else if (maintital.length > 35){
                            movieTitleh.classList.remove('movie-info-larger-forty');
                            movieTitleh.classList.remove('movie-info-larger');
                            movieTitleh.classList.remove('movie-info-twoventryfive');
                            movieTitleh.classList.remove('movie-info');
                            movieTitleh.classList.remove("movie-info-larger-fortyfive");
                            movieTitleh.classList.add("movie-info-larger-thertyfive");
                        }else if (maintital.length > 30){
                            movieTitleh.classList.remove('movie-info-larger-forty');
                            movieTitleh.classList.remove('movie-info-larger-thertyfive');
                            movieTitleh.classList.remove('movie-info-twoventryfive');
                            movieTitleh.classList.remove('movie-info');
                            movieTitleh.classList.remove("movie-info-larger-fortyfive");
                            movieTitleh.classList.add("movie-info-larger");
                        }else if (maintital.length >= 25){
                            movieTitleh.classList.remove('movie-info-larger-forty');
                            movieTitleh.classList.remove('movie-info-larger-thertyfive');
                            movieTitleh.classList.remove('movie-info-larger');
                            movieTitleh.classList.remove('movie-info');
                            movieTitleh.classList.remove("movie-info-larger-fortyfive");
                            movieTitleh.classList.add("movie-info-twoventryfive");
                        }else{
                            movieTitleh.classList.remove('movie-info-larger-forty');
                            movieTitleh.classList.remove('movie-info-larger-thertyfive');
                            movieTitleh.classList.remove('movie-info-larger');
                            movieTitleh.classList.remove('movie-info-twoventryfive');
                            movieTitleh.classList.remove("movie-info-larger-fortyfive");
                            movieTitleh.classList.add("movie-info");
                        }
                        movieTitle.innerText = maintital;
                        /****Movies tital section**/

                        // Update movie subtitial
                        const releaseDate_full = data.release_date;
                        const genresArray = data.genres.map(genre => `🎬 ${genre.name}`).join(' ');
                        const origin_country = data.production_companies.map(production_companies => `${production_companies.origin_country}`).join(' ');
                        const duration = data.runtime;
                        const hours = Math.floor(duration / 60) + 'h';
                        const minutes = duration % 60 + 'm';
                        const fullSubtitial = ` 📀 ` + releaseDate_full + ` (${origin_country}) ` + ` | ` + genresArray + ` | ` + '🕝 ' + hours + ' ' + minutes;
                        mcategory.innerText = fullSubtitial;

                        const mrating = data.vote_average;
                        rtxratingbar.setAttribute("value", mrating);

                       // movieOverview.innerText = data.overview;

                        movieContainer.style.opacity = 1;
            }, 200);

                    currentIndex = (currentIndex + 1) % movieIds.length; // Increment index in a loop

                    // Preload the next image after updating the current movie
                    preloadNextImage();
                })
                .catch((error) => console.error(error));
        }

        // Call the fetchPopularMovieIds function initially
        fetchPopularMovieIds().then(() => {
            // Preload the first image
            preloadNextImage();
            // Set an initial timeout for the first update
            setTimeout(updateMovieInfo, 2000);
            // Set the interval for subsequent updates
            setInterval(updateMovieInfo, 9000);
        });
    </script>
</body>
</html>
