<?php
ini_set('display_errors', 1);
if(session_status() === PHP_SESSION_NONE) session_start();
include(__DIR__ . '/functions.php');

$log_check = $db->select('users', '*', 'id = :id', '', [':id' => 1]);
$loggedinuser = !empty($log_check) ? $log_check[0]['username'] : null;
if (empty($loggedinuser) && isset($_SESSION['name']) && $_SESSION['name'] === $loggedinuser) {
	header("Location: index.php");
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="PlayTecTv">
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
<div id="js-particles"></div>
<body> 

  <div class="d-flex" id="wrapper">
	<!-- Sidebar-->
	<div class="" id="sidebar-wrapper">
	  <div class="sidebar-heading">REBRAND ECUADOR IBO </div>
	  <span><a class="list-grup-item" href="https://t.me/apkrebrandec" target="_blank">&nbsp&nbsp&nbsp&nbsp&#169  <?=date("Y")?> *REBRAN ECU Panels * </a> </span></center>
	  <div class="list-group list-group-flush">
		<a class="list-group-item list-group-item-action " href="dns.php">
		<i class="fa fa-cogs"></i>&nbsp;&nbsp;	DNS Settings </a>
		<a class="list-group-item list-group-item-action " href="sports.php">
		<i class="fa fa-futbol-o" >&nbsp;&nbsp;</i>  Sports Schedule </a>
		<a class="list-group-item list-group-item-action " href="tmdb_api.php">
		<i class="fa fa-key" >&nbsp;&nbsp;</i>  tMDB API</a>
		<a class="list-group-item list-group-item-action " href="settings.php">
		<i class="fa fa-wrench" >&nbsp;&nbsp;</i> App Settings </a>
		<a class="list-group-item list-group-item-action " href="user.php">
		<i class="fa fa-user" ></i>&nbsp;&nbsp;	Update credentials </a>
	  </div>
	</div>
	<!-- /#sidebar-wrapper -->

	<!-- Page Content -->
	<div id="page-content-wrapper">

	  <nav class="navbar navbar-expand-lg navbar-dark ">

		<button class="btn btn-primary" id="menu-toggle"><img src="img/logo.png" width="25" height="25" class="d-flex justify-content-center text-allign centre" alt=""></button>
		
	  &nbsp;&nbsp;
		<div class="center" id="pageMessages"></div>
		<a href="logout.php" class="btn btn-danger ml-auto mr-1">Logout</a>
	  </nav>

	  <div class="container-fluid"><br>
