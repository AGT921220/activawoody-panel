<?php
ini_set("display_errors", 1);
error_reporting(1);
//Add database details below:
$host = "localhost"; //<-- mysql database host, usually localhost if it lives on the same server
$username = "activawu_root"; //<-- username of user that has permission to the new database you just created
$password = "menmen.123"; //<-- password of database you just created
$dbname = "activawu_xciptv6"; //<-- name of database you just created
$GLOBALS['panelroot'] = '';
//db version
$expectedVersion = 11;
//app version
$appVersion = "XC 1.5";
$dbConnected = false;
$mysqli = new mysqli($host, $username, $password, $dbname);
if ($mysqli->connect_errno) {
	//Error
} else {
	$dbConnected = true;
}
$insVersion = 0;
try { 
	$insResult = $mysqli->prepare("SELECT * FROM config");
	if ($insResult) {
		$insResult->execute();
		$insResult = $insResult->get_result();
		$configArray = $insResult->fetch_array();
		$insVersion = $configArray['dbversion'];
		$GLOBALS['panelroot'] = $configArray['panel_root'];
		if (substr($GLOBALS['panelroot'], -1) != "/") {
			$GLOBALS['panelroot'] .= "/";
			
		}
		$authVar = md5($GLOBALS['panelroot'] . $insVersion);
	}
	$isInstalled = $insResult !== false;
	$dbIsLatest = $expectedVersion == $insVersion;
} catch (Exception $e) {
	$isInstalled = false;
	$dbIsLatest = false;
}
