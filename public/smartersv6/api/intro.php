<?php
/**
*
* @ This file is created by http://DeZender.Net
* @ deZender (PHP7 Decoder for SourceGuardian Encoder)
*
* @ Version			:	4.1.0.1
* @ Author			:	DeZender
* @ Release on		:	29.08.2020
* @ Official site	:	http://DeZender.Net
*
*/

error_reporting(0);
$folder_data = '../includes/';
$file_api = $folder_data . 'intro_settings.json';
$jsondata = file_get_contents($file_api);
$data = json_decode($jsondata, true);
$json = $data['app'];

if ($json['intro'] == 'yes') {
	$intro = '/intro/intro.mp4';
}
else {
	$intro = '/intro/nointro.mp4';
}
$real_file_location_path_or_url = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] !== 'off') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF'], 2) . $intro;
ob_start();

if (isset($_SERVER['HTTP_RANGE'])) {
	$opts['http']['header'] = 'Range: ' . $_SERVER['HTTP_RANGE'];
}

$opts['http']['method'] = 'HEAD';
$conh = stream_context_create($opts);
$opts['http']['method'] = 'GET';
$cong = stream_context_create($opts);
$out[] = file_get_contents($real_file_location_path_or_url, false, $conh);
$out[] = $http_response_header;
ob_end_clean();
array_map('header', $http_response_header);
readfile($real_file_location_path_or_url, false, $cong);

?>