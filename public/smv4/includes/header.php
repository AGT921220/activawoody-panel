<?php
function verifyDomainAccess() {
    $remote_domain = $_SERVER['HTTP_HOST']; // Automatically determine the domain

    $api_endpoint = 'http://b3tx3.co.uk/test/apikey/main.php?action=generate_api_key';

    $data = array(
        'domain' => $remote_domain,
    );

    $options = array(
        'http' => array(
            'method'  => 'POST',
            'header'  => 'Content-Type: application/x-www-form-urlencoded',
            'content' => http_build_query($data),
        ),
    );

    $context  = stream_context_create($options);
    $response = file_get_contents($api_endpoint, false, $context);
    $api_response = json_decode($response, true);

    if (isset($api_response['api_key'])) {
        if (isset($api_response['access']) && $api_response['access'] === 1) {
            // Access granted
            return true;
        } else {
            // Access denied
            displayAccessDeniedPage();
            exit; // Stop execution here
        }
    } else {
        // Handle other errors or unexpected responses
        echo "An error occurred: " . print_r($api_response, true);
        exit; // Stop execution here
    }
}

function displayAccessDeniedPage() {
    echo '<html>';
    echo '<head>';
    echo '<title>Access Denied</title>';
    echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">';
    echo '<style>';
    echo '.lock-icon { animation: pulse 1s infinite; }';
    echo '@keyframes pulse { 0% { transform: scale(1); } 50% { transform: scale(1.2); } 100% { transform: scale(1); } }';
    echo '</style>';
    echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
    echo '<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>';
    echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>';
    echo '</head>';
    echo '<body style="background-color: #0A3D91; color: #fff;">';
    echo '<div class="container h-100 d-flex justify-content-center align-items-center">';
    echo '<div class="card text-center" style="width: 500px; background-color: #2C3E50; border: 2px solid #34495E;">';
    echo '<div class="card-body">';
    echo '<i class="fas fa-lock fa-7x text-danger lock-icon"></i>';
    echo '<h1 class="text-danger">Access Denied</h1>';
    echo '<p>This panel is not licensed for this domain.</p>';
    echo '<p style="font-size: 20px;">Join our Telegram channel for support:</p>';
    echo '<p><a href="YOUR_TELEGRAM_CHANNEL_LINK" style="font-size: 24px;"><i class="fab fa-telegram"></i> Telegram</a></p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</body>';
    echo '</html>';
}

// Usage of the function
if (!verifyDomainAccess()) {
    exit; // Stop execution if access is denied
}
ini_set('display_errors', 0);
if(session_status() === PHP_SESSION_NONE) session_start();
include ('includes/functions.php');
initializeDatabase($db);
//user check
$log_check = $db->query("SELECT * FROM users WHERE id='1'");
$roe = $log_check->fetchArray();
$loggedinuser = @$roe['username'];
//login check

if (!isset($_SESSION['name']) == $loggedinuser) {
	//header("location:"."index.php");
	echo "<script>window.location.href='index.php'</script>";
	exit();
}

//current file var
$base_file = basename($_SERVER["SCRIPT_NAME"]);


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="FTG">
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
	  <div class="sidebar-heading">FTG Smarters V4 </div>
	  <span><a class="list-grup-item" href="https://t.me/FireTVGuru" target="_blank">&nbsp&nbsp&nbsp&nbsp&#169  <?=date("Y")?> * FTG Panels * </a> </span></center>
	  <div class="list-group list-group-flush">
		<a class="list-group-item list-group-item-action " href="dns.php">
		<i class="fa fa-cogs"></i>&nbsp;&nbsp;	DNS Settings </a>
		<a class="list-group-item list-group-item-action " href="tmdb_api.php">
		<i class="fa fa-key"></i>&nbsp;&nbsp;	tMDB Settings </a>
		<a class="list-group-item list-group-item-action " href="background.php">
		<i class="fa fa-image"></i>&nbsp;&nbsp;	Background Image </a>
		<a class="list-group-item list-group-item-action " href="marquee.php">
		<i class="fa fa-commenting" ></i>&nbsp;&nbsp;	In-app Marquee </a>
		<a class="list-group-item list-group-item-action " href="note.php">
		<i class="fa fa-commenting" ></i>&nbsp;&nbsp;	In-app Messages </a>
		
		<a class="list-group-item list-group-item-action " href="reports.php">
		<i class="fa fa-commenting" ></i>&nbsp;&nbsp;	In-app Reports </a>
		<a class="list-group-item list-group-item-action " href="feedback.php">
		<i class="fa fa-commenting" ></i>&nbsp;&nbsp;	In-app Feedback </a>
		<a class="list-group-item list-group-item-action " href="vpn.php">
		<i class="fa fa-shield" ></i>&nbsp;&nbsp;	OVPN Settings </a>
		<a class="list-group-item list-group-item-action " href="sports.php">
		<i class="fa fa-futbol-o" >&nbsp;&nbsp;</i>  Sports Schedule </a>
		<a class="list-group-item list-group-item-action " href="maint.php">
		<i class="fa fa-wrench" >&nbsp;&nbsp;</i>  Maintenance Mode </a>
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
