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

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <title>FTSOL Panels</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="author" content="FTSOL">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <link href="css/themes/darkly/bootstrap.css" rel="stylesheet" title="main">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="css/simple-sidebar.css" rel="stylesheet">
	  <link href="css/style.css" rel="stylesheet">
   </head>
   <body>
      <style>body{background-color: #181828;background-image: url("./img/binding_dark.webp"); color #fff;}#particles-js{background-size: cover; background-position: 50% 50%; background-repeat: no-repeat; /*width: 100%; height: 100vh;*/ background: #8000FF; display: flex; justify-content: center; align-items: center;}.particles-js-canvas-el{ position: fixed;}#pageMessages { left: 50%; transform: translateX(-50%); position:fixed; text-align: center; top: 5px; width: 60%; z-index:9999; border-radius:0px}.alert { position: relative;}.alert .close { position: absolute; top: 5px; right: 5px; font-size: 1em;}.alert .fa { margin-right:.3em;}</style>
      <div id="net-canvas"></div> 
      <body>
         <div class="d-flex" id="wrapper">
         <!-- Sidebar-->
         <div class="" id="sidebar-wrapper">
            <div class="sidebar-heading">
               <div class="sidebar-logo">
				<img src="./img/Logo-brand.png" alt="logo">
			  </div>
            </div>
            <span><a class="list-group-item" href=" <?php echo $config_ini['contact']; ?>" target="_blank"><?php echo $config_ini['panel_name']; ?></a> </span>  
            <div class="list-group list-group-flush">
               <?php if ($config_ini['dns'] == 1) { ?>
               <a class="list-group-item list-group-item-action " href="dns.php"><i class="fa fa-cogs"></i>DNS Settings </a>
               <?php } ?>
               <?php if ($config_ini['messages'] == 1) { ?>
               <a class="list-group-item list-group-item-action " href="note.php"><i class="fa fa-commenting" ></i>In-app Messages </a>
               <?php } ?>
               <?php if ($config_ini['feedback'] == 1) { ?>
               <a class="list-group-item list-group-item-action " href="feedback.php"><i class="fa fa-commenting-o" ></i>FeedBack </a>
               <?php } ?>
               <?php if ($config_ini['feedback'] == 1) { ?>
               <a class="list-group-item list-group-item-action " href="report.php"><i class="fa fa-flag" ></i>Report </a>
               <?php } ?>
               <?php if ($config_ini['vpn'] == 1) { ?>
               <a class="list-group-item list-group-item-action " href="vpn.php"><i class="fa fa-shield" ></i>OVPN Settings </a>
               <?php } ?>
               <?php if ($config_ini['adss'] == 1) { ?>
               <a class="list-group-item list-group-item-action " href="mRTXDashAdsSetting.php"><i class="fa fa-th-large" ></i>In-App Advert Settings</a>
               <?php } ?>
               
               <?php if ($config_ini['adss'] == 1) { ?>
               <a class="list-group-item list-group-item-action " href="mRTXinAppText.php"><i class="fa fa-text-width" ></i>In-app Text Adverts</a>
               <?php } ?>
               
               <?php if ($config_ini['adss'] == 1) { ?>
               <a class="list-group-item list-group-item-action " href="mRTXAdsSetting.php"><i class="fa fa-th-large" ></i>Dashboard Advert Settings</a>
               <?php } ?>
               <?php if ($config_ini['adverts'] == 1) { ?>
               <a class="list-group-item list-group-item-action " href="adverts.php"><i class="fa fa-th-large" ></i>Dashboard Adverts </a>
               <?php } ?>
               <?php if ($config_ini['logo'] == 1) { ?>
               <a class="list-group-item list-group-item-action " href="mRTXlogo.php"><i class="fa fa-snowflake-o" ></i>Change Logo </a>
               <?php } ?>
               <?php if ($config_ini['backg'] == 1) { ?>
               <a class="list-group-item list-group-item-action " href="mRTXBG.php"><i class="fa fa-snowflake-o" ></i>Change Background </a>
               <?php } ?>
               <?php if ($config_ini['sports'] == 1) { ?>
               <a class="list-group-item list-group-item-action " href="sports.php"><i class="fa fa-futbol-o" ></i>Sports Schedule </a>
               <?php } ?>
               <?php if ($config_ini['rate'] == 1) { ?>
               <a class="list-group-item list-group-item-action " href="rate.php"><i class="fa fa-sliders"></i>Visit us Settings </a>
               <?php } ?>
               <?php if ($config_ini['intro'] == 1) { ?>
               <a class="list-group-item list-group-item-action " href="intro.php"><i class="fa fa-film"></i>Intro Settings </a>
               <?php } ?>
               <?php if ($config_ini['update'] == 1) { ?>
               <a class="list-group-item list-group-item-action " href="update.php"><i class="fa fa-cloud-upload" ></i>Remote Update </a>
               <?php } ?>
               <a class="list-group-item list-group-item-action " href="user.php"><i class="fa fa-user" ></i>Update credentials </a>
            </div>
         </div>
         <!-- /#sidebar-wrapper -->
         <!-- Page Content -->
         <div id="page-content-wrapper">
         <nav class="navbar navbar-expand-lg navbar-dark ctnav">
            <button class="btn btn-primary" id="menu-toggle"><i class="fa fa-bars"></i></button>
            <div class="center" id="pageMessages"></div>
            <a href="logout.php" class="btn btn-danger ml-auto mr-1"><i class="fa fa-sign-out"></i> Logout</a> 
         </nav>
         <div class="container-fluid">
         <br>