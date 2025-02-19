<!DOCTYPE html>
<html>
<head>
    <title>Image and Video Slideshow</title>
    <style>
    body {
        margin: 0;
        padding: 0;
        background-color: #00000000; 
    }
    img, video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 0;
        opacity: 0; 
        transition: opacity 2s ease-in-out; 
        border-radius: 20px; 
    }
    .slide-indicator {
        display: inline-block;
        width: 10px;
        height: 10px;
        background-color: red;
        border-radius: 50%;
        margin: 5px;
        cursor: pointer;
    }
    .active {
        background-color: rgba(255, 255, 255, 0.5);
    }
</style>

</head>
<body>
<div id="slideshow"></div>
<div id="slide-indicators"></div>

<script>
    var slideshow = document.getElementById("slideshow");

    fetch('getads.php')
        .then(response => response.json())
        .then(data => {
            var mediaUrls = data.map(obj => obj.AdUrl);
            loadSlides(mediaUrls);
        });

    function getMediaType(url) {
        var extension = url.split('.').pop();
        if (extension == "jpg" || extension == "jpeg" || extension == "png" || extension == "gif") {
            return "image";
        } else if (extension == "mp4") {
            return "video";
        } else {
            return null;
        }
    }

    var slideIndex = 0;

    function loadSlides(mediaUrls) {
        var i;
        for (i = 0; i < mediaUrls.length; i++) {
            var mediaType = getMediaType(mediaUrls[i]);
            var slideElement;
            if (mediaType == "image") {
                slideElement = document.createElement("img");
                slideElement.src = mediaUrls[i];
            } else if (mediaType == "video") {
                slideElement = document.createElement("video");
                slideElement.src = mediaUrls[i];
                slideElement.autoplay = true;
                slideElement.controls = false;
                slideElement.muted = true;
                slideElement.loop = false;
                slideElement.addEventListener('ended', function () {
                    slideIndex++;
                    if (slideIndex >= mediaUrls.length) {
                        slideIndex = 0; 
                    }
                    showSlides();
                });
            }
            slideshow.appendChild(slideElement);
        }
        showSlides();
    }

    function showSlides() {
        var slides = slideshow.childNodes;
        var prevIndex = slideIndex - 1;
        if (prevIndex < 0) {
            prevIndex = slides.length - 1;
        }
        slides[prevIndex].style.opacity = 0; 

        slides[slideIndex].style.opacity = 1; 

        slideIndex++;
        if (slideIndex >= slides.length) {
            slideIndex = 0;
        }

        setTimeout(showSlides, 8000); 
    }
</script>
</body>
</html>
