<!DOCTYPE html>
<?php 
include ('includes/header.php');?>
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(32767);
<html>
<head>
    <meta charset="utf-8">
    <title>PHP JSON File CRUD (Create Read Update and Delete)</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
</head>
<body>
<div class="pcoded-main-container">
<div id="particles-background" class="vertical-centered-box"></div>
<div id="particles-foreground" class="vertical-centered-box"></div>
<?php
 
    //get json data
    $data = file_get_contents('api/RTXDashVideo.json');
    $data_array = json_decode($data);
 
    //assign the data to selected index
    $row = $data_array->RTX_MODE[0];
 
    if(isset($_POST['save'])){
        $input = array(
            'video_url' => $_POST['video_url']
        );
 
        //update the selected index
        $data_array->RTX_MODE[0] = $input;
 
        //encode back to json
        $data = json_encode($data_array, JSON_PRETTY_PRINT);
        file_put_contents('api/RTXDashVideo.json', $data);
        $index = "";
        //header('location: appsetting.php');
        echo "<script>window.location.href='video.php';</script>";
        exit;
    }
?>
<div class="login-box">
  <h2>Dashboard Video</h2>
  <form method="post">
    <div class="user-box">
      <input type="text" name="video_url" value="<?php echo $row->video_url; ?>">
      <label>.m3u8 / .mp4 / .avi / .mkv only</label>
    </div>
    <div class="col-12"> <button type="submit" name="save" class="btn btn-primary btn-block logn-btn">Submit</button> </div>
  </form>
</div>
<?php include "includes/functions.php";?>
 <style> 
body {
  -webkit-font-smoothing: antialiased;
  text-rendering: optimizeLegibility;
  font-family: "proxima-nova-soft", sans-serif;
  -webkit-user-select: none;
  overflow: hidden;
}
/***************Strat****************/

h1{
  font-size: 30px;
  color: #fff;
  font-weight: 300;
  text-align: center;
  margin-bottom: 15px;
}
table{
    table-layout: fixed;
	color: #fff;
}

td{
	color: #fff;
    word-wrap:break-word
}
.pakebutton {
        cursor: pointer;
        border: 0px solid #3498db;
        background-color: transparent;
        height: 30px;
        width: 200px;
        color: #3498db;
        font-size: 1.0em;
        box-shadow: 0 0px 0px rgba(0, 0, 0, 0.6);
}
.login-box {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 400px;
  padding: 40px;
  transform: translate(-50%, -50%);
  background: rgba(0,0,0,.5);
  box-sizing: border-box;
  box-shadow: 0 15px 25px rgba(0,0,0,.6);
  border-radius: 10px;
}

.login-box h2 {
  margin: 0 0 30px;
  padding: 0;
  color: #fff;
  text-align: center;
}

.login-box .user-box {
  position: relative;
}

.login-box .user-box input {
  width: 100%;
  padding: 10px 0;
  font-size: 16px;
  color: #fff;
  margin-bottom: 30px;
  border: none;
  border-bottom: 1px solid #fff;
  outline: none;
  background: transparent;
}
.login-box .user-box label {
  position: absolute;
  top:0;
  left: 0;
  padding: 10px 0;
  font-size: 16px;
  color: #fff;
  pointer-events: none;
  transition: .5s;
}

.login-box .user-box input:focus ~ label,
.login-box .user-box input:valid ~ label {
  top: -20px;
  left: 0;
  color: #03e9f4;
  font-size: 12px;
}

.login-box form a {
  position: relative;
  display: inline-block;
  padding: 10px 20px;
  color: #03e9f4;
  font-size: 16px;
  text-decoration: none;
  text-transform: uppercase;
  overflow: hidden;
  transition: .5s;
  margin-top: 10px;
  letter-spacing: 4px
}

.login-box a:hover {
  background: #03e9f4;
  color: #fff;
  border-radius: 5px;
  box-shadow: 0 0 5px #03e9f4,
              0 0 25px #03e9f4,
              0 0 50px #03e9f4,
              0 0 100px #03e9f4;
}

.login-box a span {
  position: absolute;
  display: block;
}

.login-box a span:nth-child(1) {
  top: 0;
  left: -100%;
  width: 100%;
  height: 2px;
  background: linear-gradient(90deg, transparent, #03e9f4);
  animation: btn-anim1 1s linear infinite;
}

@keyframes btn-anim1 {
  0% {
    left: -100%;
  }
  50%,100% {
    left: 100%;
  }
}

.login-box a span:nth-child(2) {
  top: -100%;
  right: 0;
  width: 2px;
  height: 100%;
  background: linear-gradient(180deg, transparent, #03e9f4);
  animation: btn-anim2 1s linear infinite;
  animation-delay: .25s
}

@keyframes btn-anim2 {
  0% {
    top: -100%;
  }
  50%,100% {
    top: 100%;
  }
}

.login-box a span:nth-child(3) {
  bottom: 0;
  right: -100%;
  width: 100%;
  height: 2px;
  background: linear-gradient(270deg, transparent, #03e9f4);
  animation: btn-anim3 1s linear infinite;
  animation-delay: .5s
}

@keyframes btn-anim3 {
  0% {
    right: -100%;
  }
  50%,100% {
    right: 100%;
  }
}

.login-box a span:nth-child(4) {
  bottom: -100%;
  left: 0;
  width: 2px;
  height: 100%;
  background: linear-gradient(360deg, transparent, #03e9f4);
  animation: btn-anim4 1s linear infinite;
  animation-delay: .75s
}

@keyframes btn-anim4 {
  0% {
    bottom: -100%;
  }
  50%,100% {
    bottom: 100%;
  }
}    
/***************End****************/
.a_demo_four {
	background-color:#3bb3e0;
	font-family: 'Open Sans', sans-serif;
	font-size:12px;
	text-decoration:none;
	color:#fff;
	position:relative;
	padding:10px 20px;
	padding-right:50px;
	background-image: linear-gradient(bottom, rgb(44,160,202) 0%, rgb(62,184,229) 100%);
	background-image: -o-linear-gradient(bottom, rgb(44,160,202) 0%, rgb(62,184,229) 100%);
	background-image: -moz-linear-gradient(bottom, rgb(44,160,202) 0%, rgb(62,184,229) 100%);
	background-image: -webkit-linear-gradient(bottom, rgb(44,160,202) 0%, rgb(62,184,229) 100%);
	background-image: -ms-linear-gradient(bottom, rgb(44,160,202) 0%, rgb(62,184,229) 100%);
	background-image: -webkit-gradient(
	linear,
	left bottom,
	left top,
	color-stop(0, rgb(44,160,202)),
	color-stop(1, rgb(62,184,229))
	);
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	-o-border-radius: 5px;
	border-radius: 5px;
	-webkit-box-shadow: inset 0px 1px 0px #2ab7ec, 0px 5px 0px 0px #156785, 0px 10px 5px #999;
	-moz-box-shadow: inset 0px 1px 0px #2ab7ec, 0px 5px 0px 0px #156785, 0px 10px 5px #999;
	-o-box-shadow: inset 0px 1px 0px #2ab7ec, 0px 5px 0px 0px #156785, 0px 10px 5px #999;
	box-shadow: inset 0px 1px 0px #2ab7ec, 0px 5px 0px 0px #156785, 0px 10px 5px #999;
}

.a_demo_four:active {
	top:3px;
	background-image: linear-gradient(bottom, rgb(62,184,229) 0%, rgb(44,160,202) 100%);
	background-image: -o-linear-gradient(bottom, rgb(62,184,229) 0%, rgb(44,160,202) 100%);
	background-image: -moz-linear-gradient(bottom, rgb(62,184,229) 0%, rgb(44,160,202) 100%);
	background-image: -webkit-linear-gradient(bottom, rgb(62,184,229) 0%, rgb(44,160,202) 100%);
	background-image: -ms-linear-gradient(bottom, rgb(62,184,229) 0%, rgb(44,160,202) 100%);
	background-image: -webkit-gradient(
	linear,
	left bottom,
	left top,
	color-stop(0, rgb(62,184,229)),
	color-stop(1, rgb(44,160,202))
	);
	-webkit-box-shadow: inset 0px 1px 0px #2ab7ec, 0px 2px 0px 0px #156785, 0px 5px 3px #999;
	-moz-box-shadow: inset 0px 1px 0px #2ab7ec, 0px 2px 0px 0px #156785, 0px 5px 3px #999;
	-o-box-shadow: inset 0px 1px 0px #2ab7ec, 0px 2px 0px 0px #156785, 0px 5px 3px #999;
	box-shadow: inset 0px 1px 0px #2ab7ec, 0px 2px 0px 0px #156785, 0px 5px 3px #999;
}

.a_demo_four::before {
	background-color:#2591b4;
	background-image:url(./images/right_arrow.png);
	background-repeat:no-repeat;
	background-position:center center;
	content:"";
	width:20px;
	height:20px;
	position:absolute;
	right:15px;
	top:50%;
	margin-top:-9px;
	-webkit-border-radius: 50%;
	-moz-border-radius: 50%;
	-o-border-radius: 50%;
	border-radius: 50%;
	-webkit-box-shadow: inset 0px 1px 0px #052756, 0px 1px 0px #60c9f0;
	-moz-box-shadow: inset 0px 1px 0px #052756, 0px 1px 0px #60c9f0;
	-o-box-shadow: inset 0px 1px 0px #052756, 0px 1px 0px #60c9f0;
	box-shadow: inset 0px 1px 0px #052756, 0px 1px 0px #60c9f0;
}

.a_demo_four:active::before {
	top:50%;
	margin-top:-12px;
	-webkit-box-shadow: inset 0px 1px 0px #60c9f0, 0px 3px 0px #0e3871, 0px 6px 3px #1a80a6;
	-moz-box-shadow: inset 0px 1px 0px #60c9f0, 0px 3px 0px #0e3871, 0px 6px 3px #1a80a6;
	-o-box-shadow: inset 0px 1px 0px #60c9f0, 0px 3px 0px #0e3871, 0px 6px 3px #1a80a6;
	box-shadow: inset 0px 1px 0px #60c9f0, 0px 3px 0px #0e3871, 0px 6px 3px #1a80a6;
}
.main-header {
    top: 0;
    left: 0;
    z-index: 20;
    -webkit-transform: translate3d(0,0,0);
    height: 70px;
    width: 100%;
    bottom: inherit;
    text-align: center;
    background: rgba(28, 31, 47, 0.16);
    overflow: hidden;
    border: 1px solid #2e344d;
    -webkit-transition: all 0.3s ease-in-out 0s;
    -moz-transition: all 0.3s ease-in-out 0s;
    -ms-transition: all 0.3s ease-in-out 0s;
    -o-transition: all 0.3s ease-in-out 0s;
    transition: all 0.3s ease-in-out 0s;
    box-shadow: 10px 10px 36px rgb(0,0,0,0.5), -13px -13px 23px rgba(255,255,255, 0.03);
    border-width: 1px 0px 0 1px;
}
body .vertical-centered-box {
  position: absolute;
  width: 100%;
  height: 100%;
  text-align: center;
}
body .vertical-centered-box:after {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -0.25em;
}
body .vertical-centered-box .content {
  box-sizing: border-box;
  display: inline-block;
  vertical-align: middle;
  text-align: left;
  font-size: 0;
}
* {
  transition: all .3s;
}
body {
  background: #2c2d44;
}
.loader-circle {
  position: absolute;
  left: 50%;
  top: 50%;
  width: 120px;
  height: 120px;
  border-radius: 50%;
  box-shadow: inset 0 0 0 1px rgba(255,255,255,0.1);
  margin-left: -60px;
  margin-top: -60px;
}
.loader-line-mask {
  position: absolute;
  left: 50%;
  top: 50%;
  width: 60px;
  height: 120px;
  margin-left: -60px;
  margin-top: -60px;
  overflow: hidden;
  transform-origin: 60px 60px;
  -webkit-mask-image: -webkit-linear-gradient(top,#000000,rgba(0,0,0,0));
  animation: rotate 1.2s infinite linear;
}
.loader-line-mask .loader-line {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  box-shadow: inset 0 0 0 1px rgba(255,255,255,0.5);
}
#particles-background,
#particles-foreground {
  left: -51%;
  top: -51%;
  width: 202%;
  height: 202%;
  transform: scale3d(.5,.5,1);
}
#particles-background {
  background: #2c2d44;
  background-image: -moz-linear-gradient(45deg,#3f3251 2%,#002025 100%);
  background-image: -webkit-linear-gradient(45deg,#3f3251 2%,#002025 100%);
  background-image: linear-gradient(45deg,#3f3251 2%,#002025 100%);
}
@keyframes rotate {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
@keyframes fade {
  0% {
    opacity: 1;
  }
  50% {
    opacity: 0.25;
  }
}
@keyframes fade-in {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
</style>
</body>
</html>