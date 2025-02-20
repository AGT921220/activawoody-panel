<?php
ini_set('display_errors', 1);
include(__DIR__ . '/../includes/functions.php');

// Função para formatar o endereço MAC
function formatMacAddress($mac) {
    $mac = preg_replace('/[^0-9A-Fa-f]/', '', $mac);
    return strtoupper(preg_replace('/(.{2})(?!$)/', '$1:', str_pad($mac, 12, '0', STR_PAD_LEFT)));
}

$jsonIn = file_get_contents('php://input');
$request = json_decode($jsonIn, true);
$decoded = base64_decode($request['data']);
$authData = json_decode($decoded, true);
$portal = [];

// Identificar o endereço MAC
if ($authData['app_device_id']) {
    $macAddress = base64_decode($authData['app_device_id']);
    $formattedMac = formatMacAddress($macAddress);
} else {
    $formattedMac = formatMacAddress($authData['mac_address']);
}

// Verifica se foi enviada uma requisição de exclusão
if (isset($request['action']) && $request['action'] === 'delete' && isset($request['playlist_id'])) {
    // Tenta excluir a playlist correspondente ao ID enviado
    $playlistId = (int)$request['playlist_id']; // ID da playlist a ser deletada
    
    // Executa a exclusão no banco de dados
    $deleted = $db->delete('playlist', 'id = :id AND mac_address = :mac_address', [':id' => $playlistId, ':mac_address' => $formattedMac]);

    // Verifica se a exclusão foi bem-sucedida
    if ($deleted) {
        $response = ['status' => 'success', 'message' => 'Playlist deletada com sucesso.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Erro ao deletar playlist.'];
    }

    // Envia a resposta de volta para o APK
    echo json_encode($response);
    exit;
}

// Seleciona todos os registros da tabela 'dns'
$res = $db->select('dns', '*', '', '');

foreach ($res as $row) {
    $result = $db->select('playlist', '*', 'dns_id = :dns_id AND mac_address = :mac_address', '', [':dns_id' => $row['id'], ':mac_address' => $formattedMac]);
    if (!empty($result)) {
        $portal[] = [
            'is_protected' => 0,
            'id' => $row['id'],
            'url' => $row['url'] . '/get.php?username=' . $result[0]['username'] . '&password=' . $result[0]['password'] . '&type=m3u_plus&output=ts',
            'name' => $row['title'],
            'playlist_name' => $row['title'],
            'type' => 'xc',
            'created_at' => '2023-03-26 16:42:48',
            'updated_at' => '2023-03-26 16:42:48'
        ];
    }
}

// Continua com a montagem da resposta
function getBaseUrl() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'];
    $folderPath = dirname($_SERVER['PHP_SELF']);
    return $protocol . $domainName . $folderPath;
}

$backdropUrl = getBaseUrl() . '/backdrop.php';
$settings = $db->select('settings', '*', 'id = :id', '', [':id' => 1]);
$theme = $db->select('themes', '*', 'id = :id', '', [':id' => 1]);
$theme_id = !empty($theme) ? $theme[0]['theme_id'] : '1';
$result_pin = $db->select('playlist', '*', 'mac_address = :mac_address', '', [':mac_address' => $formattedMac]);

$response = [
    'android_version_code' => '1.0.0',
    'apk_url'              => '',
    'device_key'           => '883348',
    'expire_date'          => '2034-03-26',
    'is_google_paid'       => true,
    'is_trial'             => 0,
    'languages'            => json_decode(file_get_contents('language.json'), true),
    'mac_registered'       => true,
    'themes'               => [],
    'trial_days'           => 7,
    'plan_id'              => '36269518',
    'mac_address'          => $formattedMac,
    'pin'                  => $result_pin[0]['pin'] ?? '0000',
    'price'                => '7.99',
    'apk_link'             => '',
    'urls'                 => $portal,
    'note_title'           => $settings[0]['note_title'],
    'note_content'         => $settings[0]['note_content'],
    'qr_url'               => '',
    'qr_url_short'         => '',
    'home_mode'            => null,
    'home_url1'            => $backdropUrl,
    'home_url2'            => $backdropUrl,
    'theme'                => $theme_id
];

// Envia a resposta criptografada de volta
echo (Encryption::run(json_encode($response), "IBO_38"));
?>
