<?php
ini_set('display_errors', 1);
if(session_status() === PHP_SESSION_NONE) session_start();
include(__DIR__ . '/functions.php');
$adTypeJsonPath = __DIR__ . '/ad_type.json';
$adb = new SQLite3('./api/.adb.db');
$adTypeData = json_decode(file_get_contents($adTypeJsonPath), true);
$currentAdType = $adTypeData['adType'] ?? 'manual';

if ($currentAdType === 'tmdb') {
    $adsPageUrl = "tmdb_api.php";
} else {
    $adsPageUrl = "ads.php";
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="WCTV IBO 3.8">
	<title>WCTV IBO 3.8</title> <!-- Adicionado para definir o título da aba do navegador -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link href="css/themes/darkly/bootstrap.css" rel="stylesheet" title="main">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="css/simple-sidebar.css" rel="stylesheet">
</head>
<body>
<style>
body{
  background-color: #0000ff;
  background-image: url("./img/binding_dark.webp");
  color #0000ff;
}

#particles-js{
  background-size: cover;
  background-position: 50% 50%;
  background-repeat: no-repeat;
  /*width: 100%;
  height: 100vh;*/
  background: #0000ff;
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

 
		
	  </div>
	</div>
	<!-- /#sidebar-wrapper -->

	
