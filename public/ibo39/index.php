<?php
include('includes/functions.php');

$log_check = $db->select('users', '*', 'id = :id', '', [':id' => 1]);
$loggedinuser = !empty($log_check) ? $log_check[0]['username'] : null;

if (!empty($loggedinuser) && isset($_SESSION['name']) && $_SESSION['name'] === $loggedinuser) {
    header("Location: dns.php");
    exit;
}

$data = ['id' => '1','username' => 'admin','password' => 'admin',];
$db->insertIfEmpty('users', $data);

if (isset($_POST["login"])){
	$username = $_POST["username"];
	$userData = $db->select('users', '*', 'username = :username', '', [':username' => $username]);
	if ($userData) {
		$storedPassword = $userData[0]['password'];
		$enteredPassword = $_POST["password"];
		if ($enteredPassword == $storedPassword) {
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['name'] = $_POST['username'];
			if ($_POST['username'] == 'admin'){
				header('Location: user.php');
			}else{
				header('Location: dns.php');
			}
		}else{
			header('Location: ./api/index.php');
		}
	}else{
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
	<meta name="author" content="PlayTecTv">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="./css/css.css">
    <title>Panel</title>
</head>
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
</style>
<div id="js-particles"></div>
<br><br>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mx-md-auto">
                    <div class="text-center">
                        <img class="w-75 p-3" src="./img/logo.png" alt="">
                    </div>
                    <br>
                    <form method="post">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg"
                                   placeholder="Username" name="username" required autofocus>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg"
                                   placeholder="Password" name="password" required>
                        </div>
                        <input type="submit" class="btn btn-warning btn-lg btn-block" value="Log In" name="login">
                    </form>
					<br>
                 <center><a class="list-grup-item" href="https://t.me/apkrebrandec" target="_blank">&nbsp&nbsp&nbsp&nbsp&#169  <?=date("Y")?> * Rebranecuador panels * </a></center>
                </div>
            </div>
        </div>
<br><br>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="js/particles.js"></script>

