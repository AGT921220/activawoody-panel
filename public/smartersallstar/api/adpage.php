<?php

error_reporting(0);
$db = new SQLite3('./.db.db');
$imgs = $db->query("SELECT * FROM ads");
$rows = $db->query("SELECT COUNT(*) as count FROM ads");
$row = $rows->fetchArray();
$numRows = $row['count'];
while ($imge = $imgs->fetchArray()) {
    $data[] = ["id" => $imge['id'], "title" => $imge['title'], "type" => "image", "link" => "", "description" => "AHD", "orderby" => "0", "position" => "horizontal", "extension" => $imge['extension'], "createdon" => $imge['createdon'], "path" => $imge['path'], "orignal" => $imge['path'], "thumbpath" => $imge['path']];
}
$jdata = json_encode($data);
echo "{\"result\":\"success\",\"data\":{\"vertical\":{\"adds\":" . $jdata .", \"count\": " . $numRows . "}}}";


?>