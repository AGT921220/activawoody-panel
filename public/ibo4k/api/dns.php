<?php
error_reporting(0);
$db = new SQLite3('./.db.db');
$res = $db->query('SELECT * FROM dns'); 
$rows = array();
$rowsn = array();
$json_response = array(); 
function encr($data) {
        $key = 'zsdfkghgujkfdsjgklsdfbjghsdfkjgb';
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, '0123456789abcdef');
        $encrypted_hex = bin2hex($encrypted);
        return $encrypted_hex;
}
    
/*function encr($data) {
        $key = '\u0DC6\u0D9C\u0DA7\u0DBB\u0DB1\u';
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, '!@#$%^*&^%^%$@%^');
        $encrypted_hex = bin2hex($encrypted);
        return $encrypted_hex;
}*/
    
while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
	$row_array['name'] = $row['title']; 
	$row_array['url'] = $row['url']; 
	array_push($json_response,$row_array);  
}



header('Content-type: application/json; charset=UTF-8');

$final = json_encode($json_response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
$output_json = '{"portals":' . $final . ',"qr_url":""}';
echo encr($output_json)
?>