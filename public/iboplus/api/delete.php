<?php
/*
 * @ https://t.me/matrix_channel
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 72.
ini_set("display_errors", 0);
include __DIR__ . "/../includes/functions.php";

$jsonIn = file_get_contents("php://input");
$request = json_decode($jsonIn, true);

// Base64 decodes the incoming data
$decoded = base64_decode($request["data"]);
$playlistData = json_decode($decoded, true);

// Retrieves and processes the MAC address
$macAddress = strtoupper($playlistData["mac_address"]);
$macAddress = preg_replace('/[^A-F0-9]/', '', $macAddress);
$macAddress = substr($macAddress, 0, 12);
$macAddressFormatted = implode(":", str_split($macAddress, 2));

// Retrieves the playlist ID for deletion
$dnsId = $playlistData["playlist_id"];

if ($dnsId && $macAddressFormatted) {
    // Attempt to delete the playlist based on dns_id and mac_address
    $deleted = $db->delete("playlist", "dns_id = :dns_id AND mac_address = :mac_address", [":dns_id" => $dnsId, ":mac_address" => $macAddressFormatted]);

    // Respond with the result
    if ($deleted) {
        $response = ["success" => 1, "message" => "Playlist deleted successfully."];
    } else {
        $response = ["success" => 0, "message" => "Error deleting the playlist."];
    }

    echo json_encode($response);
} else {
    // If dns_id or mac_address is missing
    $response = ["success" => 0, "message" => "Invalid data for deletion."];
    echo json_encode($response);
}
?>
