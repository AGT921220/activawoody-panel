<!DOCTYPE html>
<html>
<head>
	<title>Image and Video Slideshow</title>
	<style>
		body {
			margin: 0;
			padding: 0;
		}
		img, video {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			object-fit: cover;
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
			background-color: white;
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
                slideElement.controls = false; // disable controls
                slideElement.muted = true; // mute video for autoplay
                slideElement.loop = false; // don't loop video
                slideElement.addEventListener('ended', function () {
                    setTimeout(showSlides, 0); // move to next slide when video ends
                });
            }
            slideshow.appendChild(slideElement);
            slideElement.style.opacity = "0";
        }
        showSlides();
    }

    var slideIndex = 0;

    function showSlides() {
        var i;
        var slides = slideshow.childNodes;
        for (i = 0; i < slides.length; i++) {
            if (slides[i].tagName == "IMG" || slides[i].tagName == "VIDEO") {
                slides[i].style.display = "none";
            }
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1
        }
        if (slides[slideIndex - 1].tagName == "IMG") {
            slides[slideIndex - 1].style.display = "block";
            fadeIn(slides[slideIndex - 1]);
            setTimeout(showSlides, 8000); // Change slide every 8 seconds for images
        } else if (slides[slideIndex - 1].tagName == "VIDEO") {
            slides[slideIndex - 1].style.display = "block";
            fadeIn(slides[slideIndex - 1]);
            slides[slideIndex - 1].play();
        }
    }

    function fadeIn(element) {
        var op = 0.1; // initial opacity
        element.style.opacity = op;
        var timer = setInterval(function () {
            if (op >= 1) {
                clearInterval(timer);
            }
            element.style.opacity = op;
            element.style.filter = 'alpha(opacity=' + op * 100 + ")";
            op += op * 0.1;
        }, 50);
    }
</script>

</body>
</html>
