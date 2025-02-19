<?php
ini_set('display_errors', 0);
include(__DIR__ . '/../includes/functions.php');
$jsonIn = file_get_contents('php://input');
$response = json_decode($jsonIn, true);
$decoded = getDecodedString($response['data']);
$playlistData = json_decode($decoded, true);
$macAddress = $playlistData['mac_address'];
$newURL = $playlistData['playlist_url'];
$dnsId = $playlistData['playlist_id'];
$playlistName = $playlistData['playlist_name'];
$urlParts = parse_url($newURL, PHP_URL_QUERY);
parse_str($urlParts, $parsed);
$username = $parsed['username'];
$password = $parsed['password'];
$macAddress = strtoupper($macAddress);
$result = $db->select('playlist', '*', 'dns_id = :dns_id AND mac_address = :mac_address', '', [':dns_id' => $dnsId, ':mac_address' => $macAddress]);

if (!empty($result)) {
    $data = ['username' => $username, 'password' => $password];
    $db->update('playlist', $data, 'dns_id = :dns_id AND mac_address = :mac_address', [':dns_id' => $dnsId, ':mac_address' => $macAddress]);
} else {
    $data = ['dns_id' => $dnsId, 'mac_address' => $macAddress, 'username' => $username, 'password' => $password];
    $db->insert('playlist', $data);
}

$response = ['success' => 1, 'id' => $dnsId, 'name' => $playlistName, 'url' => $newURL];
echo json_encode($response);
?>
