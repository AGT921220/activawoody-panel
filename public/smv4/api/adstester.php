<?php

// Define the URL and the POST data
$url = "https://app.smarterspanel.com/api";
$postData = array(
    "a" => "FwvuSRK7kODy1Wm",
    "s" => "6BuW8O7drqw0YmTMX43aLjNKyHDEPFgCs5zGnSUI1vQ2icxRpk",
    "r" => "1897147",
    "d" => "2024-06",
    "sc" => "cff1efc6ca7e8f64467b244bb22d7a5c",
    "action" => "get-announcements",
    "deviceid" => "dcdc1e54-4dac-42b8-9398-76cf6c32fd66"
);

// Encode the POST data to JSON
$jsonData = json_encode($postData);

// Construct the URL with query parameters
$urlWithParams = $url . '?' . http_build_query($postData);

// Initialize cURL
$ch = curl_init($urlWithParams);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json; charset=UTF-8',
    'Accept-Encoding: gzip',
    'User-Agent: okhttp/4.3.1'
));
curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Set a timeout
curl_setopt($ch, CURLINFO_HEADER_OUT, true); // Enable request headers to be included in the output

// Execute the request
$response = curl_exec($ch);

// Check for errors
if ($response === false) {
    $error = curl_error($ch);
    curl_close($ch);
    $output = array(
        'status' => 'error',
        'message' => $error
    );
    echo json_encode($output);
    exit;
}

// Get the HTTP status code
$httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Get the content encoding from the response headers
$encoding = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

// Get the request headers
$requestHeaders = curl_getinfo($ch, CURLINFO_HEADER_OUT);

// Close the cURL session
curl_close($ch);

// Handle the response
if ($httpStatus == 200) {
    // Decompress the response if it is gzip encoded
    if (strpos($encoding, 'gzip') !== false) {
        $response = gzdecode($response);
    }

    $output = array(
        'constructed_url' => $urlWithParams,
        'request_headers' => $requestHeaders,
        'response' => json_decode($response, true),
        'raw_response' => $response
    );
} else {
    $output = array(
        'constructed_url' => $urlWithParams,
        'http_status' => $httpStatus,
        'request_headers' => $requestHeaders,
        'raw_response' => $response,
        'message' => 'Something went wrong with the request.'
    );
}

// Display the output in JSON format
header('Content-Type: application/json');
echo json_encode($output);

?>
