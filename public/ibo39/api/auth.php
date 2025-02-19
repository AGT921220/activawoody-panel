<?php
ini_set('display_errors', 0);
include(__DIR__ . '/../includes/functions.php');
$jsonIn = file_get_contents('php://input');
$resonse = json_decode($jsonIn, true);
$decoded = getDecodedString($resonse['data']);
$authData = json_decode($decoded, true);
$portal = [];
if ($authData['app_device_id']) {
	$macAddress = base64_decode($authData['app_device_id']);
	$macAddress = substr($macAddress, 0, 12);
	$formattedMac =  strtoupper(preg_replace('/..(?!$)/', '$0:', $macAddress));
}
else {
	$formattedMac =  strtoupper($authData['mac_address']);
}
$res = $db->select('dns', '*', '', '');

foreach ($res as $row) {
	$result = $db->select('playlist', '*', 'dns_id = :dns_id AND mac_address = :mac_address', '', [':dns_id' => $row['id'],':mac_address' => $formattedMac]);
	if (!empty($result)) {
		$portal[] = ['is_protected' => 0, 'id' => $row['id'], 'url' => $row['url'] . '/get.php?username=' . $result[0]['username'] . '&password=' . $result[0]['password'] . '&type=m3u_plus&output=ts', 'name' => $row['title'],'playlist_name' => $row['title'], 'type' => 'xc', 'created_at' => '2023-03-26 16:42:48', 'updated_at' => '2023-03-26 16:42:48'];
	}else{
		$portal[] = ['is_protected' => 0, 'id' => $row['id'], 'url' => $row['url'] . '/get.php?username=&password=&type=m3u_plus&output=ts', 'name' => $row['title'], 'playlist_name' => $row['title'], 'username' => '', 'password' => '', 'type' => 'xc', 'playlist_type' => 'xc', 'created_at' => '2023-03-26 16:42:48', 'updated_at' => '2023-03-26 16:42:48'];
	}
}

$settings = $db->select('settings', '*', 'id = :id', '', [':id' => 1]);
$notification = ["title" => $settings[0]['note_title'],"content" => $settings[0]['note_content']];



$response = [
	'android_version_code' => '1.0.0',
	'apk_url'              => 'http://google.com',
	'device_key'           => '399513',
	'expire_date'          => '2034-03-26',
	'is_google_paid'       => false,
	'is_trial'             => 0,
	'languages'            => json_decode(file_get_contents('language.json'), true),
	'mac_registered'       => true,
	'themes'               => [],
	'trial_days'           => 7,
	'plan_id'              => '36269518',
	'mac_address'          => $formattedMac,
	'pin'                  => $settings[0]['pin'],
	'price'                => '7.99',
	'app_version'          => '3.1',
	'apk_link'             => 'http://google.com',
	'urls'                 => $portal,
    "notification"         => $notification,
	'qr_url'               => '',
	'qr_url_short'         => ''
];

$returnable['data'] = getEncodedString(json_encode($response));
echo json_encode($returnable);
