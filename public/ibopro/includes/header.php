<?php
session_start();
if (!isset($_SESSION['eggzie_iboPlayer'])) {
    header('Location: login.php');
    exit();
}

$IIIIIIIlI1lI = $_SESSION['id'];
$IIIIIIIlI1ll = new SQLite3('./a/.eggziepanels.db');
$adb = new SQLite3('./api/.adb.db');
$IIIIIIIlI1l1 = $IIIIIIIlI1ll->query('SELECT * FROM USERS WHERE id=\'1\'')->fetchArray();
$IIIIIIIlI11l = $IIIIIIIlI1l1['NAME'];
$IIIIIIIlI111 = $IIIIIIIlI1l1['LOGO'];

    $IIIIIIIllIII = file_get_contents('./includes/eggzie.json');
    $IIIIIIIllIIl = json_decode($IIIIIIIllIII, true);
    $IIIIIIIllII1 = $IIIIIIIllIIl['info']['aa'];
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="google" content="notranslate">
    <title>Ultra IBO</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-<?php echo $IIIIIIIllII1; ?>.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.min.css"/>
    
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
</head>
<body id="page-top">
    
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="colour.php">
                <div class="sidebar-brand-icon">
                    <img class="img-profile" width="65px" src="<?php echo $IIIIIIIlI111 ?? 'img/logo.png'; ?>">
                </div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item -->
            <li class="nav-item">
                <a class="nav-link" href="users.php">
                    <i class="fas fa-fw fa-user-plus"></i>
                    <span>Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fa fa-cogs"></i>
                    <span>Widget Settings</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Background Setting:</h6>
                        <a class="collapse-item" href="UI_Setting.php"><i class="fa fa-check-square-o"></i><span> Widget Selector</span></a>
                        <a class="collapse-item" href="ads.php"><i class="fa fa-file-image-o"></i><span> Ads</span></a>
                        <a class="collapse-item" href="intro.php"><i class="fa fa-television"></i><span> Channel</span></a>
                        <a class="collapse-item" href="Sport.php"><i class="fa fa-futbol-o"></i><span>Sports</span></a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Image.php">
                    <i class="fa fa-picture-o"></i>
                    <span>Background images</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logo.php">
                    <i class="fa fa-smile-o"></i>
                    <span>Change Logo</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="layouts.php">
                    <i class="fa fa-hospital-o"></i>
                    <span>Themes</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="update.php">
                    <i class="fas fa-fw fa fa-refresh"></i>
                    <span>Apk Update</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="snoop.php">
                    <i class="fas fa-fw fa-eye"></i>
                    <span>Snoop</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="profile.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://t.me/rebrandsmx">
                    <i class="fas fa-fw fa-user"></i>
                    <span>RebrandsMX</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <i class="fas fa-fw fa fa-sign-out"></i>
                    <span>Logout</span>
                </a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->
        
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light  topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div>
                        <h5 class="m-0 text-primary">IBO Player Pro <a href="#">(PrimeTime)</a><br><?php echo $IIIIIIIlI11l; ?></h5>
                    </div>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="logout.php">
                                <span class="badge badge-danger">Logout</span>
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-red-400"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
