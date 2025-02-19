<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connect to the SQLite database
$db = new SQLite3('./.db.db');

// Retrieve image URLs from the database
$query = "SELECT image_url FROM ads";
$results = $db->query($query);

// Store image URLs in an array
$imageUrls = [];
while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    $imageUrls[] = $row['image_url'];
}

// Generate the HTML code for the image slideshow
$html = '<html><head><style>body {margin: 0; background-color: transparent;}
.slideshow-container {position: relative; width: 100%; height: 100%; background-color: transparent;}
.slideshow-image {position: absolute; top: 0; left: 0; opacity: 0; transition: opacity 0.5s ease; width: 100%; height: 100%; object-fit: fill;}
.slideshow-image.active {opacity: 1;}
.indicator-container {position: absolute; bottom: 10px; left: 50%; transform: translateX(-50%); display: flex; justify-content: center; align-items: center;}
.indicator {width: 10px; height: 10px; border-radius: 50%; background-color: gray; margin: 0 5px;}
.indicator.active {background-color: white;}</style></head><body>';
$html .= '<div class="slideshow-container">';
foreach ($imageUrls as $index => $imageUrl) {
    $html .= "<img class=\"slideshow-image" . ($index === 0 ? ' active' : '') . "\" src=\"$imageUrl\">";
}
$html .= '<div class="indicator-container">';
foreach ($imageUrls as $index => $imageUrl) {
    $html .= "<div class=\"indicator" . ($index === 0 ? ' active' : '') . "\"></div>";
}
$html .= '</div>';
$html .= '</div>';
$html .= '<script>
    var slideshowImages = Array.from(document.getElementsByClassName("slideshow-image"));
    var indicators = Array.from(document.getElementsByClassName("indicator"));
    var currentSlide = 0;
    var transitionInterval = 4000; // Time in milliseconds, change as needed

    setInterval(function() {
        currentSlide = (currentSlide + 1) % slideshowImages.length;
        updateSlide(currentSlide);
    }, transitionInterval);

    function updateSlide(slideIndex) {
        slideshowImages.forEach(function(image) {
            image.style.opacity = "0";
            image.style.pointerEvents = "none";
        });

        indicators.forEach(function(indicator) {
            indicator.classList.remove("active");
        });

        slideshowImages[slideIndex].style.opacity = "1";
        slideshowImages[slideIndex].style.pointerEvents = "auto";
        indicators[slideIndex].classList.add("active");
    }
</script>';
$html .= '</body></html>';

// Output the HTML code
echo $html;
?>
