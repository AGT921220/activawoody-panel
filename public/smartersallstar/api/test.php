<?php
ini_set("display_errors", 0);
require_once "../includes/functions.php";

$db = new SQLite3("./.db.db");
$resT = $db->querySingle("SELECT type FROM type WHERE id=1");

if ($resT == "rt") {
    rt_();
} else if ($resT == "ua") {
    ua_();
}

function ua_() {
    error_reporting(0);
    $db = new SQLite3('./.db.db');
    $note = $db->query('SELECT * FROM ads');

    while ($notes = $note->fetchArray(SQLITE3_ASSOC)) {
        $path[] = array('path' => $notes['path']);
    }

    if ($path) {
        $data['result'] = 'success';
        $data['data']['vertical']['adds'] = $path;
        $data['data']['vertical']['count'] = count($data['data']['vertical']['adds']);
    } else {
        $data['result'] = 'error';
        $data['msg'] = 'No data found in the database';
    }

    echo json_encode($data);
    die();
}

function rt_() {
// API endpoint URL
$api_url = "https://b3inc.xyz/test/rot/api/adpage.php";

// Initialize a new cURL resource
$ch = curl_init();

// Set the cURL options
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Execute the cURL request
$response = curl_exec($ch);

// Close the cURL resource
curl_close($ch);

// Decode the JSON response
$data = json_decode($response, true);

// Output the JSON response
header('Content-Type: application/json');
echo json_encode($data);
    die();
}
?>
