<?php
ini_set('display_errors', 0);
include(__DIR__ . '/functions.php');

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

$log_check = $db->select('user', '*', 'id = :id', '', [':id' => 1]);
$loggedinuser = !empty($log_check) ? $log_check[0]['username'] : null;

if (!isset($_SESSION['name']) == $loggedinuser) {
	header("location:"."index.php");
	exit();
}

if (isset($_REQUEST['logout'])) {
    session_destroy();
    setcookie("auth", "");
    header("Location: index.php");
    exit;
}

$time = $_SERVER['REQUEST_TIME'];

$timeout_duration = 900;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
	session_unset();
	session_destroy();
	session_start();
}
$_SESSION['LAST_ACTIVITY'] = $time;

function sanitize($data) {
	$data = trim($data);
	$data = htmlspecialchars($data, ENT_QUOTES );
	$data = SQLite3::escapeString($data);
	return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <title>RTX Rebrand V2 Panel</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="author" content="RTX">
	  <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
	  <link rel="apple-touch-icon" sizes="180x180" href="./img/apple-touch-icon.png">
	  <link rel="icon" type="image/png" sizes="32x32" href="./img/favicon-32x32.png">
	  <link rel="icon" type="image/png" sizes="16x16" href="./img/favicon-16x16.png">
	  <link rel="manifest" href="./img/site.webmanifest">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <link href="css/themes/darkly/bootstrap.css" rel="stylesheet" title="main">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="css/simple-sidebar.css" rel="stylesheet">
	     <link href="css/style.css" rel="stylesheet">
   </head>

      <div id="net-canvas"></div> 
      <body>
         <div class="d-flex" id="wrapper">
         <!-- Sidebar-->
         <div class="" id="sidebar-wrapper">
    <div class="sidebar-heading">
        <div class="sidebar-logo">
            <img src="./img/login_logo.png" alt="logo">
        </div>
    </div>
    <span><a class="list-group-item" href=" <?php echo $config_ini['contact']; ?>" target="_blank"><?php echo $config_ini['panel_name']; ?></a> </span>  
    <div class="list-group list-group-flush">
        <a class="list-group-item list-group-item-action " href="main.php">
        <i class="fa fa-cogs"></i>&nbsp;&nbsp;	DNS Settings </a>
        <a class="list-group-item list-group-item-action " href="widgets.php">
        <i class="fa fa-toggle-on"></i>&nbsp;&nbsp;	Widgets Selector </a>
        <a class="list-group-item list-group-item-action " href="image.php">
        <i class="fa fa-picture-o"></i>&nbsp;&nbsp;	Background </a>
        <a class="list-group-item list-group-item-action " href="banner.php">
        <i class="fa fa-bullhorn"></i>&nbsp;&nbsp;	Bannertext </a>
        <a class="list-group-item list-group-item-action " href="ads.php">
        <i class="fa fa-file-image-o"></i>&nbsp;&nbsp;	Manual Ads </a>
        <a class="list-group-item list-group-item-action " href="upload.php">
        <i class="fa fa-upload"></i>&nbsp;&nbsp;	Upload Image </a>
        <a class="list-group-item list-group-item-action " href="user.php">
        <i class="fa fa-user" ></i>&nbsp;&nbsp;	Update credentials </a>
    </div>
</div>
         <!-- /#sidebar-wrapper -->
         <!-- Page Content -->
         <div id="page-content-wrapper">
         <nav class="navbar navbar-expand-lg navbar-dark ctnav">
            <button class="btn btn-primary" id="menu-toggle"><i class="fa fa-bars"></i></button>
            <div class="center" id="pageMessages"></div>
            <a href="<?=basename($_SERVER["SCRIPT_NAME"]).'?logout'?>" class="btn btn-danger ml-auto mr-1"><i class="fa fa-sign-out"></i> Logout</a> 
         </nav>
         <div class="container-fluid">
         <br>
      <style>
body{background-color: #181828;background-image: url("./img/binding_dark.webp"); color #fff;}#particles-js{background-size: cover; background-position: 50% 50%; background-repeat: no-repeat; /*width: 100%; height: 100vh;*/ background: #8000FF; display: flex; justify-content: center; align-items: center;}.particles-js-canvas-el{ position: fixed;}#pageMessages { left: 50%; transform: translateX(-50%); position:fixed; text-align: center; top: 5px; width: 60%; z-index:9999; border-radius:0px}.alert { position: relative;}.alert .close { position: absolute; top: 5px; right: 5px; font-size: 1em;}.alert .fa { margin-right:.3em;}
       </style>
       	<script src="./js/custom.js"></script>
		<script src="./js/three.min.js"></script>
		<script src="./js/vanta.net.min.js"></script>