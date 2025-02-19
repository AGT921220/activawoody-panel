<?php
session_start();
if (!isset($_SESSION['eggzie_iboPlayer'])) {
    header('location:login.php');
    exit();
}
$IIIIIIIlI1lI = $_SESSION['id'];
$IIIIIIIlI1ll = new SQLite3('./a/.eggziepanels.db');
$adb = new SQLite3('./api/.adb.db');
$IIIIIIIlI1l1 = $IIIIIIIlI1ll->query('SELECT * FROM USERS WHERE id=\'1\'');
$IIIIIIIlI11I = $IIIIIIIlI1l1->fetchArray();
$IIIIIIIlI11l = $IIIIIIIlI11I['NAME'];
$IIIIIIIlI111 = $IIIIIIIlI11I['LOGO'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
$IIIIIIIllIII = file_get_contents('./includes/eggzie.json');
$IIIIIIIllIIl = json_decode($IIIIIIIllIII, true);
$IIIIIIIllII1 = $IIIIIIIllIIl['info'];
$IIIIIIIllIlI = $IIIIIIIllII1['aa'];
echo '  <meta charset="utf-8">' . "
";
echo '  <meta http-equiv="X-UA-Compatible" content="IE=edge">' . "
";
echo '  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">' . "
";
echo '  <meta name="description" content="">' . "
";
echo '  <meta name="author" content="">' . "
";
echo '  <meta name="google" content="notranslate">' . "
";
echo '  <script src="https://kit.fontawesome.com/3794d2f89f.js" crossorigin="anonymous"></script>' . "
";
echo '  <title>Ultra IBO</title>' . "
";
echo '  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">' . "
";
echo '  <link rel="icon" href="favicon.ico" type="image/x-icon">' . "
";
echo '  <!-- Custom styles for this template-->' . "
";
echo '  <link href="css/sb-admin-' . $IIIIIIIllIlI . '.css" rel="stylesheet">' . "
";
echo '  <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.min.css"/>' . "
";
echo '  <!-- Custom fonts for this template-->' . "
";
echo '  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">' . "
";
echo '  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">' . "
";
echo ' ' . "
";
echo '</head> ' . "
";
echo '<body id="page-top">' . "
";
echo "
";
echo '  <!-- Page Wrapper -->' . "
";
echo '  <div id="wrapper">' . "
";
echo "
";
echo '    <!-- Sidebar -->' . "
";
echo '    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">' . "
";
echo "
";
if ($IIIIIIIlI111 != NULL) {
    echo '      <!-- Sidebar - Brand -->' . "
";
    echo '      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="colour.php">' . "
";
    echo '        <div class="sidebar-brand-icon">' . "
";
    echo '          <img class="img-profile" width="65px" src="' . $IIIIIIIlI111 . '">' . "
";
    echo '        </div>' . "
";
} else {
    echo '      <!-- Sidebar - Brand -->' . "
";
    echo '      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="colour.php">' . "
";
    echo '        <div class="sidebar-brand-icon">' . "
";
    echo '          <img class="img-profile" width="65px" src="img/logo.png">' . "
";
    echo '        </div>' . "
";
}
echo "
";
echo '      </a>' . "
";
echo "
";
echo '      <!-- Divider -->' . "
";
echo '      <hr class="sidebar-divider my-0">' . "
";
echo "
";
echo '      <!-- Nav Item -->' . "
";
echo '      <li class="nav-item">' . "
";
echo '        <a class="nav-link" href="users.php">' . "
";
echo '          <i class="fas fa-fw fa-user-plus"></i>' . "
";
echo '          <span>Users</span></a>' . "
";
echo '      </li>' . "

";
echo '      <li class="nav-item">' . "
";
echo '        <a class="nav-link" href="update.php">' . "
";
echo '          <i class="fas fa-fw fa fa-refresh"></i>' . "
";
echo '          <span>Apk Update</span></a>' . "
";
echo '      </li>' . "
";
echo "
";
echo '      <li class="nav-item">' . "
";
echo '        <a class="nav-link" href="snoop.php">' . "
";
echo '          <i class="fas fa-fw fa-eye"></i>' . "
";
echo '          <span>Snoop</span></a>' . "
";
echo '      </li>' . "
";
echo '      ' . "
";
echo '      <li class="nav-item">' . "
";
echo '        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">' . "
";
echo '          <i class="fa fa-picture-o"></i>' . "
";
echo '          <span>Backgrund</span>' . "
";
echo '        </a>' . "
";
echo '        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">' . "
";
echo '        <div class="bg-white py-2 collapse-inner rounded">' . "
";
echo '            <h6 class="collapse-header">Backgrund Setting:</h6>' . "
";
echo '        <a class="collapse-item" href="mRTXBGImage.php"><i class="fa fa-file-image-o"></i><span> Image Background</span></a>' . "
";
echo '        <a class="collapse-item" href="mRTXBGGradint.php"><i class="fa fa-file-image-o"></i><span> Gradent Background</span></a>' . "
";
echo '          </div>' . "
";
echo '        </div>' . "
";
echo '      </li>' . "
";
echo '      <li class="nav-item">' . "
";
echo '        <a class="nav-link" href="mRTXBGlogo.php">' . "
";
echo '          <i class="fa fa-smile-o"></i>' . "
";
echo '          <span>Change Logo</span></a>' . "
";
echo '      </li>' . "
";
echo '      ' . "
";
echo '      <li class="nav-item">' . "
";
echo '        <a class="nav-link" href="mRTXBGads.php">' . "
";
echo '          <i class="fa fa-snowflake-o"></i>' . "
";
echo '          <span>Ads</span></a>' . "
";
echo '      </li>' . "
";
echo '      ' . "
";
echo '      <li class="nav-item">' . "
";
echo '        <a class="nav-link" href="mRTXBGlayouts.php">' . "
";
echo '          <i class="fa fa-themeisle"></i>' . "
";
echo '          <span>Layout</span></a>' . "
";
echo '      </li>' . "
";
echo '      ' . "
";
echo '      <li class="nav-item">' . "
";
echo '        <a class="nav-link" href="mRTXBGSport.php">' . "
";
echo '          <i class="fa fa-futbol-o"></i>' . "
";
echo '          <span>Sport</span></a>' . "
";
echo '      </li>' . "
";
echo '      ' . "
";
echo '      <li class="nav-item">' . "
";
echo '        <a class="nav-link" href="profile.php">' . "
";
echo '          <i class="fas fa-fw fa-user"></i>' . "
";
echo '          <span>Profile</span></a>' . "
";
echo '      </li>' . "
";
echo '      ' . "
";
echo '      <li class="nav-item">' . "
";
echo '        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">' . "
";
echo '          <i class="fas fa-fw fa-cloud"></i>' . "
";
echo '          <span>Cloud</span>' . "
";
echo '        </a>' . "
";
echo '        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">' . "
";
echo '        <div class="bg-white py-2 collapse-inner rounded">' . "
";
echo '            <h6 class="collapse-header">Cloud Uploads:</h6>' . "
";
echo '        <a class="collapse-item" href="https://db.tt" target="_blank"><i class="fas fa-fw fa-share"></i><span> DropBox</span></a>' . "
";
echo '        <a class="collapse-item" href="https://mega.nz/" target="_blank"><i class="fas fa-fw fa-share"></i><span> Mega</span></a>' . "
";
echo '          </div>' . "
";
echo '        </div>' . "
";
echo '      </li>' . "
";
echo "
";
echo '      <li class="nav-item">' . "
";
echo '        <a class="nav-link" href="logout.php">' . "
";
echo '          <i class="fas fa-fw fa fa-sign-out"></i>' . "
";
echo '          <span>Logout</span></a>' . "
";
echo '      </li>' . "
";
echo '      ' . "
";
echo '      <!-- Divider -->' . "
";
echo '      <hr class="sidebar-divider d-none d-md-block">' . "
";
echo "
";
echo '      <!-- Sidebar Toggler (Sidebar) -->' . "
";
echo '      <div class="text-center d-none d-md-inline">' . "
";
echo '        <button class="rounded-circle border-0" id="sidebarToggle"></button>' . "
";
echo '      </div>' . "
";
echo "
";
echo '    </ul>' . "
";
echo '    <!-- End of Sidebar -->' . "
";
echo "
";
echo '    <!-- Content Wrapper -->' . "
";
echo '    <div id="content-wrapper" class="d-flex flex-column">' . "
";
echo "
";
echo '      <!-- Main Content -->' . "
";
echo '      <div id="content">' . "
";
echo "
";
echo '        <!-- Topbar -->' . "
";
echo '        <nav class="navbar navbar-expand navbar-light  topbar mb-4 static-top shadow">' . "
";
echo "
";
echo '          <!-- Sidebar Toggle (Topbar) -->' . "
";
echo '          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">' . "
";
echo '            <i class="fa fa-bars"></i>' . "
";
echo '          </button>' . "
";
echo '<div><h5 class="m-0 text-primary">IBO Player Pro <a href="https://t.me/Newvision310">(PrimeTime)</a><br>' . $IIIIIIIlI11l . ' </br></h5></div>' . "
";
echo "
";
echo '          <!-- Topbar Navbar -->' . "
";
echo '          <ul class="navbar-nav ml-auto">' . "
";
echo "
";
echo "
";
echo '            <div class="topbar-divider d-none d-sm-block"></div>' . "
";
echo "
";
echo '            <!-- Nav Item - Logout -->' . "
";
echo '            <li class="nav-item dropdown no-arrow mx-1">' . "
";
echo '              <a class="nav-link dropdown-toggle" href="logout.php"><span class="badge badge-danger">Logout</span>' . "
";
echo '                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-red-400"></i>' . "
";
echo '              </a>' . "
";
echo '            </li>' . "
";
echo "
";
echo '          </ul>' . "
";
echo "
";
echo '        </nav>' . "
";
echo '        <!-- End of Topbar -->' . "
";
echo "
";