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
$resonse = json_decode($jsonIn, true);
$decoded = base64_decode($resonse["data"]);
$playlistData = json_decode($decoded, true);

// Função para excluir uma playlist
function deletePlaylist($dnsId, $macAddressFormatted, $db) {
    $deleted = $db->delete("playlist", "dns_id = :dns_id AND mac_address = :mac_address", [":dns_id" => $dnsId, ":mac_address" => $macAddressFormatted]);
    if ($deleted) {
        return ["success" => 1, "message" => "Playlist deleted successfully."];
    } else {
        return ["success" => 0, "message" => "Error deleting the playlist."];
    }
}

// Recebe o endereço MAC completo
$macAddress = strtoupper($playlistData["mac_address"]);

// Remove qualquer caractere não hexadecimal
$macAddress = preg_replace('/[^A-F0-9]/', '', $macAddress);

// Garante que o endereço MAC tenha no máximo 12 caracteres (os primeiros 6 bytes)
$macAddress = substr($macAddress, 0, 12);

// Formata o endereço MAC para o formato XX:XX:XX:XX:XX:XX
$macAddressFormatted = implode(":", str_split($macAddress, 2));

// A variável original macAddress ainda contém o endereço completo
$fullMacAddress = $playlistData["mac_address"];

$pin = $playlistData["parent_control"];
$dnsId = $playlistData["playlist_id"];
$newURL = $playlistData["playlist_url"];
$playlistName = $playlistData["playlist_name"];
$urlParts = parse_url($newURL, PHP_URL_QUERY);
parse_str($urlParts, $parsed);
$username = $parsed["username"];
$password = $parsed["password"];

// Verifica se a requisição inclui delete
if (isset($playlistData["delete"]) && $playlistData["delete"] == true) {
    // Chama a função para excluir a playlist
    $response = deletePlaylist($dnsId, $macAddressFormatted, $db);
    echo json_encode($response);
    exit;
}

// Verifica se username e password são '0' e exclui se for o caso
if ($username === '0' && $password === '0') {
    $response = deletePlaylist($dnsId, $macAddressFormatted, $db);
    echo json_encode($response);
    exit;
}

// Verifica se o controle parental foi recebido
if ($pin) {
    $result = $db->select("playlist", "*", "mac_address = :mac_address", "", [":mac_address" => $macAddressFormatted]);
    if (!empty($result)) {
        if ($result[0]["pin"] == $pin) {
            echo "{\"status\":true,\"message\":\"Parental Pin Set\"}";
        } else {
            $data = ["pin" => $pin];
            $db->update("playlist", $data, "mac_address = :mac_address", [":mac_address" => $macAddressFormatted]);
            echo "{\"status\":true,\"message\":\"Parental Pin updated Successfully\"}";
        }
    }
} else {
    // Caso contrário, realiza a atualização da playlist
    $result = $db->select("playlist", "*", "dns_id = :dns_id AND mac_address = :mac_address", "", [":dns_id" => $dnsId, ":mac_address" => $macAddressFormatted]);
    if (!empty($result)) {
        $data = ["username" => $username, "password" => $password];
        $db->update("playlist", $data, "dns_id = :dns_id AND mac_address = :mac_address", [":dns_id" => $dnsId, ":mac_address" => $macAddressFormatted]);
        $response = ["success" => 1, "id" => $dnsId, "name" => $playlistName, "url" => $newURL];
        echo json_encode($response);
    } else {
        echo json_encode(["success" => 0]);
    }
}

?>
