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

if (!isset($_SESSION['name'])) {
    header("Location: index.php");
    exit;
}

$log_check = $db->select('users', '*', 'id = :id', '', [':id' => 1]);
$loggedinuser = !empty($log_check) ? $log_check[0]['username'] : null;

if ($_SESSION['name'] !== $loggedinuser) {
    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="WCTV IBO 3.8">
	<title>TELAIBO 4.1</title> <!-- Adicionado para definir o título da aba do navegador -->
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

  <div class="d-flex" id="wrapper">
	<!-- Sidebar-->
	<div class="" id="sidebar-wrapper">
	  <div class="sidebar-heading">TELAIBO 4.1 </div>
	  <span><a class="list-grup-item" href="https://t.me/apexm3dia" target="_blank">&nbsp&nbsp&nbsp&nbsp&#169  <?=date("Y")?> * TELAIBO 4.1 * </a> </span></center>
	  <div class="list-group list-group-flush">
	       
          <a class="list-group-item list-group-item-action" href="dns.php">
                    <i class="fa fa-cogs"></i>&nbsp;&nbsp; Adicionar DNS
                </a>
                <a class="list-group-item list-group-item-action" href="playlists.php">
                    <i class="fa fa-user"></i>&nbsp;&nbsp; Usuários MAC
                </a>
                <a class="list-group-item list-group-item-action" href="gestor.php">
                    <i class="fa fa-user"></i>&nbsp;&nbsp; Gestor
                </a>
                <a class="list-group-item list-group-item-action" href="expirando.php">
                    <i class="fa fa-user"></i>&nbsp;&nbsp; Expirando
                </a>
                <a class="list-group-item list-group-item-action" href="themes.php">
                    <i class="fa fa-paint-brush"></i>&nbsp;&nbsp; Layout
                </a>
                <a class="list-group-item list-group-item-action" href="settings.php">
                    <i class="fa fa-cog"></i>&nbsp;&nbsp; Descrição da tela de MAC
                </a>
                <a class="list-group-item list-group-item-action" href="qr.php">
                    <i class="fa fa-qrcode"></i>&nbsp;&nbsp; Pagina listas
                </a>
                <a class="list-group-item list-group-item-action" href="qrlogin.php">
                    <i class="fa fa-lock"></i>&nbsp;&nbsp; Pagina login
                </a>
                <a class="list-group-item list-group-item-action" href="fundo.php">
                    <i class="fa fa-image"></i>&nbsp;&nbsp; Banners
                </a>
                <a class="list-group-item list-group-item-action" href="tipo.php">
                    <i class="fa fa-list-alt"></i>&nbsp;&nbsp; Tipos de banners
                </a>
                <a class="list-group-item list-group-item-action" href="fundoo.php">
                    <i class="fa fa-cogs"></i>&nbsp;&nbsp; Banners aba jogos
                </a>
                <a class="list-group-item list-group-item-action" href="siteesportes.php">
                    <i class="fa fa-gamepad"></i>&nbsp;&nbsp; Pagina na aba jogos
                </a>
                <a class="list-group-item list-group-item-action" href="tipo2.php">
                    <i class="fa fa-tachometer-alt"></i>&nbsp;&nbsp; O que mostrar na aba jogos
                </a>
                <a class="list-group-item list-group-item-action" href="site.php">
                    <i class="fa fa-globe"></i>&nbsp;&nbsp; Pagina web
                </a>
                <a class="list-group-item list-group-item-action" href="mRTXinAppText.php">
                    <i class="fa fa-comment-dots"></i>&nbsp;&nbsp; Mensagens
                </a>
                <a class="list-group-item list-group-item-action" href="mRTXBGlogo.php">
                    <i class="fa fa-image"></i>&nbsp;&nbsp; Alterar logo
                </a>
                <a class="list-group-item list-group-item-action" href="mRTXBGImage.php">
                    <i class="fa fa-image"></i>&nbsp;&nbsp; Alterar fundo
                </a>
                <a class="list-group-item list-group-item-action" href="tipodefundo.php">
                    <i class="fa fa-palette"></i>&nbsp;&nbsp; Tipo de fundo
                </a>
                <a class="list-group-item list-group-item-action" href="user.php">
                    <i class="fa fa-user"></i>&nbsp;&nbsp; Conta
                </a>
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
