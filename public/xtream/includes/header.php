<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

//parse config options
$config_ini = parse_ini_file("./config.ini");

if ($config_ini['debug'] == 1 ){
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}else{
	ini_set('display_errors', 0);
}

//db call
$db = new SQLite3('./api/.db.db');
$adb = new SQLite3('./api/.adb.db');
//user check
$log_check = $db->query("SELECT * FROM users WHERE id='1'");
$roe = $log_check->fetchArray();
$loggedinuser = @$roe['username'];
//login check

if (!isset($_SESSION['name']) == $loggedinuser) {
	header("location:"."index.php");
	exit();
}
//logout due to session time
$time = $_SERVER['REQUEST_TIME'];

$timeout_duration = 900;
if (isset($_SESSION['LAST_ACTIVITY']) && 
	($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
	session_unset();
	session_destroy();
	session_start();
}
$_SESSION['LAST_ACTIVITY'] = $time;

//sanitize strings
function sanitize($data) {
	$data = trim($data);
	$data = htmlspecialchars($data, ENT_QUOTES );
	$data = SQLite3::escapeString($data);
	return $data;
}
//current file var
$base_file = basename($_SERVER["SCRIPT_NAME"]);


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="RTX">
	<title>Xtream IPTV</title>
    <link rel="icon" href="./img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link href="css/themes/darkly/bootstrap.css" rel="stylesheet" title="main">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="css/simple-sidebar.css" rel="stylesheet">
</head>
<body>
<style>
body{
  background-color: #181828;
  background-image: url("./img/binding_dark.webp");
  color #fff;
}

#particles-js{
  background-size: cover;
  background-position: 50% 50%;
  background-repeat: no-repeat;
  /*width: 100%;
  height: 100vh;*/
  background: #8000FF;
  display: flex;
  justify-content: center;
  align-items: center;

}

.particles-js-canvas-el{
  position: fixed;
}

#pageMessages {
  left: 50%;
  transform: translateX(-50%);
  position:fixed; 
  text-align: center;
  top: 5px;
  width: 60%;
  z-index:9999; 
  border-radius:0px
}

.alert {
  position: relative;
}

.alert .close {
  position: absolute;
  top: 5px;
  right: 5px;
  font-size: 1em;
}

.alert .fa {
  margin-right:.3em;
}
</style>
<!--<div id="js-particles"></div>-->
<body> 

  <div class="d-flex" id="wrapper">
	<!-- Sidebar-->
	<div class="" id="sidebar-wrapper">
	  <div class="sidebar-heading"><?php echo $config_ini['panel_name'];?> </div>
	  <span><a class="list-group-item" href="<?=$config_ini['contact']?>" target="_blank">&nbsp&nbsp&nbsp&nbsp&#169  &nbsp<?=date("Y")?> *&nbsp <?=$config_ini['brand_name']?> &nbsp* </a> </span>
	  <div class="list-group list-group-flush">

		<a class="list-group-item list-group-item-action " href="apilink.php">
		<i class="fa fa-microchip"></i>&nbsp;&nbsp;	Setup API </a>
		
		<a class="list-group-item list-group-item-action " href="dns.php">
		<i class="fa fa-cogs"></i>&nbsp;&nbsp;	DNS Settings </a>

		<a class="list-group-item list-group-item-action " href="user.php">
		<i class="fa fa-user" ></i>&nbsp;&nbsp;	Update credentials </a>
	  </div>
	</div>
	<!-- /#sidebar-wrapper -->

	<!-- Page Content -->
	<div id="page-content-wrapper">

	  <nav class="navbar navbar-expand-lg navbar-dark ">

		<button class="btn btn-primary" id="menu-toggle"><img src="img/favicon.ico" width="25" height="25" class="d-flex justify-content-center text-allign centre" alt=""></button>
		
	  &nbsp;&nbsp;
		<div class="center" id="pageMessages"></div>
		<a href="logout.php" class="btn btn-danger ml-auto mr-1">Logout</a>
	  </nav>

	  <div class="container-fluid"><br>
