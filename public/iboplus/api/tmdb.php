<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Slider</title>
    <link rel="stylesheet" type="text/css" href="betstyle.css">
</head>
<body>
    <div class="container">
        <!-- Your slider content here -->
    </div>

    <script>
    function adjustBackgroundSize() {
    var container = document.querySelector('.container');
    var imgAspectRatio = 3840 / 2160; // Aspect ratio of your image

    var containerAspectRatio = container.offsetWidth / container.offsetHeight;

    if (containerAspectRatio > imgAspectRatio) {
        container.style.backgroundSize = '100% auto';
    } else {
        container.style.backgroundSize = 'auto 100%';
    }
}

// Initial adjustment
adjustBackgroundSize();

// Adjust on window resize
window.addEventListener('resize', adjustBackgroundSize);
    </script>

    <script type="text/javascript" src="movies_script.js"></script>
</body>
</html>
