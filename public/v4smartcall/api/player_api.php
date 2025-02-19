<?php
/**
*
* @ This file is created by http://DeZender.Net
* @ deZender (PHP7 Decoder for ionCube Encoder)
*
* @ Version			:	4.1.0.1
* @ Author			:	DeZender
* @ Release on		:	29.08.2020
* @ Official site	:	http://DeZender.Net
*
*/


function call_api($api_link)
{
	$returnData = '0';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $api_link);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	$result = json_decode(curl_exec($ch));

	if (!empty($result)) {
		$returndata = $result;
		return ['result' => 'success', 'data' => $returndata];
	}
}

error_reporting(0);
$db = new SQLite3('./.db.db');

if (isset($_GET['username'])) {
	$username = $_GET['username'];
	$password = $_GET['password'];
}
else if (isset($_POST['username'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
}

$res = $db->query('SELECT * FROM dns');
$rowss = [];

while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
	$rowss[] = $row['url'];
}

foreach ($rowss as $dns) {
	$api_link = $dns . ('/player_api.php?username=' . $username . '&password=' . $password);
	$api_req = call_api($api_link);
	$result = $api_req;

	if ($result['result'] == 'success') {
		if (isset($result['data']->user_info->auth)) {
			if ($result['data']->user_info->auth != 0) {
				if ($result['data']->user_info->status == 'Active') {
					header('Location: ' . $api_link);
				}
			}
		}
	}
	else {
		echo 'Go stick your dick in a grapefruit....';
	}
}

?>