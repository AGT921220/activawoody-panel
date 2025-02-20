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

  <div class="d-flex" id="wrapper">
	<!-- Sidebar-->
	<div class="" id="sidebar-wrapper">
	  <div class="sidebar-heading">WCTV IBO 3.8 </div>
	  <span><a class="list-grup-item" href="https://t.me/apexm3dia" target="_blank">&nbsp&nbsp&nbsp&nbsp&#169  <?=date("Y")?> * WCTV IBO 3.8 * </a> </span></center>
	  <div class="list-group list-group-flush">
	       <div class="d-flex" id="wrapper">
    <div id="sidebar-wrapper">
        <div class="sidebar-heading"></div>
        <img src="https://i.ibb.co/Jq0CmjT/INFINITY.gif" alt="Infinity Pro Image">

        <div class="list-group">
            <a class="list-group-item <?php echo basename($_SERVER['PHP_SELF']) == 'dns.php' ? 'active' : ''; ?>" href="dns.php" title="Configuração DNS">
                <i class="fa fa-cogs"></i>&nbsp;&nbsp; Configuração DNS
            </a>

            <a class="list-group-item <?php echo basename($_SERVER['PHP_SELF']) == 'playlists.php' ? 'active' : ''; ?>" href="playlists.php" title="Usuários Conectados">
                <i class="fa fa-user"></i>&nbsp;&nbsp; Usuários Conectados
            </a>


          

            <!-- Novo item de menu com submenus -->
            <li class="nav-item">
                <a class="list-group-item collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <i class="fa fa-cogs"></i>&nbsp;&nbsp; Banners
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#sidebar-wrapper">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Configuraçoes de banners:</h6>
                        
                        <a class="collapse-item" href="fundo.php"><i class="fa fa-file-image-o"></i><span> Banners</span></a>
                        <a class="collapse-item" href="tipo.php"><i class="fa fa-television"></i><span> Tipos de banner</span></a>
                        <a class="collapse-item" href="site.php"><i class="fa fa-television"></i><span> Pagina.</span></a>
                        <
                    </div>
                </div>
            </li>
            <!-- Novo item de menu com submenus para Configurações de Aplicativo -->
            <li class="nav-item">
                <a class="list-group-item collapsed" href="#" data-toggle="collapse" data-target="#collapseAppSettings" aria-expanded="false" aria-controls="collapseAppSettings">
                    <i class="fa fa-apps"></i>&nbsp;&nbsp; Logo e Fundo
                </a>
                <div id="collapseAppSettings" class="collapse" aria-labelledby="headingAppSettings" data-parent="#sidebar-wrapper">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Configurações do Aplicativo:</h6>
                        <a class="collapse-item" href="mRTXBGlogo.php"><i class="fa fa-cogs"></i><span> Alterar logo</span></a>
                        <a class="collapse-item" href="mRTXBGImage.php"><i class="fa fa-star"></i><span> Alterar fundo</span></a>
                        <a class="collapse-item" href="tipodefundo.php"><i class="fa fa-plug"></i><span> Tipo de fundo</span></a>
                        
                    </div>
                </div>
            </li>
            <!-- Additional menu items here... -->
            <!-- Expandable menu items -->
            <li class="nav-item">
                <a class="list-group-item collapsed" href="#" data-toggle="collapse" data-target="#collapseUserSettings" aria-expanded="false" aria-controls="collapseUserSettings">
                    <i class="fa fa-user-cog"></i>&nbsp;&nbsp; QR code.
                </a>
                <div id="collapseUserSettings" class="collapse" aria-labelledby="headingUserSettings" data-parent="#sidebar-wrapper">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Configurações do Usuário:</h6>
                        <a class="collapse-item" href="qr.php"><i class="fa fa-user"></i><span> Aba listas</span></a>
                        <a class="collapse-item" href="qrlogin.php"><i class="fa fa-cogs"></i><span> Aba login</span></a>
                        <
                    </div>
                </div>
            </li>
            <!-- Novo item de menu com submenus para Configurações de Rede -->
            <li class="nav-item">
                <a class="list-group-item collapsed" href="#" data-toggle="collapse" data-target="#collapseNetworkSettings" aria-expanded="false" aria-controls="collapseNetworkSettings">
                    <i class="fa fa-network-wired"></i>&nbsp;&nbsp; Esportes
                </a>
                <div id="collapseNetworkSettings" class="collapse" aria-labelledby="headingNetworkSettings" data-parent="#sidebar-wrapper">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Configurações de Rede:</h6>
                        <a class="collapse-item" href="fundoo.php"><i class="fa fa-signal"></i><span> Banner jogos.</span></a>
                        <a class="collapse-item" href="tipo2.php"><i class="fa fa-cogs"></i><span> Pagina ou site.</span></a>
                        <a class="collapse-item" href="siteesportes.php"><i class="fa fa-shield-alt"></i><span> Site para aba jogos.</span></a>
                        
                    </div>
                </div>
            </li>
            <!-- Novo item de menu com submenus para Configurações de Sistema -->
            <li class="nav-item">
                <a class="list-group-item collapsed" href="#" data-toggle="collapse" data-target="#collapseSystemSettings" aria-expanded="false" aria-controls="collapseSystemSettings">
                    <i class="fa fa-tools"></i>&nbsp;&nbsp; Mensagens
                </a>
                <div id="collapseSystemSettings" class="collapse" aria-labelledby="headingSystemSettings" data-parent="#sidebar-wrapper">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Mensagens:</h6>
                        <a class="collapse-item" href="mRTXinAppText.php"><i class="fa fa-list-alt"></i><span> Mensagens geral.</span></a>
                        <a class="collapse-item" href="settings.php"><i class="fa fa-tachometer-alt"></i><span> Mensagem aba listas</span></a>
                        
                    </div>
                </div>
            </li>
        </div>
    </div>

    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark ">
            <button class="btn btn-primary" id="menu-toggle"><img src="img/logo.png" width="25" height="25" class="d-flex justify-content-center text-allign centre" alt=""></button>
            &nbsp;&nbsp;
            <div class="center" id="pageMessages"></div>
            <a href="logout.php" class="btn btn-danger ml-auto mr-1">Logout</a>
        </nav>

        <div class="container-fluid"><br>
