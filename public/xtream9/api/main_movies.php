<?php
// Read the JSON file
$jsonData = file_get_contents('page.json');

if ($jsonData === false) {
    // Handle file read error
    die('Error reading page.json');
}

// Decode the JSON data
$data = json_decode($jsonData, true);

if ($data === null) {
    // Handle JSON decoding error
    die('Error decoding page.json');
}

// Check if the selected_option exists in the decoded JSON data
if (isset($data['app']['selected_option'])) {
    $selectedOption = $data['app']['selected_option'];

    // Perform the redirection using the value of selected_option
    session_destroy();
    setcookie('auth', '');

    // Redirect to the selected option
    header("Location: $selectedOption");
    exit;
} else {
    // Handle missing selected_option
    die('Selected option not found in page.json');
}
?>
