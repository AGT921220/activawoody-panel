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
    // Use AJAX to load and execute the PHP file
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'movies.php', true);
    xhr.send();
    </script>

    <script type="text/javascript" src="movies_script.js"></script>
</body>
</html>
