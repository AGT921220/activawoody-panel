<?php
ini_set('display_errors', 1);
include(__DIR__ . '/../includes/functions.php');

// Decode and process the input
$infos = explode("{}", base64_decode($_GET['info']));
$dnsId = $infos[0];
$username = $infos[1];
$password = $infos[2];
$macAddress = base64_decode($infos[3]);

// Convert to uppercase
$macAddress = strtoupper($macAddress);

// Format MAC address to XX:XX:XX:XX:XX:XX
$formattedMac = implode(':', str_split($macAddress, 2));

// Reduce MAC address to the first 6 blocks
$macAddressParts = explode(':', $formattedMac);
if (count($macAddressParts) > 6) {
    $macAddressReduced = implode(':', array_slice($macAddressParts, 0, 6));
} else {
    $macAddressReduced = $formattedMac;
}

// Check if the MAC address with default_user exists
$existingResult = $db->select('playlist', '*', 'mac_address = :mac_address AND username = :username', '', [':mac_address' => $macAddressReduced, ':username' => 'default_user']);

if (!empty($existingResult)) {
    // Delete the existing entry with default_user
    $db->delete('playlist', 'mac_address = :mac_address AND username = :username', [':mac_address' => $macAddressReduced, ':username' => 'default_user']);
}

// Check if the record with the specified DNS ID and MAC address exists
$result = $db->select('playlist', '*', 'dns_id = :dns_id AND mac_address = :mac_address', '', [':dns_id' => $dnsId, ':mac_address' => $macAddressReduced]);

if (!empty($result)) {
    // Update the existing record
    $data = ['username' => $username, 'password' => $password, 'pin' => '0000'];
    $db->update('playlist', $data, 'dns_id = :dns_id AND mac_address = :mac_address', [':dns_id' => $dnsId, ':mac_address' => $macAddressReduced]);
} else {
    // Insert new record
    $data = ['dns_id' => $dnsId, 'mac_address' => $macAddressReduced, 'username' => $username, 'password' => $password, 'pin' => '0000'];
    $db->insert('playlist', $data);
}

$response = ['success' => 1, 'id' => $dnsId, 'name' => null, 'url' => null];
echo json_encode($response);
?>
