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

@session_start();
$config_ini = parse_ini_file('./config.ini');
$db = new SQLite3('./api/.db.db');
$db->exec('CREATE TABLE IF NOT EXISTS users(id INTEGER PRIMARY KEY,username TEXT ,password TEXT)');
$log_check = $db->query('SELECT * FROM users WHERE id=\'1\'');
$roe = $log_check->fetchArray();
$loggedinuser = @$roe['username'];

if (isset($_SESSION['name']) === $loggedinuser) {
	header('location: dns.php');
}

$rows = $db->query('SELECT COUNT(*) as count FROM users');
$row = $rows->fetchArray();
$numRows = $row['count'];

if ($numRows == 0) {
	$db->exec('INSERT INTO users(id ,username, password) VALUES(\'1\' ,\'admin\', \'admin\')');
	$db->close();
}

if (isset($_POST['login'])) {
	if (!$db) {
		echo $db->lastErrorMsg();
	}

	$sql = 'SELECT * from users where username="' . $_POST['username'] . '";';
	$ret = $db->query($sql);

	while ($row = $ret->fetchArray()) {
		$id = $row['id'];
		$username = $row['username'];
		$password = $row['password'];
	}

	if ($id != '') {
		if ($password == $_POST['password']) {
			session_regenerate_id();
			$_SESSION['loggedin'] = true;
			$_SESSION['name'] = $_POST['username'];

			if ($_POST['username'] == 'admin') {
				header('Location: user.php');
			}
			else {
				header('Location: dns.php');
			}
		}
		else {
			header('Location: ./api/index.php');
		}
	}
	else {
		header('Location: ./api/index.php');
	}

	$db->close();
}

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="author" content="FTSOL">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
      <link rel="stylesheet" href="./css/css.css"> 
	  <link rel="stylesheet" href="./css/style.css?<?php echo time(); ?>">
      <title>FTSOL Panels</title>
   </head>
   <style>body{background-color: #181828; background-image: url("./img/binding_dark.webp"); color #fff; } #particles-js{background-size: cover; background-position: 50% 50%; background-repeat: no-repeat; /*width: 100%; height: 100vh;*/ background: #8000FF; display: flex; justify-content: center; align-items: center;}.particles-js-canvas-el{ position: fixed;}.footer {position: fixed; left: 0; bottom: 0;  width: 100%; color: black;  text-align: center;}.footer a { color: #000;}.footer a:hover {  color: #2e2e2e;}</style>
   <div id="net-canvas"></div>      
   <div class="ctlogin-box">
   <div class="container">          
      <div class="row">               
         <div class="col-lg-8 mx-md-auto">                 
            <div class="ctlogin-main d-flex">
			<div class="text-center ctleft">                      
				<!--img class="w-75 p-3" src="./img/logo.png" alt=""-->
				<div class="ctlogin-logo">
					<img class="w-75" src="./img/logo.png" alt="">
				</div>
				<div class="brand-logo">
					<img class="w-75" src="./img/logo-big.png" alt="">
				</div>
			</div>                  
            <div class="ctright">
			<h1 class="loadIn">IPTV<sup> Smarters </sup>Manager<br>With Widget Control</h1>
				  <p>ENTER ACCESS DATA</p>
			<form method="post">                      
               <div class="form-group ctinput">
				<label>Username</label>
				<input type="text" class="form-control form-control-lg" name="username" required autofocus>
			   </div>                      
               <div class="form-group ctinput">                           
				<label>Password</label>
				<input type="text" class="form-control form-control-lg" name="password" required>
                </div>
               <input type="submit" class="btn btn-warning btn-lg btn-block ctbtn" value="Log In" name="login">                   
            </form> 
            <div class="ctlogin-foot"><a href="
               <?php echo $config_ini['contact']; ?>" target="_blank">&nbsp&nbsp&nbsp&nbsp&#169
               <?php echo date('Y'); ?>
               <?php echo ' *&nbsp '; ?>
               <?php echo $config_ini['brand_name']; ?>
                <?php echo ' &nbsp*';  ?> </a>
            </div>               
			</div>
			</div>
         </div>          
      </div>      
   </div>
   </div>
   <!--div class="footer">
      <center><a class="list-grup-item" href="https://t.me/ftsoltech" target="_blank">* FTSOL Panels *</a></center>
   </div-->
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script><script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script><script src="js/three.min.js"></script><script src="js/vanta.net.min.js"></script>
  <script>
VANTA.NET({
  el: "#net-canvas",
  mouseControls: true,
  touchControls: true,
  gyroControls: false,
  forceAnimate: true,
  minHeight: 700.00,
  minWidth: 200.00,
  scale: 1.00,
  scaleMobile: 1.00,
  backgroundColor: 0x1d1d1d,
  color: 0xf0833c
})
</script>