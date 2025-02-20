<?php
error_reporting(0);
$jsonData = file_get_contents('../a/rtx/Setting.json');
header('Content-type: application/json; charset=UTF-8');
$final = json_decode($jsonData);
echo json_encode($final, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>
