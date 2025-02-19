<?php
@session_start();
include('includes/config.php');
$db = new SQLite3('./api/.db.db');
$db->exec("CREATE TABLE IF NOT EXISTS users(id INTEGER PRIMARY KEY,username TEXT ,password TEXT)");

$log_check = $db->query("SELECT * FROM users WHERE id='1'");
$roe = $log_check->fetchArray();
$loggedinuser = @$roe['username'];

if (isset($_SESSION['name']) == $loggedinuser) {
	header("location:"."dns.php");
}

$rows = $db->query("SELECT COUNT(*) as count FROM users");
$row = $rows->fetchArray();
$numRows = $row['count'];
if ($numRows == 0){
	$db->exec("INSERT INTO users(id ,username, password) VALUES('1' ,'admin', 'admin')");
	$db->close();
	}

if (isset($_POST["login"])){
	if(!$db){
		echo $db->lastErrorMsg();
	} else {
	}
	$sql ='SELECT * from users where username="'.$_POST["username"].'";';
	$ret = $db->query($sql);
	while($row = $ret->fetchArray() ){
		$id=$row['id'];
		$username=$row['username'];
		$password=$row['password'];
	}
	if ($id!=""){
		if ($password==$_POST["password"]){
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
	<meta name="author" content="RTX">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="./css/css.css">
    <title>RTX Rebrand</title>
    <link rel="icon" href="./img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
</head>
<style>
body{
  background-color: #181828;
  background-image: url("./img/LoginBG.png");
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

<br><br>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mx-md-auto">
                    <div class="text-center">
                        <img class="w-75 p-1" src="./img/logo_ne.png" alt="">
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
                 <center><a class="list-grup-item" href="https://t.me/apkrebrandec" target="_blank">&nbsp&nbsp&nbsp&nbsp&#169  <?=date("Y")?> * RTX Rebrand * </a></center>
                </div>
            </div>
        </div>
<br><br>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="js/particles.js"></script>

