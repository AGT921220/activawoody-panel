<?php
$functionsFile = "includes/functions.php";
require_once($functionsFile);

$isStream = false;
if (isset($_GET['username'])) {
	$username = $_GET['username'];
	$password = $_GET['password'];
	$targetUrl = $_SERVER['QUERY_STRING'];
} else if (isset($_POST['username'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$forwardPath .= "?" . http_build_query($_POST);
} else if (isset($_GET['path'])) {
	$isStream = true;
	$parts = explode("/", $_GET['path']);
	if (count($parts) > 1) {
		$username = $parts[0];
		$password = $parts[1];
	}
}
$dnsInfo = loadDNSForUser($username, $password);
foreach ($dnsInfo as $dns) {
	$portal = rtrim($dns['portal'], '/');
	$ok = false;
	if (!$dns['checked']) {
		$checkUrl = $portal . "/player_api.php?username=" . $username . "&password=" . $password;
		$callResult = callApi($checkUrl);
		$result = json_decode($callResult["data"]);
		if ($result) {
			if ($callResult["result"] == "success") {
				if (isset($result->user_info->auth)) {
					if ($result->user_info->auth != 0) {
						if ($result->user_info->status == "Active") {
							saveDNSForUser($dns['id'], $username, $password);
							$ok = true;
						}
					}
				}
			}
		}
	} else {
		saveDNSForUser($dns['id'], $username, $password);
		$ok = true;
	}
	if ($ok) {
		if ($isStream) {
			$portalUrl = $portal . $forwardPath;
			$result = callApi($portalUrl, true, 'VLC/3.1.21-rc2 LibVLC/3.1.21-rc2');
			if ($result['headers']['Location']) {
				header("Location: " . $result['headers']['Location'] . "", true, 301);
				exit;
			} else {
				echo $result['data'];
				exit;
			}
		} else {
			$portalUrl = $portal . $forwardPath;
			$result = callApi($portalUrl);
			echo $result['data'];
			exit;
		}
	}
}
