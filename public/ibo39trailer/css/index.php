<?php
////Get User IP
function real_ip() {
	$ip = 'undefined';
	if (isset($_SERVER)) {
		$ip = $_SERVER['REMOTE_ADDR'];
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		elseif (isset($_SERVER['HTTP_CLIENT_IP'])) $ip = $_SERVER['HTTP_CLIENT_IP'];
	} else {
		$ip = getenv('REMOTE_ADDR');
		if (getenv('HTTP_X_FORWARDED_FOR')) $ip = getenv('HTTP_X_FORWARDED_FOR');
		elseif (getenv('HTTP_CLIENT_IP')) $ip = getenv('HTTP_CLIENT_IP');
	}
	$ip = htmlspecialchars($ip, ENT_QUOTES, 'UTF-8');
	return $ip;
}
?>
<style>
h1,h6{color:red}body{color:#fff;margin:0;padding:0;display:flex;align-items:center;justify-content:center;height:100vh;background:#000}h6{text-decoration:underline}p{font-size:10px;line-height:10px;-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;-webkit-background-clip:text;-webkit-text-fill-color:rgba(255,255,255,.1)}.shadow{position:absolute;left:calc(50% - 200px);top:calc(50% - 125px);marginx:100px auto 100px;width:400px;height:250px;border-radius:5px;background:linear-gradient(0deg,#000,#262626)}.shadow:after,.shadow:before{content:'';border-radius:5px;position:absolute;top:-2px;left:-2px;background:linear-gradient(45deg,#fb0094,#00f,#0f0,red,#fb0094,#00f,#0f0,red);background-size:400%;width:calc(100% + 4px);height:calc(100% + 4px);z-index:-1;animation:20s linear infinite animate}.shadow:after{filter:blur(50px)}@keyframes animate{0%,100%{background-position:0 0}50%{background-position:400% 0}}

</style>

<!DOCTYPE html>
<html>
<head>
<title>Access Denied</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta charset="UTF-8">
<link rel="stylesheet" href="./index.css">
</head>
<body>
<div class="shadow">
<div class="w3-display-middle">
<h6 class="w3-animate-top w3-center">Access Denied</h6>
<hr class="w3-border-white w3-animate-left" style="margin:auto;width:50%">
<h6 class="w3-center w3-animate-right">Stop Snooping!!</h6>
<h3 class="w3-center w3-animate-zoom">🚫🖕🖕🚫</h3>
<h6 class="w3-center w3-animate-zoom">IP Logged: <?=real_ip()?></h6>
</body>
</html>
