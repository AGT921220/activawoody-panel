<?php
error_reporting(0);
$db = new SQLite3('./.adb.db');
$res = $db->query('SELECT * FROM ads'); 
$rows = array();
$rowsn = array();
$json_response = array(); 
while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
	$row_array['AdName'] = $row['title']; 
	$row_array['AdUrl'] = $row['url']; 
	array_push($json_response,$row_array);  
}
header('Content-type: application/json; charset=UTF-8');
$final = json_encode($json_response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
echo ($final)
?>