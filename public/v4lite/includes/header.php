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
function sanitize($data)
{
	$data = trim($data);
	$data = htmlspecialchars($data, ENT_QUOTES);
	$data = SQLite3::escapeString($data);
	return $data;
}

session_start();
require_once './includes/functions.php';
$config_ini = parse_ini_file('./config.ini');

if (@$config_ini['errors'] == 1) {
	echo ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(32767);
}
else {
	ini_set('display_errors', 0);
}

$db = new SQLite3('./api/.db.db');
$log_check = $db->query('SELECT * FROM users WHERE id=\'1\'');
$roe = $log_check->fetchArray();
$loggedinuser = @$roe['username'];

if (isset($_SESSION['name']) == $loggedinuser) {
}
else {
	header('location: index.php');
	exit();
}

$time = $_SERVER['REQUEST_TIME'];
$timeout_duration = 900;
if (isset($_SESSION['LAST_ACTIVITY']) && ($timeout_duration < ($time - $_SESSION['LAST_ACTIVITY']))) {
	session_unset();
	session_destroy();
	session_start();
}

$_SESSION['LAST_ACTIVITY'] = $time;
$base_file = basename($_SERVER['SCRIPT_NAME']);
echo "\r\n" . '<!DOCTYPE html>' . "\r\n" . '<html lang="en">' . "\r\n" . '<head>' . "\r\n\t" . '<meta charset="utf-8">' . "\r\n\t" . '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">' . "\r\n\t" . '<meta name="author" content="FTG">' . "\r\n\t" . '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">' . "\r\n\t" . '<link href="css/themes/darkly/bootstrap.css" rel="stylesheet" title="main">' . "\r\n" . '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css">' . "\r\n\t" . '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">' . "\r\n\t" . '<link href="css/simple-sidebar.css" rel="stylesheet">' . "\r\n" . '</head>' . "\r\n" . '<body>' . "\r\n" . '<style>' . "\r\n" . 'body{' . "\r\n" . '  background-color: #181828;' . "\r\n" . '  background-image: url("./img/binding_dark.webp");' . "\r\n" . '  color #fff;' . "\r\n" . '}' . "\r\n\r\n" . '#particles-js{' . "\r\n" . '  background-size: cover;' . "\r\n" . '  background-position: 50% 50%;' . "\r\n" . '  background-repeat: no-repeat;' . "\r\n" . '  /*width: 100%;' . "\r\n" . '  height: 100vh;*/' . "\r\n" . '  background: #8000FF;' . "\r\n" . '  display: flex;' . "\r\n" . '  justify-content: center;' . "\r\n" . '  align-items: center;' . "\r\n\r\n" . '}' . "\r\n\r\n" . '.particles-js-canvas-el{' . "\r\n" . '  position: fixed;' . "\r\n" . '}' . "\r\n\r\n" . '#pageMessages {' . "\r\n" . '  left: 50%;' . "\r\n" . '  transform: translateX(-50%);' . "\r\n" . '  position:fixed; ' . "\r\n" . '  text-align: center;' . "\r\n" . '  top: 5px;' . "\r\n" . '  width: 60%;' . "\r\n" . '  z-index:9999; ' . "\r\n" . '  border-radius:0px' . "\r\n" . '}' . "\r\n\r\n" . '.alert {' . "\r\n" . '  position: relative;' . "\r\n" . '}' . "\r\n\r\n" . '.alert .close {' . "\r\n" . '  position: absolute;' . "\r\n" . '  top: 5px;' . "\r\n" . '  right: 5px;' . "\r\n" . '  font-size: 1em;' . "\r\n" . '}' . "\r\n\r\n" . '.alert .fa {' . "\r\n" . '  margin-right:.3em;' . "\r\n" . '}' . "\r\n" . '</style>' . "\r\n\r\n" . '<div id="js-particles"></div>' . "\r\n" . '<body> ' . "\r\n\r\n" . '  <div class="d-flex" id="wrapper">' . "\r\n\t" . '<!-- Sidebar-->' . "\r\n\t" . '<div class="" id="sidebar-wrapper">' . "\r\n\t" . '  <div class="sidebar-heading">';
echo $config_ini['panel_name'];
echo ' </div>' . "\r\n\t" . '  <span><a class="list-group-item" href="';
echo $config_ini['contact'];
echo '" target="_blank">&nbsp&nbsp&nbsp&nbsp&#169  &nbsp';
echo date('Y');
echo ' *&nbsp ';
echo $config_ini['brand_name'];
echo ' &nbsp* </a> </span>' . "\r\n\t" . '  <div class="list-group list-group-flush">' . "\r\n\t\t";

if ($config_ini['dns'] == 1) {
	echo '<a class="list-group-item list-group-item-action " href="dns.php">' . "\r\n\t\t" . '<i class="fa fa-cogs"></i>&nbsp;&nbsp;' . "\t" . 'DNS Settings </a>';
}

if ($config_ini['messages'] == 1) {
	echo '<a class="list-group-item list-group-item-action " href="note.php">' . "\r\n\t\t" . '<i class="fa fa-commenting" ></i>&nbsp;&nbsp;' . "\t" . 'In-app Messages </a>';
}

if ($config_ini['feedback'] == 1) {
	echo '<a class="list-group-item list-group-item-action " href="feedback.php">' . "\r\n\t\t" . '<i class="fa fa-commenting-o" ></i>&nbsp;&nbsp;' . "\t" . 'FeedBack </a>';
}
if ($config_ini['feedback'] == 1) {
	echo '<a class="list-group-item list-group-item-action " href="report.php">' . "\r\n\t\t" . '<i class="fa fa-flag" ></i>&nbsp;&nbsp;' . "\t" . 'Report </a>';
}

if ($config_ini['vpn'] == 1) {
	echo '<a class="list-group-item list-group-item-action " href="vpn.php">' . "\r\n\t\t" . '<i class="fa fa-shield" ></i>&nbsp;&nbsp;' . "\t" . 'OVPN Settings </a>';
}
if ($config_ini['adss'] == 1) {
	echo '<a class="list-group-item list-group-item-action " href="mRTXAdsSetting.php">' . "\r\n\t\t" . '<i class="fa fa-th-large" ></i>&nbsp;&nbsp;' . "\t" . 'Advert Settings</a>';
}

if ($config_ini['adverts'] == 1) {
	echo '<a class="list-group-item list-group-item-action " href="adverts.php">' . "\r\n\t\t" . '<i class="fa fa-th-large" ></i>&nbsp;&nbsp;' . "\t" . 'Adverts </a>';
}

if ($config_ini['logo'] == 1) {
	echo '<a class="list-group-item list-group-item-action " href="mRTXlogo.php">' . "\r\n\t\t" . '<i class="fa fa-snowflake-o" ></i>&nbsp;&nbsp;' . "\t" . 'Change Logo </a>';
}

if ($config_ini['backg'] == 1) {
	echo '<a class="list-group-item list-group-item-action " href="mRTXBG.php">' . "\r\n\t\t" . '<i class="fa fa-snowflake-o" ></i>&nbsp;&nbsp;' . "\t" . 'Change Background </a>';
}

if ($config_ini['sports'] == 1) {
	echo '<a class="list-group-item list-group-item-action " href="sports.php">' . "\r\n\t\t" . '<i class="fa fa-futbol-o" ></i>&nbsp;&nbsp;' . "\t" . 'Sports Schedule </a>';
}

/*if ($config_ini['rate'] == 1) {
	echo '<a class="list-group-item list-group-item-action " href="rate.php">' . "\r\n\t\t" . '<i class="fa fa-sliders"></i>&nbsp;&nbsp;' . "\t" . 'Visit us Settings </a>';
}

if ($config_ini['intro'] == 1) {
	echo '<a class="list-group-item list-group-item-action " href="intro.php">' . "\r\n\t\t" . '<i class="fa fa-film"></i>&nbsp;&nbsp;' . "\t" . 'Intro Settings </a>';
}

if ($config_ini['update'] == 1) {
	echo '<a class="list-group-item list-group-item-action " href="update.php">' . "\r\n\t\t" . '<i class="fa fa-cloud-upload" ></i>&nbsp;&nbsp;' . "\t" . 'Remote Update </a>';
}*/

echo "\t\t" . '<a class="list-group-item list-group-item-action " href="user.php">' . "\r\n\t\t" . '<i class="fa fa-user" ></i>&nbsp;&nbsp;' . "\t" . 'Update credentials </a>' . "\r\n\t" . '  </div>' . "\r\n\t" . '</div>' . "\r\n\t" . '<!-- /#sidebar-wrapper -->' . "\r\n\r\n\t" . '<!-- Page Content -->' . "\r\n\t" . '<div id="page-content-wrapper">' . "\r\n\r\n\t" . '  <nav class="navbar navbar-expand-lg navbar-dark ">' . "\r\n\r\n\t\t" . '<button class="btn btn-primary" id="menu-toggle"><img src="img/logo.png" width="25" height="25" class="d-flex justify-content-center text-allign centre" alt=""></button>' . "\r\n\t\t\r\n\t" . '  &nbsp;&nbsp;' . "\r\n\t\t" . '<div class="center" id="pageMessages"></div>' . "\r\n\t\t" . '<a href="logout.php" class="btn btn-danger ml-auto mr-1">Logout</a>' . "\r\n\t" . '  </nav>' . "\r\n\r\n\t" . '  <div class="container-fluid"><br>' . "\r\n";

?>