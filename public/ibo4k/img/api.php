</html>
<!DOCTYPE html>
<html>
<head>
    <title>Full Page Image Example</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        
        img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <?php
        // Path to the JSON file
        $jsonFile = '../img/filenames.json';
        
        // Read the JSON file contents
        $jsonData = file_get_contents($jsonFile);
        
        // Decode the JSON data
        $imageData = json_decode($jsonData, true);
        
        // Extract the filename
        $filename = $imageData[0]['ImageName'];
        
        // Get the current path
        $parsedUrl = parse_url($_SERVER['REQUEST_URI']);
        $currentPath = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/';
        
    ?>


    <img src="<?php echo $currentPath . $filename; ?>" alt="Image">
</body>
</html>

