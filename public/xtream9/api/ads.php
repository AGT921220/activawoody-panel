<?php
// Configuración de la base de datos SQLite
$db_path = './ads.db';
try {
    $db = new SQLite3($db_path);
    $table_name = 'ads';
    // Obtener todos los anuncios
    $res = $db->query("SELECT * FROM $table_name ORDER BY created_on DESC");
    $ads = array();
    while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
        $extension = pathinfo($row['url'], PATHINFO_EXTENSION);
        $ads[] = array(
            "AdUrl" => $row['url'],
            "Title" => $row['title'],
            "Type" => in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']) ? 'image' : 'video'
        );
    }
    $db->close();
} catch (Exception $e) {
    // Manejo silencioso del error
    $ads = array();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Visualización de Anuncios</title>
    <style>
    body {
        margin: 0;
        padding: 0;
        background-color: rgba(255, 255, 255, 0.5);
    }
    #slideshow {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
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
    }
    </style>
</head>
<body>
<div id="slideshow"></div>
<script>
    var slideshow = document.getElementById("slideshow");
    var mediaUrls = <?php echo json_encode($ads); ?>;
    var slideIndex = 0;
    function loadSlides() {
        for (var i = 0; i < mediaUrls.length; i++) {
            var slideElement;
            if (mediaUrls[i].Type == "image") {
                slideElement = document.createElement("img");
                slideElement.src = mediaUrls[i].AdUrl;
                slideElement.alt = mediaUrls[i].Title;
            } else if (mediaUrls[i].Type == "video") {
                slideElement = document.createElement("video");
                slideElement.src = mediaUrls[i].AdUrl;
                slideElement.autoplay = true;
                slideElement.controls = false;
                slideElement.muted = true;
                slideElement.loop = false;
                slideElement.addEventListener('ended', nextSlide);
            }
            slideshow.appendChild(slideElement);
        }
        showSlides();
    }
    function showSlides() {
        var slides = slideshow.childNodes;
        for (var i = 0; i < slides.length; i++) {
            slides[i].style.opacity = 0;
        }
        slides[slideIndex].style.opacity = 1;
        if (slides[slideIndex].tagName === "VIDEO") {
            slides[slideIndex].play();
        } else {
            setTimeout(nextSlide, 6000);
        }
    }
    function nextSlide() {
        slideIndex++;
        if (slideIndex >= slideshow.childNodes.length) {
            slideIndex = 0;
        }
        showSlides();
    }
    loadSlides();
</script>
</body>
</html>