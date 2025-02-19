<?php
error_reporting(1);
$db = new SQLite3('database.db');
$resV = $db->query('SELECT * FROM vpn'); 
$vpn_arr = array(); 
while ($rowV = $resV->fetchArray(SQLITE3_ASSOC)) {
	$row_array['out_name'] = $rowV['vpn_file_name']; 
	$row_array['username'] = $rowV['username']; 
	$row_array['password'] = $rowV['password']; 
	array_push($vpn_arr,$row_array);  
}
$final_vpn = base64_encode('{"VPNs":'.json_encode($vpn_arr).'}');

$db->close();
echo $final_vpn;