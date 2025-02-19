<?php
session_start();
$dbFile = dirname(__file__) . "/includes/db.php";
include($dbFile);
if ($isInstalled && $dbIsLatest) {
  header("Location: index.php");
  exit;
}
if (isset($_POST['install'])) {
  session_destroy();
  session_start();
  $queryList = array();
  $queryList[] = array('version' => 1, 'query' => "CREATE TABLE `ads` ( `id` int(11) NOT NULL AUTO_INCREMENT, `path` varchar(100) DEFAULT NULL, `active` tinyint(1) DEFAULT NULL, `name` varchar(100) DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;");
  $queryList[] = array('version' => 1, 'query' => "CREATE TABLE `dns` ( `id` int(11) NOT NULL AUTO_INCREMENT, `url` varchar(255) DEFAULT NULL, `active` tinyint(1) DEFAULT NULL, `name` varchar(100) DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;");
  $queryList[] = array('version' => 1, 'query' => "CREATE TABLE `dns_sessions` ( `id` int(11) NOT NULL AUTO_INCREMENT, `dns_id` int(11) DEFAULT NULL, `date_added` datetime DEFAULT NULL, `last_used` datetime DEFAULT NULL, `username` varchar(100) DEFAULT NULL, `password_hash` varchar(255) DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;");
  $queryList[] = array('version' => 1, 'query' => "CREATE TABLE `intro` ( `path` varchar(255) DEFAULT NULL, `active` tinyint(1) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
  $queryList[] = array('version' => 1, 'query' => "INSERT INTO `intro` VALUES ('intro.mp4',1);");
  $queryList[] = array('version' => 1, 'query' => "CREATE TABLE `notifications` ( `id` int(11) NOT NULL AUTO_INCREMENT, `notification_text` text, `active` tinyint(1) DEFAULT NULL, `notification_title` varchar(255) DEFAULT NULL, `date_added` datetime DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;");
  $queryList[] = array('version' => 1, 'query' => "CREATE TABLE `users` ( `id` int(11) NOT NULL AUTO_INCREMENT, `username` varchar(255) DEFAULT NULL, `password_hash` varchar(255) DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;");
  $queryList[] = array('version' => 1, 'query' => "CREATE TABLE `vpn` (`id` int(11) NOT NULL AUTO_INCREMENT, `location` varchar(100) DEFAULT NULL, `path` varchar(255) DEFAULT NULL, `active` tinyint(1) DEFAULT NULL, `auth_type` varchar(100) DEFAULT NULL, `username` varchar(100) DEFAULT NULL, `password` varchar(100) DEFAULT NULL, `date_added` datetime DEFAULT NULL, `auth_embedded` tinyint(1) DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;");
  $queryList[] = array('version' => 1, 'query' => "CREATE TABLE `xciptv_options` ( `app_name` varchar(100) DEFAULT NULL, `app_build` varchar(100) DEFAULT NULL, `app_identifier` varchar(100) DEFAULT NULL, `login_type` varchar(100) DEFAULT NULL, `login_accounts_button` tinyint(1) DEFAULT NULL, `log_settings_button` tinyint(1) DEFAULT NULL, `announcements` tinyint(1) DEFAULT NULL, `messages` tinyint(1) DEFAULT NULL, `update_user_info` tinyint(1) DEFAULT NULL, `developer_name` varchar(100) DEFAULT NULL, `developer_contact` varchar(100) DEFAULT NULL, `signup_url` varchar(255) DEFAULT NULL, `login_logo` tinyint(1) DEFAULT NULL, `app_logs` tinyint(1) DEFAULT NULL, `category_count` tinyint(1) DEFAULT NULL, `user_agent` varchar(255) DEFAULT NULL, `load_last_channel` tinyint(1) DEFAULT NULL, `show_live` tinyint(1) DEFAULT NULL, `show_epg` tinyint(1) DEFAULT NULL, `show_vod` tinyint(1) DEFAULT NULL, `show_series` tinyint(1) DEFAULT NULL, `show_catchup` tinyint(1) DEFAULT NULL, `show_radio` tinyint(1) DEFAULT NULL, `show_multi` tinyint(1) DEFAULT NULL, `show_favorite` tinyint(1) DEFAULT NULL, `show_account` tinyint(1) DEFAULT NULL, `show_reminders` tinyint(1) DEFAULT NULL, `show_record` tinyint(1) DEFAULT NULL, `show_vpn` tinyint(1) DEFAULT NULL, `show_message` tinyint(1) DEFAULT NULL, `show_update` tinyint(1) DEFAULT NULL, `show_expiry` tinyint(1) DEFAULT NULL, `exo_buffer` varchar(100) DEFAULT NULL, `exo_zoom` varchar(100) DEFAULT NULL, `exo_hw` tinyint(1) DEFAULT NULL, `exo_subtitles` tinyint(1) DEFAULT NULL, `exo_volume` varchar(100) DEFAULT NULL, `vlc_buffer` varchar(100) DEFAULT NULL, `vlc_zoom` varchar(100) DEFAULT NULL, `vlc_hw` tinyint(1) DEFAULT NULL, `vlc_subtitles` tinyint(1) DEFAULT NULL, `vlc_volume` varchar(100) DEFAULT NULL, `player_live` varchar(100) DEFAULT NULL, `player_epg` varchar(100) DEFAULT NULL, `player_vod` varchar(100) DEFAULT NULL, `player_series` varchar(100) DEFAULT NULL, `proxy_traffic` tinyint(1) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
  $queryList[] = array('version' => 1, 'query' => "INSERT INTO `xciptv_options` VALUES ('XCIPTV','803','521064','login',1,1,1,1,1,'AndyHax','AndyHax','',1,1,1,'XCIPTV',1,1,1,1,1,0,0,1,1,1,0,1,1,1,1,1,'40000','3',1,0,'100','3000','3',1,0,'100','EXO','EXO','EXO','EXO',0);");
  $queryList[] = array('version' => 2, 'query' => "CREATE TABLE `config` (`dbversion` int(11) DEFAULT NULL ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
  $queryList[] = array('version' => 2, 'query' => "INSERT INTO `config` VALUES (2);");
  $queryList[] = array('version' => 4, 'query' => "ALTER TABLE xciptv_options ADD theme varchar(100) NULL;");
  $queryList[] = array('version' => 4, 'query' => "ALTER TABLE xciptv_options ADD licv4_method int NULL;");
  $queryList[] = array('version' => 4, 'query' => "ALTER TABLE xciptv_options ADD licv3_key varchar(100) NULL;");
  $queryList[] = array('version' => 4, 'query' => "ALTER TABLE xciptv_options ADD licv3_iv varchar(100) NULL;");
  $queryList[] = array('version' => 4, 'query' => "UPDATE xciptv_options SET theme = 'd', licv4_method = 1, licv3_key = 'mysecretkeywsdef', licv3_iv = 'myuniqueivparamu';");
  $queryList[] = array('version' => 4, 'query' => "ALTER TABLE config ADD panel_root varchar(255) NULL;");
  $queryList[] = array('version' => 5, 'query' => "CREATE TABLE `messages` (`id` int(11) NOT NULL AUTO_INCREMENT,`text` text,`active` tinyint(1) DEFAULT NULL,`user` varchar(255) DEFAULT NULL,`date_added` datetime DEFAULT NULL,PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
  $queryList[] = array('version' => 6, 'query' => "CREATE TABLE `sports_options` (api_key varchar(100) NULL,header_name varchar(100) NULL,border_colour varchar(100) NULL,background_colour varchar(100) NULL,text_colour varchar(100) NULL)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");
  $queryList[] = array('version' => 6, 'query' => "INSERT INTO sports_options (api_key, header_name, border_colour, background_colour, text_colour) VALUES('1', '', '#000000', '#000000', '#FFFFFF');");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_catchup2 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_catchup3 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_catchup4 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_catchup5 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_live2 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_live3 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_live4 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_live5 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_epg2 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_epg3 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_epg4 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_epg5 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_vod2 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_vod3 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_vod4 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_vod5 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_series2 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_series3 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_series4 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_series5 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_radio2 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_radio3 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_radio4 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_radio5 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_multi2 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_multi3 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_multi4 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_multi5 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_favorite2 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_favorite3 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_favorite4 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_favorite5 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_account2 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_account3 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_account4 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 6, 'query' => "ALTER TABLE xciptv_options ADD show_account5 tinyint(1) DEFAULT 1;");
  $queryList[] = array('version' => 9, 'query' => "ALTER TABLE vpn ADD country varchar(255) NULL;");
  $queryList[] = array('version' => 9, 'query' => "ALTER TABLE xciptv_options ADD support_email varchar(255) NULL;");
  $queryList[] = array('version' => 9, 'query' => "ALTER TABLE xciptv_options ADD support_phone varchar(255) NULL;");
  $queryList[] = array('version' => 10, 'query' => "ALTER TABLE xciptv_options ADD app_language varchar(100) NULL;");
  $queryList[] = array('version' => 10, 'query' => "UPDATE xciptv_options SET app_language = 'en';");
  
  $queryList[] = array('version' => 100000, 'query' => "UPDATE config SET dbversion = " . $expectedVersion . ";");
  $randPass = randomPassword();
  $hash = password_hash($randPass, PASSWORD_DEFAULT);
  $queryList[] = array('version' => 1, 'query' => "INSERT INTO `users` (username, password_hash) VALUES ('admin', '" . $hash  . "');");
  if (!$isInstalled) {
    $_SESSION['installmessage'] = "OnePanel has been installed. You can log in with the username <b>admin</b> and the password <b>" . $randPass . "</b><br/>Please make a note of this password now as it will disappear if the page is refreshed. You should change this once logged in";
  } else {
    $_SESSION['installmessage'] = "OnePanel has been updated";
  }
  //execute queries
  foreach ($queryList as $query) {
    if ($query['version'] > $insVersion) {
      $mysqli->query($query['query']);
    }
  }
  $query = $mysqli->prepare("UPDATE config SET panel_root = ?");
  $query->bind_param("s", $_POST['onepanel_root']);
  $query->execute();
  header("Location: index.php");
  exit;
}
function randomPassword()
{
  $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
  $pass = array();
  $alphaLength = strlen($alphabet) - 1;
  for ($i = 0; $i < 10; $i++) {
    $n = rand(0, $alphaLength);
    $pass[] = $alphabet[$n];
  }
  return implode($pass);
}
$showButton = false;
if ($dbConnected) {
  $message = "OnePanel is ready to install to database <b>$dbname</b>, click GO to build the database";
  $showButton = true;
} else {
  $message = "OnePanel cannot connect to the database, please create an empty database and edit the <b>includes/db.php</b> file with the details, then refresh this page.";
}
?>
<!--
=========================================================
* Material Dashboard 2 - v3.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="180x180" href="assets/fav/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/fav/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/fav/favicon-16x16.png">
  <link rel="manifest" href="site.webmanifest">
  <link rel="mask-icon" href="assets/fav/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <title>
    OnePanel
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.min.css?v=3.0.4" rel="stylesheet" />
</head>

<body class="bg-gray-200">
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('assets/img/bg.jpg');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-secondary shadow-dark border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Install</h4>
                </div>
              </div>
              <div class="card-body">
                <form action="" method="post" role="form" class="text-start">
                  <p class="mt-4 text-sm text-center">
                    <?php echo $message; ?>
                  </p>

                  <input type="hidden" id="onepanel_root" name="onepanel_root" class="form-control">
                  <?php
                  if ($showButton) {
                  ?>
                    <div class="text-center">
                      <button type="submit" name="install" type="button" class="btn bg-gradient-secondary w-100 my-4 mb-2">Go</button>
                    </div>
                  <?php
                  }
                  ?>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer position-absolute bottom-2 py-2 w-100">
        <div class="container">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-12 col-md-6 my-auto">
              <div class="copyright text-center text-sm text-white text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                AndyHax
              </div>
            </div>

          </div>
        </div>
      </footer>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=3.0.4"></script>
</body>
<script>
  var href = window.location.href;
  var dir = href.substring(0, href.lastIndexOf('/')) + "/";
  document.getElementById("onepanel_root").value = dir;
</script>

</html>