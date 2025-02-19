<?php
ini_set('display_errors', 1);
include(__DIR__ . '/../includes/functions.php');

// Function to format MAC address
function formatMac($mac, $doubleDecode = false, $removeSubstr = null) {
    if ($doubleDecode) {
        $mac = base64_decode(base64_decode($mac));
    } else {
        $mac = base64_decode($mac);
    }

    if ($removeSubstr) {
        $mac = str_replace($removeSubstr, "", $mac);
    }
    return strtoupper(preg_replace('/..(?!$)/', '$0:', $mac));
}

// Function to fetch user and password from getappuser.php
function getUserPasswordFromApp($mac) {
    $url = './getappuser.php'; // URL do seu script getappuser.php
    $data = json_encode(['data' => base64_encode(json_encode(['app_device_id' => base64_encode($mac)]))]);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data)
    ]);
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response) {
        $responseData = json_decode($response, true);
        $decodedData = json_decode(base64_decode($responseData['data']), true);

        if (isset($decodedData['username']) && isset($decodedData['password'])) {
            return [
                'username' => $decodedData['username'],
                'password' => $decodedData['password']
            ];
        }
    }

    return ['username' => 'default_user', 'password' => 'default_pass']; // Fallback caso não tenha retorno
}

// Get and format the MAC address
$mac = $_GET['mac'];
$macAddress = formatMac($mac, true, "afea");

// Remove colons for database check and ensure it's 12 characters long
$macAddressClean = str_replace(':', '', $macAddress);
if (strlen($macAddressClean) > 12) {
    $macAddressClean = substr($macAddressClean, 0, 12); // Trim to 12 characters
} elseif (strlen($macAddressClean) < 12) {
    $macAddressClean = str_pad($macAddressClean, 12, '0'); // Pad to 12 characters
}
$macAddressFormatted = implode(':', str_split($macAddressClean, 2)); // Format as XX:XX:XX:XX:XX:XX

// Check if the MAC address exists in the database
$result = $db->select('playlist', '*', 'mac_address = :mac_address', '', [':mac_address' => $macAddressFormatted]);

// If the MAC address is not found, fetch user/password and insert into DB
if (empty($result)) {
    // Get username and password from getappuser.php
    $userData = getUserPasswordFromApp($macAddressFormatted);
    
    $data = [
        'mac_address' => $macAddressFormatted,
        'username' => $userData['username'],
        'password' => $userData['password'],
        'pin' => '0000' // Default PIN
    ];
    $db->insert('playlist', $data);
}

// Check for accounts associated with the MAC address
$result = $db->select('playlist', '*', 'mac_address = :mac_address', '', [':mac_address' => $macAddressFormatted]);

$accounts = 0;
if (!empty($result)) {
    foreach ($result as $row) {
        if (!empty($row['username'])) {
            $accounts = 1;
            break; // Exit the loop as we found a matching account
        }
    }
}

// Fetch DNS data
$res = $db->select('dns', '*', '', '');
$portal = [];
foreach ($res as $row) {
    if (!empty($res)) {
        $portal[] = ['name' => $row['title'], 'url' => $row['url'], 'id' => $row['id']];
    }
}

// Prepare and output response
$data = ['portals' => $portal, 'accounts' => $accounts];
echo Encryption::run(json_encode($data), "IBO_38");
?>
