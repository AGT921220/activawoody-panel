<?php
include(__DIR__ . '/../includes/functions.php');

// Fetch DNS entries from the database
$res = $db->select('dns', '*', '', '');

// Fetch the welcome message from the database
$mes = $db->select('welcome', '*', 'id = :id', '', [':id' => 1]);

// Initialize an array to hold the portals data
$rows = array();
foreach ($res as $index => $row) {
    $rows[] = array(
        "id" => $index + 1,
        "name" => $row['title'],
        "url" => $row['url']
    );
}

// Create the final JSON structure
$final = array(
    "portals" => $rows,
    "intro_url" => "",
    "message_one" => $mes[0]['message_one'],
    "message_two" => $mes[0]['message_two'],
    "message_three" => $mes[0]['message_three']
);

function simpleEncrypt($input) {
    // Define the substitution mapping
    $mapping = [
        '1' => '3',
        '2' => '4',
        '3' => '5',
        '4' => '6',
        '5' => '7',
        '6' => '8',
        '7' => '9',
        '8' => '0',
        '9' => '1',
        '0' => '2'
    ];
    
    // Initialize the output string
    $encrypted = '';

    // Loop through each character in the input string
    for ($i = 0; $i < strlen($input); $i++) {
        $char = $input[$i];
        
        // Check if the character is in the mapping
        if (isset($mapping[$char])) {
            // Append the mapped character to the output string
            $encrypted .= $mapping[$char];
        } else {
            // If character is not in the mapping, append it unchanged
            $encrypted .= $char;
        }
    }

    return $encrypted;
}


header('Content-type: application/json; charset=UTF-8');
$sulanga = json_encode($final, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

$testapi = 'RTxRTxRTx'.$sulanga;
$hex = bin2hex($testapi);
$encrypt = simpleEncrypt($hex);

echo $encrypt;
?>
