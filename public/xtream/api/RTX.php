<?php
error_reporting(0);
$db = new SQLite3('./.db.db');
$res = $db->query('SELECT * FROM dns');
$rows = array();
$urlArray = array();

function encr($data) {
    $key = 'zsdfkghgujkfdsjgklsdfbjghsdfkjgb';
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, '0123456789abcdef');
    $encrypted_hex = bin2hex($encrypted);
    return $encrypted_hex;
}

while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
    $row_array['name'] = $row['title'];
    $row_array['url'] = $row['url'];
    array_push($urlArray, $row_array['url']);
}

$urls = implode(",", $urlArray);
$enrurl = encr($urls);
$output = array("dns" => $enrurl, "versionName" => "1.0.1", "versionCode" => 1);
echo json_encode($output);
?>
