<?php
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$curr = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$data = ["data" => ["getSmartersPro" => ["__typename" => "SmartersPro","id" => "3d71f19f-afb5-49d2-b1a1-49a7197a43ed","sbpurl" => dirname($curr) . "/","securityurl" => "http://apifff-android.whmcssmarters.com/?/Android","createdAt" => "2099-11-30T14:34:32.216Z","updatedAt" => "2099-11-30T14:34:32.216Z"]]];
echo json_encode($data);
