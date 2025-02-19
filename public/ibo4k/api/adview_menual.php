<!DOCTYPE html>
<html>
<head>
    <title>Image and Video Slideshow</title>
    <style>
    body {
        margin: 0;
        padding: 0;
        background-color: rgba(255, 255, 255, 0.5); /* Adjust the alpha value (0.5) for the desired transparency */
    }
    img, video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 0;
        opacity: 0; /* Initial opacity set to 0 for fade effect */
        transition: opacity 2s ease-in-out; /* Transition for opacity */
    }
    .slide-indicator {
        display: inline-block;
        width: 10px;
        height: 10px;
        background-color: gray;
        border-radius: 50%;
        margin: 5px;
        cursor: pointer;
    }
    .active {
        background-color: : rgba(255, 255, 255, 0.5);
    }
</style>

</head>
<body>
<div id="slideshow"></div>
<div id="slide-indicators"></div>

<script>
    var slideshow = document.getElementById("slideshow");

    fetch('ads.php')
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
                        slideIndex = 0; // Reset to the first slide when reaching the end
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
        slides[prevIndex].style.opacity = 0; // Set previous slide's opacity to 0

        slides[slideIndex].style.opacity = 1; // Set current slide's opacity to 1

        slideIndex++;
        if (slideIndex >= slides.length) {
            slideIndex = 0; // Reset to the first slide when reaching the end
        }

        setTimeout(showSlides, 8000); // Continue to the next slide after a delay
    }
</script>
</body>
</html>
