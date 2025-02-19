<?php
// Specify the filename of the image you want to redirect to
$jsonFile = '../a/rtx/logo_filenames.json';
        
        // Read the JSON file contents
        $jsonData = file_get_contents($jsonFile);
        
        // Decode the JSON data
        $imageData = json_decode($jsonData, true);
        
        // Extract the filename
        $filename = $imageData[0]['ImageName'];
        
$imageFile = "../rtx/logo/" . "$filename";


// Set the appropriate Content-Type header for the image
header("Content-Type: image/jpeg");

// Read the image file and output it to the browser
//readfile($imageFile);
header('Location: '.$imageFile);
exit;
?>
