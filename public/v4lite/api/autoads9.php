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
            justify-content: flex-start;
            align-items: center;
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
        }
        .movie-banner {
            display: flex;
            flex-direction: column;
            justify-content: space-between; 
            align-items: flex-start; 
            color: #fff;
            padding-left: 0; 
            position: relative;
            z-index: 2; 
            height: 100%;
        }

        #movie-poster-container {
            position: relative;
            width: auto;
            max-height: 100%; 
        }

        #movie-poster {
            width: 100%;
            height: 100%; 
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
    </style>

</head>
<body>
    <div class="movie-container" id="movie-container">
    <div class="overlay" id="viewport_capture">
        <div class="movie-banner">
            <div id="movie-poster-container">
                <!--<img id="movie-poster" src="" alt="Movie Poster">-->
            </div>
        </div> 
        <h1 id="movie-title" class="movie-info"></h1>
        <p  id="msubtitial" class="subtitial-info" ></p>
        <rating-bar class="ratingbar-location" id="rating-rtx"></rating-bar>
        <h1 id="overview-title" class="overview-location" ></h1>
        <h3 id="movie-overview" class="movie-info-overview"></h3>
    
    </div>
    
    </div>
    
    
     <script>
        const apiKey = '6b8e3eaa1a03ebb45642e9531d8a76d2'; // Replace with your TMDb API key
        let currentIndex = 0;
        let currentPage = 1; // Start with page 1
        let totalPageCount = 15;
        let movieIds = []; // Array to store movie IDs
        let nextImage = null; // Variable to store the next image

        // Function to fetch popular movie IDs for this week from TMDb API
        async function fetchPopularMovieIds_old() {
            const currentDate = new Date();
            const lastWeekDate = new Date(currentDate.getTime() - 7 * 24 * 60 * 60 * 1000); // Calculate date for last week
            const currentDateString = currentDate.toISOString().split('T')[0];
            const lastWeekDateString = lastWeekDate.toISOString().split('T')[0];

            try {
                const response = await fetch(`https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&primary_release_date.gte=${lastWeekDateString}&primary_release_date.lte=${currentDateString}&sort_by=popularity.desc`);
                const data = await response.json();
                movieIds = data.results.map(movie => movie.id);
            } catch (error) {
                console.error(error);
            }
        }
        
        async function fetchPopularMovieIds_old2() {
            const currentDate = new Date();
            const threeMonthsAgo = new Date(currentDate.getTime() - 90 * 24 * 60 * 60 * 1000); // Calculate date 3 months ago
            const currentDateString = currentDate.toISOString().split('T')[0];
            const threeMonthsAgoDateString = threeMonthsAgo.toISOString().split('T')[0];
        
            try {
                const response = await fetch(`https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&vote_average.gte=7&primary_release_date.gte=${threeMonthsAgoDateString}&primary_release_date.lte=${currentDateString}&sort_by=vote_average.desc`);
                const data = await response.json();
                movieIds = data.results.map(movie => movie.id);
            } catch (error) {
                console.error(error);
            }
        }
        
        async function fetchPopularMovieIds() {
            while (currentPage <= totalPageCount) {
                try {
                    const response = await fetch(`https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&page=${currentPage}&sort_by=popularity.desc`);
                    const data = await response.json();
                    
                    // Add movie IDs from the current page to the array
                    movieIds = [...movieIds, ...data.results.map(movie => movie.id)];
                    
                    currentPage++; // Move to the next page
                } catch (error) {
                    console.error(error);
                    break; // Break the loop in case of an error
                }
            }
        }

        // Function to preload the next image
        function preloadNextImage() {
            if (movieIds.length === 0) {
                console.error('Failed to fetch movie IDs.');
                return;
            }

            const nextIndex = (currentIndex + 1) % movieIds.length;
            const nextMovieId = movieIds[nextIndex];

            fetch(`https://api.themoviedb.org/3/movie/${nextMovieId}?api_key=${apiKey}`)
                .then((response) => response.json())
                .then((data) => {
                    // Preload the next image
                    nextImage = new Image();
                    nextImage.src = `https://image.tmdb.org/t/p/original${data.backdrop_path}`;
                })
                .catch((error) => console.error(error));
        }

        // Function to update movie information
        async function updateMovieInfo() {
            if (movieIds.length === 0) {
                console.error('Failed to fetch movie IDs.');
                return;
            }

            const movieId = movieIds[currentIndex];

            fetch(`https://api.themoviedb.org/3/movie/${movieId}?api_key=${apiKey}`)
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
    
    <style>
        .movie-info {
            position: fixed;
            top: 4.5vw;
            left: 01%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            color: white;
            font-size:4.5vw;
        }
        .subtitial-info{
            top: 11.8vw;
            left: 01%;
            position: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            color: white;
            font-size: 1.1vw;
        }
        
        .ratingbar-location{
            top: 14.8vw;
            left: 01%;
            position: fixed;
            font-size: 0.5vw;
        }
        

        .movie-info-larger {
            position: fixed;
            top: 7.5vw;
            left: 01%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            color: white;
            white-space: nowrap;
            font-size:2.8vw;
        }
        .movie-info-twoventryfive {
            position: fixed;
            top: 7.2vw;
            left: 01%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            color: white;
            white-space: nowrap;
            font-size:3.3vw;
        }
        .movie-info-larger-forty {
            position: fixed;
            top: 15%;
            left: 01%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            color: white;
            font-size: 2.4vw;
        }
        .movie-info-larger-thertyfive {
            position: fixed;
            top: 15%;
            left: 01%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            color: white;
            font-size: 2.6vw;
        }
        .movie-info-larger-fortyfive {
            position: fixed;
            top: 15%;
            left: 01%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            color: white;
            font-size: 1.9vw;
        }
        

        .movie-info-overview {
            text-align: left;
            position: fixed;
            top: 20.8vw;
            left: 01%;
            right: 25%;
            font-size: 0.1vm;
            color: white;;
        }
        .overview-location{
            top: 18.8vw;
            left: 01%;
            position: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            color: white;
            font-size: 1.4vw;
        }
    </style>
    
    <script>  
      customElements.define("rating-bar", class RatingBar extends HTMLElement {   
        constructor() {
          super();      
          this.attachShadow({ mode: "open" });
        }
        
        static get observedAttributes() {
          return ["value"];
        }
     
        attributeChangedCallback(name, old, current) {
          this[name] = Number(current ?? 1);
          this.render();
        }
    
    showStars(selector) {
      const stars = [];
      
      const wholeStars = Math.floor(this.value);
      const fractionalStar = this.value - wholeStars;
    
      for (let i = 0; i < this.maxValue; i++) {
        const star = document.createElement("span");
        star.textContent = "⭐";
        star.addEventListener("click", () => this.select(i));
        if (i < wholeStars) {
          star.classList.add("full");
        } else if (i === wholeStars) {
          star.classList.add("partial");
          star.style.width = `${fractionalStar * 100}%`;
        } else {
          // Empty star for the rest
          star.classList.add("off");
        }
        stars.push(star);
      }
  
          const parent = this.shadowRoot.querySelector(selector);
          stars.forEach(star => parent.appendChild(star));
          const text = document.createElement("span");
          
          if (this.value === Math.floor(this.value)) {
            text.textContent = `(${this.value})`;
          } else {
            text.textContent = `(${this.value.toFixed(1)})`;
          }
          
          parent.appendChild(text);
        }

    select(num) {
      console.log("Select ", num);
      this.value = num;
      this.render();
    }
  
    connectedCallback() {
      this.maxValue = Number(this.getAttribute("max-value") ?? 10);      
      this.value = Number(this.getAttribute("value") ?? 0);
      this.render();
    }
    
    render() {
      this.shadowRoot.innerHTML = `
        <style>
          span { font-size: 15px; 
          color: white;
          }
          .off { filter: grayscale(1); }
          span:hover {
            filter: hue-rotate(160deg);
            cursor: pointer;
          }
        </style>
        <div class="rating"></div>
      `;
      this.showStars(".rating");
    }
  });
  
</script>

</body>
</html>