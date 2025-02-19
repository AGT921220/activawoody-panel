<?php
        $jsonFile = 'filenames.json';
        
        $jsonData = file_get_contents($jsonFile);
        
        $imageData = json_decode($jsonData, true);
        
        $filename = $imageData[0]['ImageName'];
        
        $parsedUrl = parse_url($_SERVER['REQUEST_URI']);
        $currentPath = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/';
        
        $imageFile = "$filename";

header("Content-Type: image/jpeg");
header('Location: '.$imageFile);
exit;
?>
