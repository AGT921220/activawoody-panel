<?php
$data = base64_decode('eyJhcHBfZGV2aWNlX2lkIjoiTldSalpEQmhaalF4TATJZMU9EaGxZUT09IiwiYXBwX3R5cGUiOiJt');

echo $data;

var_dump(json_decode($data, true));
?>