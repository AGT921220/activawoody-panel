<?php
$jsonFile = '../a/rtx/data.json'; // Replace with the actual path to your JSON file

// Read the JSON file contents
$jsonData = file_get_contents($jsonFile);

// Decode the JSON data
$data = json_decode($jsonData, true);

// Check the value of the "option" field
if ($data['option'] == 'option1') {
    // Redirect to option1.php
    header('Location: gd2.html');
    exit;
} elseif ($data['option'] == 'option2') {
    // Redirect to option2.php
    header('Location: video.php');
    exit;
} elseif ($data['option'] == 'option3') {
    // Redirect to option2.php
    header('Location: image.php');
    exit;
} else {
    // Invalid option or no option provided
    echo 'Invalid option.';
}
?>
