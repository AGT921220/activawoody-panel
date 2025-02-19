<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poster de Filme em Tela Cheia</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: rgba(34, 34, 34, 0.5); /* Ajuste o valor alfa (0.5 para 50% de transparência) */
            backdrop-filter: blur(0px);
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            overflow: hidden;
        }

        /* Adicionar propriedades de transição para animação de deslizamento */
        #poster-container {
            transition: transform 0.5s ease-in-out;
            position: relative;
            border: 2px solid red; /* Adicionar borda vermelha */
        }

        #poster-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh;
        }

        #poster {
            width: 100vw; /* Defina a largura como 100% da largura da viewport */
            height: 100vh; /* Defina a altura como 100% da altura da viewport */
            object-fit: fixed; /* Mantenha a proporção e cubra a área inteira */
        }

        #movie-info {
            position: absolute;
            bottom: 20px;
            left: 10px;
            color: white;
            font-size: 1px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            max-width: 80%;
            background-color: rgba(0, 0, 0, 0.7); /* Cor de fundo com transparência */
            padding: 20px;
            border-radius: 15px; /* Cantos arredondados */
        }
    </style>
</head>
<body>
    <div id="poster-container">
        <img id="poster" src="../logo/bg.php" alt="Poster do Filme">
        <div id="movie-info">
            <h2 id="movie-title"></h2>
            <p id="movie-release-date"></p>
            <p id="movie-overview"></p>
        </div>
    </div>
    <script async>
        const apiKey = '59b62063232f5adc864355aa4fa216f2'; // Substitua 'YOUR_API_KEY' pelo seu API key real
        let currentIndex = 0;
        let movieIds = [];

        async function fetchPopularMovies() {
            try {
                const response = await fetch(`https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&sort_by=popularity.desc&language=pt-BR`);
                const data = await response.json();
                movieIds = data.results.map(movie => movie.id);
            } catch (error) {
                console.error('Falha ao buscar filmes populares:', error);
            }
        }

        async function updateMovieInfo() {
            if (movieIds.length === 0) {
                console.error('Nenhum ID de filme disponível.');
                return;
            }

            const movieId = movieIds[currentIndex];

            try {
                const response = await fetch(`https://api.themoviedb.org/3/movie/${movieId}?api_key=${apiKey}&language=pt-BR`);
                const data = await response.json();
                const posterContainer = document.getElementById('poster-container');
                const poster = document.getElementById('poster');
                const movieTitle = document.getElementById('movie-title');
                const movieReleaseDate = document.getElementById('movie-release-date');
                const movieOverview = document.getElementById('movie-overview');

                // Adiciona um efeito de deslizamento, traduzindo o contêiner para a esquerda
                posterContainer.style.transform = 'translateX(-100%)';

                // Pré-carrega a próxima imagem
                preloadNextImage(currentIndex);

                // Aguarda a animação ser concluída, depois atualiza o pôster e redefine a posição
                setTimeout(() => {
                    poster.src = `https://image.tmdb.org/t/p/original${data.poster_path}`;
                    movieTitle.textContent = data.title;
                    movieReleaseDate.textContent = `Data de Lançamento: ${data.release_date}`;
                    movieOverview.textContent = data.overview;
                    posterContainer.style.transform = 'translateX(0)';
                }, 500); // Ajuste a duração conforme necessário

                currentIndex = (currentIndex + 1) % movieIds.length;
            } catch (error) {
                console.error('Falha ao buscar detalhes do filme:', error);
            }
        }

        async function preloadNextImage(index) {
            const nextIndex = (index + 1) % movieIds.length;
            const nextMovieId = movieIds[nextIndex];

            try {
                const response = await fetch(`https://api.themoviedb.org/3/movie/${nextMovieId}?api_key=${apiKey}&language=pt-BR`);
                const data = await response.json();
                const nextImage = new Image();
                nextImage.src = `https://image.tmdb.org/t/p/original${data.poster_path}`;
            } catch (error) {
                console.error('Falha ao pré-carregar a próxima imagem:', error);
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
