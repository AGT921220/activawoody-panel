<?php
// Relative path to the JSON file from the api/ directory
$jsonFilePath = '../includes/ad_type.json';

// Check if the JSON file exists and is readable
if (file_exists($jsonFilePath) && is_readable($jsonFilePath)) {
    // Read the JSON file content
    $jsonContent = file_get_contents($jsonFilePath);

    // Decode the JSON content
    $jsonData = json_decode($jsonContent, true);

    // Retrieve the ad type value
    $fileToLoad = $jsonData['adType'] ?? 'manual'; // Default to 'manual' if not set

    // Including the respective file based on the value
    if ($fileToLoad === 'manual') {
        include('./manual_ads.php'); // Adjust path as needed
    } else if ($fileToLoad === 'tmdb') {
        include('./tmdb.php'); // Adjust path as needed
    } else {
        echo "No valid ad type found.";
    }
} else {
    echo "Unable to read ad type file.";
}
?>
