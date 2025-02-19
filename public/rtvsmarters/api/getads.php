<?php

error_reporting(0);
$db = new SQLite3('./.db.db');
$imgs = $db->query("SELECT * FROM adds");
$rows = $db->query("SELECT COUNT(*) as count FROM adds");
$row = $rows->fetchArray();
$numRows = $row['count'];
$json_response = array(); 
while ($imge = $imgs->fetchArray()) {
    $row_array['AdName'] = $imge['Title']; 
    $row_array['AdUrl'] = $imge['path'];  
    array_push($json_response,$row_array);  
}
header('Content-type: application/json; charset=UTF-8');
$final = json_encode($json_response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
echo ($final)


?>