<?php
error_reporting(0);

function getUserData($mac_address){
    $db = new SQLite3('./.db.db');
    $mac_address = strtolower($mac_address);
    $ibo_query = $db->query('SELECT * FROM ibo WHERE LOWER(mac_address)="' . $mac_address . '"');
    $urls = [];
    while ($ibo_row = $ibo_query->fetchArray()) {
        $urls[] = [
            'is_protected' => '1',
            'id' => md5($ibo_row['password'] . $ibo_row['id']), 
            'url' => $ibo_row['url'],
            'playlist_name' => $ibo_row['title'],
            'username' => $ibo_row['username'],
            'password' => $ibo_row['password'],
            'epg_url' => $ibo_row['url'] . "/xmltv.php?username=" . $ibo_row['username'] . "&password=" . $ibo_row['password'],
            'playlist_type' => 'xc',
            'origin_type' => 'general',
            'origin_url' => $ibo_row['url'] . "/get.php?username=" . $ibo_row['username'] . "&password=" . $ibo_row['password'] . "&type=m3u_plus&output=ts"
            
        ];
    }
    return json_encode($urls);
}

function getExpir($mac_address){
    $db = new SQLite3('./.db.db');
    $mac_address = strtolower($mac_address);
    $ibo_query = $db->query('SELECT * FROM subscription WHERE LOWER(mac_address)="' . $mac_address . '"');
    $mExpire;
    while ($ibo_row = $ibo_query->fetchArray()) {
        $mExpire = $ibo_row['expire_date'];
    }
    if($mExpire == ""){
        
        return "3333-03-03";
    }else{
        
        return $mExpire;
    }
}


$mac_address = '00:00:00:00:00';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json_data = file_get_contents('php://input');
    $payload = json_decode($json_data, true);
    if ($payload !== null && isset($payload['data'])) {
        $inner_data = json_decode($payload['data'], true);
        if ($inner_data !== null) {
            $mac_address = $inner_data['mac_address'];
        }
    } 
} else {
    echo "This endpoint only accepts POST requests.";
}


$result = getUserData($mac_address);
$currunt_exp = getExpir($mac_address);
$mPlaylist = $result;
$filetext = 'lan.txt';
$contentstext = file_get_contents($filetext);
$languagedata = json_decode($contentstext, true);

$jsonFilePath_msg = './message.json';
$existingData_msg = json_decode(file_get_contents($jsonFilePath_msg), true);
$currentRecord_msg = !empty($existingData_msg) ? $existingData_msg[0] : array();

function encr($data) {
        $key = '$#@!YT^URjhgFSDRlkjinbvvcxfdsjhg';
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, 'R4tghjg^425(@#Gg');
        $encrypted_hex = bin2hex($encrypted);
        return $encrypted_hex;
}


if (!empty(json_decode($result))) {
     $fuck_ibo ='{"mac_registered":true,"urls":'.$mPlaylist.',"themes":[{"name":"black screen","url":"https://iboplayer.com/images/upload/698079.png"},{"name":"honor wallpaper","url":"https://iboplayer.com/images/upload/166531.jpg"},{"name":"backgroundmain","url":"https://iboplayer.com/images/upload/784319.jpg"},{"name":"background map","url":"https://iboplayer.com/images/upload/672923.png"}],"has_own_playlist":true,"trial_days":99999999,"parent_pin":"","notification":{"title":"'.$currentRecord_msg['first_message'].'","content":"'.$currentRecord_msg['second_message'].'"},"languages":[],"android_version_code":"1.1","apk_url":"https://iboiptv.com/upload/android_1.1.apk","mac_address":"'.$mac_address.'","device_key":"123456RTX","is_trial":1,"expire_date":"'.$currunt_exp.'"}';

    
    $data_json ='{"data":'.encr($fuck_ibo).'}';
} else {
     $jsonFilePath = './trial.json';
     $existingData = json_decode(file_get_contents($jsonFilePath), true);
     $currentRecord = !empty($existingData) ? $existingData[0] : array();
     $urlsdemo[] = [
            'is_protected' => '1',
            'id' => '2015605219121', 
            'url' => $currentRecord['dns'],
            'playlist_name' => $currentRecord['playlistName'],
            'username' => $currentRecord['username'],
            'password' => $currentRecord['password'],
            'epg_url' => $currentRecord['dns'] . "/xmltv.php?username=" . $currentRecord['username'] . "&password=" . $currentRecord['password'],
            'playlist_type' => 'xc',
            'origin_type' => 'general',
            'origin_url' => $currentRecord['dns'] . "/get.php?username=" . $currentRecord['username'] . "&password=" . $currentRecord['password'] . "&type=m3u_plus&output=ts"
            
        ];
        
    $demoPlaylist = json_encode($urlsdemo);    
    $fuck_ibo ='{"mac_registered":true,"urls":'.$demoPlaylist.',"themes":[{"name":"black screen","url":"https://iboplayer.com/images/upload/698079.png"},{"name":"honor wallpaper","url":"https://iboplayer.com/images/upload/166531.jpg"},{"name":"backgroundmain","url":"https://iboplayer.com/images/upload/784319.jpg"},{"name":"background map","url":"https://iboplayer.com/images/upload/672923.png"}],"has_own_playlist":true,"trial_days":99999999,"parent_pin":"0000","notification":{"title":"'.$currentRecord_msg['first_message'].'","content":"'.$currentRecord_msg['second_message'].'"},"languages":[],"android_version_code":"1.1","apk_url":"https://iboiptv.com/upload/android_1.1.apk","mac_address":"'.$mac_address.'","device_key":"123456RTX","is_trial":1,"expire_date":"3333-03-03"}';
    
   $data_json ='{"data":'.encr($fuck_ibo).'}';
}

header('Content-Type: application/json');
echo $data_json;



