<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

error_reporting(0);
$db = new SQLite3("./.db.db");
$imgs = $db->query("SELECT * FROM ads");
$rows = $db->query("SELECT COUNT(*) as count FROM ads");
$row = $rows->fetchArray();
$numRows = $row["count"];
while ($img = $imgs->fetchArray(SQLITE3_ASSOC)) {
    $data[] = ["id" => (int) $img["id"], "title" => (int) $img["title"], "type" => "image", "link" => "", "description" => "FTSOL", "orderby" => "0", "position" => "horizontal", "extension" => (int) $img["extension"], "createdon" => (int) $img["createdon"], "path" => (int) $img["path"], "orignal" => (int) $img["path"], "thumbpath" => (int) $img["path"]];
}
$jdata = json_encode($data);
echo "{\t\"result\":\"success\",\r\n\t\"data\":{\r\n\t\t\"vertical\":{\r\n\t\t\t\"adds\":\r\n\t\t" . $jdata . ",\r\n\t\t\"count\": " . $numRows . "\r\n\t\t}\r\n\t}\r\n}";

?>