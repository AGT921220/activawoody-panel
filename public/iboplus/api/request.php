<?php
// Retrieve the data from the GET request
$mac = $_GET['mac'];
$devID = $_GET['devID'];
$deviceName = $_GET['deviceName'];

// Create an associative array with the retrieved data
$data = array(
    'mac' => $mac,
    'devID' => $devID,
    'deviceName' => $deviceName
);

// Define the path and filename for the JSON file
$filename = '../a/rtx/request.json';

// Check if the JSON file exists
if (file_exists($filename)) {
    // Read the existing JSON data from the file
    $jsonData = file_get_contents($filename);

    // Decode the JSON data into an associative array
    $existingData = json_decode($jsonData, true);

    // Add the new record to the existing data
    $existingData[] = $data;

    // Convert the updated data back to JSON format
    $jsonData = json_encode($existingData);
} else {
    // If the file doesn't exist, create a new JSON array
    $jsonData = json_encode([$data]);
}

// Save the JSON data to the file
file_put_contents($filename, $jsonData);

// Output a success message
echo 'Data send successfully';
?>
