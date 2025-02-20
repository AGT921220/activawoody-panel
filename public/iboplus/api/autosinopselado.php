<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full-Screen Movie Banner</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-end; /* Alinhado na parte inferior */
            min-height: 100vh;
            background-color: #222;
            backdrop-filter: blur(0px); 
            background-repeat: no-repeat;
            background-size: cover; 
            position: relative;
            overflow: hidden; 
            color: white;
        }
        .movie-container {
            opacity: 0; 
            transition: opacity 0.2s ease-in-out; 
            max-width: 80%;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding-right: 20px; /* Espaço para o balão */
        }
        .movie-banner {
            display: flex;
            flex-direction: column;
            justify-content: center; 
            align-items: center; 
            color: #fff;
            position: relative;
            z-index: 2; 
        }

        #movie-poster-container {
            position: relative;
            width: auto;
            max-width: 100%; 
        }

        #movie-poster {
            width: 100%;
            height: auto; 
            -webkit-mask-image: -webkit-gradient(linear, right top, left top, from(rgba(0,0,0,0)), to(rgba(0,0,0,1))); 
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(0, 0, 0, 1), transparent);
            z-index: 1; 
        }
        
        .movie-info {
            position: fixed;
            top: 0vw; /* Posicionado na parte inferior */
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            color: white;
            font-size: 2.5vw;
        }
        .subtitial-info {
            font-size: 1.5vw;
            bottom: -15vw; /* Posicionado na parte inferior */
            max-width: 300px; /* Largura máxima do balão */
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            text-align: left;
            position: relative;
            margin-right: -700px; /* Espaço entre o balão e o cartaz do filme */
        }
        .subtitial-info::before {
            content: '';
            position: absolute;
            top: 50%;
            right: -200px; /* Posição do balão */
            transform: translateY(-50%);
            border-style: solid;
            border-width: 10px 0 10px 10px;
            border-color: transparent transparent transparent rgba(0, 0, 0, 0.7);
        }
        .movie-info-overview {
            text-align: center;
            font-size: 1.3vw;
            margin-top: 2vw;
            max-width: 80%;
            line-height: 1.5;
            margin-left: auto;
            margin-right: auto;
        }
    </style>

</head>
<body>
    <div class="movie-container" id="movie-container">
    <div class="overlay" id="viewport_capture">
        <div class="movie-banner">
            <div id="movie-poster-container">
                
            </div>
            <h1 id="movie-title" class="movie-info"></h1>
            <p  id="msubtitial" class="subtitial-info" ></p>
        </div> 
    </div>
    
    </div>
    
    
     <script>
        const apiKey = '6b8e3eaa1a03ebb45642e9531d8a76d2'; // Replace with your TMDb API key
        let currentIndex = 0;
        let currentPage = 1; // Start with page 1
        let totalPageCount = 15;
        let movieIds = []; // Array to store movie IDs
        let nextImage = null;

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

            movieContainer.style.opacity = 0;

            setTimeout(() => {
                preloadNextImage();
                
                const movieTitle = document.getElementById('movie-title');
                const mcategory = document.getElementById('msubtitial');

                const posterPath = `https://image.tmdb.org/t/p/original${data.backdrop_path}`;
                document.body.style.backgroundImage = `url('${posterPath}')`;

                movieTitle.innerText = data.title;

                mcategory.innerText = data.overview;

                movieContainer.style.opacity = 1;
            }, 200);

            currentIndex = (currentIndex + 1) % movieIds.length;
            preloadNextImage();
        })
        .catch((error) => console.error(error));
}

fetchPopularMovieIds().then(() => {
    preloadNextImage();
    setTimeout(updateMovieInfo, 2000);
    setInterval(updateMovieInfo, 9000);
});
    </script>
</body>
</html>
