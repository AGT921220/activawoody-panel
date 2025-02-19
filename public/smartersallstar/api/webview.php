<?php
// Generate the HTML code for the image slideshow
$html = '<html><head><style>body {margin: 0; background-color: transparent;}
.slideshow-container {position: relative; width: 100%; height: 100%; background-color: transparent;}
.slideshow-image {position: absolute; top: 0; left: 0; opacity: 0; transition: opacity 0.5s ease; width: 100%; height: 100%; object-fit: fill;}
.slideshow-image.active {opacity: 1;}
.indicator-container {position: absolute; bottom: 10px; left: 50%; transform: translateX(-50%); display: flex; justify-content: center; align-items: center;}
.indicator {width: 10px; height: 10px; border-radius: 50%; background-color: gray; margin: 0 5px;}
.indicator.active {background-color: white;}</style></head><body>';
$html .= '<div class="slideshow-container"></div>';
$html .= '<div class="indicator-container"></div>';
$html .= '</div>';
$html .= '<script>
    var slideshowContainer = document.querySelector(".slideshow-container");
    var indicatorContainer = document.querySelector(".indicator-container");
    var currentSlide = 0;
    var transitionInterval = 4000; // Time in milliseconds, change as needed

    setInterval(function() {
        updateSlides();
    }, transitionInterval);

    function updateSlides() {
        // Retrieve image URLs from adpage.php using AJAX
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                var updatedImageUrls = response.data.vertical.adds.map(function(add) {
                    return add.path;
                });

                var slideshowImages = "";
                var indicators = "";

                updatedImageUrls.forEach(function(updatedImageUrl, index) {
    slideshowImages += "<img class=\"slideshow-image" + (index === 0 ? " active" : "") + "\" src=\"" + updatedImageUrl + "\">";
    indicators += "<div class=\"indicator" + (index === 0 ? " active" : "") + "\"></div>";
});

                slideshowContainer.innerHTML = slideshowImages;
                indicatorContainer.innerHTML = indicators;

                var slideshowImagesElements = Array.from(slideshowContainer.getElementsByClassName("slideshow-image"));
                var indicatorsElements = Array.from(indicatorContainer.getElementsByClassName("indicator"));

                slideshowImagesElements.forEach(function(image) {
                    image.style.opacity = "0";
                    image.style.pointerEvents = "none";
                });

                indicatorsElements.forEach(function(indicator) {
                    indicator.classList.remove("active");
                });

                slideshowImagesElements[currentSlide].style.opacity = "1";
                slideshowImagesElements[currentSlide].style.pointerEvents = "auto";
                indicatorsElements[currentSlide].classList.add("active");

                currentSlide = (currentSlide + 1) % slideshowImagesElements.length;
            }
        };

        xhr.open("GET", "adpage.php", true);
        xhr.send();
    }
</script>';
$html .= '</body></html>';

// Output the HTML code
echo $html;
?>
