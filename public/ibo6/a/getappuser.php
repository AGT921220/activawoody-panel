<?php
error_reporting(0);
const ALLOWED_CHARACTERS = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";


function getDecodedString($str) {
    $encryptKeyPosition = getEncryptKeyPosition(substr($str, -2, 1));
    $encryptKeyPosition2 = getEncryptKeyPosition(substr($str, -1));
    $substring = substr($str, 0, -2);
    return trim(utf8_decode(base64_decode(substr($substring, 0, $encryptKeyPosition) . substr($substring, $encryptKeyPosition + $encryptKeyPosition2))));
}

function getEncryptKeyPosition($str) {
    return strpos(ALLOWED_CHARACTERS, $str);
}

function getEncodedString($str) {
    $encryptKeyPosition = getEncryptKeyPosition(substr($str, -2, 1));
    $encryptKeyPosition2 = getEncryptKeyPosition(substr($str, -1));
    $encodedString = base64_encode(utf8_encode($str));
    $substring = substr($encodedString, 0, $encryptKeyPosition) . substr($encodedString, $encryptKeyPosition + $encryptKeyPosition2);
    return $substring . substr(ALLOWED_CHARACTERS, $encryptKeyPosition, 1) . substr(ALLOWED_CHARACTERS, $encryptKeyPosition2, 1);
}

function themes(){
    $db = new SQLite3('./.eggziedb.db');
    $themes_query = $db->query('SELECT * FROM theme');
    $themes = [];
    while ($theme_row = $themes_query->fetchArray()) {
        $themes[] = ['name' => $theme_row['name'], 'url' => $theme_row['url']];
    }
    $themes_json = json_encode($themes);
    return $themes_json;
}

function loadIbo(){
    $app_info_json = file_get_contents('./ibo.json');
    $app_info = json_decode($app_info_json, true);
    $android_version_code = $app_info['app_info']['android_version_code'];
    $apk_url = $app_info['app_info']['apk_url'];
    return array(
        'android_version_code' => $android_version_code,
        'apk_url' => $apk_url
    );
}

function lang(){
    $language_json = file_get_contents('./language.json');
    return $language_json;
}

function note(){
    $note_json = file_get_contents('./note.json');
    return $note_json;
}

function getUserData($mac_address){
    $db = new SQLite3('./.eggziedb.db');
    $mac_address = strtolower($mac_address);
    $ibo_query = $db->query('SELECT * FROM ibo WHERE LOWER(mac_address)="' . $mac_address . '"');
    $urls = [];
    while ($ibo_row = $ibo_query->fetchArray()) {
        $urls[] = [
            'is_protected' => "1", 
            'id' => md5($ibo_row['password'] . $ibo_row['id']), 
            'url' => $ibo_row['url']."/get.php?username=".$ibo_row['username']."&password=".$ibo_row['password']."&type=m3u_plus&output=ts", 
            'name' => $ibo_row['title'], 
            'created_at' => '2023-04-15 00:06:09',
            'updated_at' => '2023-04-15 00:06:09'
        ];
        $expire_date = $ibo_row['expire_date'];
    }
    //return json_encode($urls);
    return [
        'urls' => json_encode($urls),
        'expire_date' => $expire_date
    ];
}

function escapeUrl($url) {
  return addcslashes($url, '/\\');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get the raw post data
    $post_data = file_get_contents('php://input');
    
    $db = new SQLite3('./.eggziedb.db');
    
    
    
    // decode the JSON data
    $json_data = json_decode($post_data);
    $json_data = $json_data->data;
    $json_data = getDecodedString($json_data);
    $json_data = json_decode($json_data, true);
    $mac_address = getDecodedString($json_data['app_device_id']);
    $mac_address = chunk_split($mac_address, 2, ':');
    $mac_address = rtrim($mac_address, ':');
    

    $expire_date = "";
    
    $ibo_data = loadIbo();
    
    $result = getUserData($mac_address);
    
    $userData = $result['urls'];
    
    if($userData !== "[]"){
        $output_json = '{"android_version_code":"'.$ibo_data['android_version_code'].'","apk_url":"'.escapeUrl($ibo_data['app_url']).'","device_key":"136115","expire_date":"'.$result['expire_date'].'","is_google_paid":true,"is_trial":0,"notification":'.note().',"urls":'.$userData.',"mac_registered":true,"themes":'.themes().',"trial_days":360,"plan_id":"03370629","mac_address":"'.$mac_address.'","pin":"0000","price":"0","app_version":"'.$ibo_data['android_version_code'].'","languages":[' . lang() . '],"apk_link":"'.escapeUrl($ibo_data['apk_url']).'"}'; 
        
        $output_json = '{"data":"'.getEncodedString($output_json).'"}';
    }else{
        $output_json = '{"android_version_code":"'.$ibo_data['android_version_code'].'","apk_url":"'.escapeUrl($ibo_data['app_url']).'","device_key":"136115","expire_date":"2030-01-01","is_google_paid":false,"is_trial":1,"notification":'.note().',"urls":[],"mac_registered":false,"themes":'.themes().',"trial_days":7,"plan_id":"","mac_address":"'.$mac_address.'","pin":"0000","price":"0","app_version":"'.$ibo_data['android_version_code'].'","languages":[' . lang() . '],"apk_link":"'.escapeUrl($ibo_data['apk_url']).'"}'; 
        
        $output_json = '{"data":"'.getEncodedString($output_json).'"}';
    }

    http_response_code(200);
    header('HTTP/1.1 200 OK');
    header('Server: Apache');
    header('Cache-Control: no-cache, private');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Max-Age: 86400');
    header('Access-Control-Allow-Headers: ');
    header('Access-Control-Allow-Method: ');
    header('Access-Control-Allow-Credentials: true');
    header('Connection: close');
    header('Content-Type: application/json');
    echo $output_json;

  }

