<?php function IIIIIIII1lIl() {
    $IIIIIIII1lI1 = 'undefined';
    if (isset($_SERVER)) {
        $IIIIIIII1lI1 = $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $IIIIIIII1lI1 = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $IIIIIIII1lI1 = $_SERVER['HTTP_CLIENT_IP'];
        }
    } else {
        $IIIIIIII1lI1 = getenv('REMOTE_ADDR');
        if (getenv('HTTP_X_FORWARDED_FOR')) {
            $IIIIIIII1lI1 = getenv('HTTP_X_FORWARDED_FOR');
        } else if (getenv('HTTP_CLIENT_IP')) {
            $IIIIIIII1lI1 = getenv('HTTP_CLIENT_IP');
        }
    }
    $IIIIIIII1lI1 = htmlspecialchars($IIIIIIII1lI1, ENT_QUOTES, 'UTF-8');
    return $IIIIIIII1lI1;
}
session_start();
$IIIIIIIllIII = file_get_contents('./includes/eggzie.json');
$IIIIIIIllIIl = json_decode($IIIIIIIllIII, true);
$IIIIIIIllII1 = $IIIIIIIllIIl['info'];
$IIIIIIIllIlI = $IIIIIIIllII1['aa'];
$IIIIIIIl1I1I = new SQLite3('./a/.eggziepanels.db');
$IIIIIIIl1I1I->exec('CREATE TABLE IF NOT EXISTS USERS(id INT PRIMARY KEY,NAME TEXT,USERNAME TEXT,PASSWORD TEXT,LOGO TEXT)');
$IIIIIIIl1I1l = $IIIIIIIl1I1I->query('SELECT COUNT(*) as count FROM USERS');
$IIIIIIIIII1l = $IIIIIIIl1I1l->fetchArray();
$IIIIIIIl1I11 = $IIIIIIIIII1l['count'];
if ($IIIIIIIl1I11 == 0) {
    $IIIIIIIl1I1I->exec('INSERT INTO USERS(id,NAME,USERNAME,PASSWORD,LOGO) VALUES(\'1\',\'Your Name\',\'admin\',\'admin\',\'img/logo.png\')');
}
$IIIIIIIl1lII = $IIIIIIIl1I1I->query('SELECT * ' . "
				" . '  FROM USERS ' . "
				" . '  WHERE id=\'1\'');
$IIIIIIIl1lIl = $IIIIIIIl1lII->fetchArray();
$IIIIIIIl1lI1 = $IIIIIIIl1lIl['NAME'];
$IIIIIIIl1llI = $IIIIIIIl1lIl['LOGO'];
if (isset($_POST['login'])) {
    $IIIIIIIl1lll = 'SELECT * from USERS where USERNAME="' . $_POST['username'] . '"';
    $IIIIIIIl1ll1 = $IIIIIIIl1I1I->query($IIIIIIIl1lll);
    while ($IIIIIIIl1l1I = $IIIIIIIl1ll1->fetchArray()) {
        $IIIIIIIl1l1l = $IIIIIIIl1l1I['id'];
        $NAME = $IIIIIIIl1l1I['NAME'];
        $IIIIIIIl11II = $IIIIIIIl1l1I['USERNAME'];
        $IIIIIIIl11Il = $IIIIIIIl1l1I['PASSWORD'];
        $IIIIIIIl11I1 = $IIIIIIIl1l1I['LOGO'];
    }
    if (empty($IIIIIIIl1l1l)) {
        $IIIIIIIIl1ll = '<div class="alert alert-danger" id="flash-msg"><h4><i class="icon fa fa-times"></i>Not a Valid User!</h4></div>';
        echo $IIIIIIIIl1ll;
    } else if ($IIIIIIIl11Il == $_POST['password']) {
        $_SESSION['eggzie_iboPlayer'] = true;
        $_SESSION['N'] = $IIIIIIIl1l1l;
        $_SESSION['id'] = $IIIIIIIl1l1l;
        header('Location: users.php');
    } else {
        $IIIIIIIIl1ll = '<div class="alert alert-danger" id="flash-msg"><h4><i class="icon fa fa-times"></i>Wrong Password!</h4></div>';
        echo $IIIIIIIIl1ll;
    }
    $IIIIIIIl1I1I->close();
}
$date = date('d-m-Y H:i:s');
$IIIIIIIl11lI = IIIIIIII1lIl();
$IIIIIIIl11ll = new SQLite3('./a/.logs.db');
$IIIIIIIl11ll->exec('CREATE TABLE IF NOT EXISTS logs(id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, date TEXT, ipaddress TEXT)');
$IIIIIIIl11ll->exec('INSERT INTO logs(date,ipaddress) VALUES(\'' . $date . '\',\'' . $IIIIIIIl11lI . '\')');
$IIIIIIIIlIlI = new SQLite3('./a/.eggziedb.db');
$IIIIIIIIlIlI->exec('CREATE TABLE IF NOT EXISTS ibo(id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,mac_address VARCHAR(100),username VARCHAR(100),password VARCHAR(100),expire_date VARCHAR(100),url VARCHAR(100),title VARCHAR(100),created_at VARCHAR(100))');
$IIIIIIIIlIlI->exec('CREATE TABLE IF NOT EXISTS theme(id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,name VARCHAR(100),url VARCHAR(100))');
echo '<!DOCTYPE html>' . "
";
echo '<html>' . "
";
echo "
";
echo '<head>' . "
";
echo '    <meta charset="utf-8">' . "
";
echo '    <meta http-equiv="X-UA-Compatible" content="IE=edge">' . "
";
echo '    <meta name="viewport" content="width=device-width, initial-scale=1">' . "
";
echo '    <title>Ultra IBO</title>' . "
";
echo '    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">' . "
";
echo '    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">' . "
";
echo '    <link href="css/sb-admin-' . $IIIIIIIllIlI . '.css" rel="stylesheet">' . "
";
echo '    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">' . "
";
echo '    <link rel="icon" href="favicon.ico" type="image/x-icon">' . "
";
echo '</head>' . "
";
echo "	" . '<body class="bg-gradient-primary">' . "
";
echo "	" . '<div class="container">' . "
";
echo "	" . '<div class="row justify-content-center">' . "
";
echo "	" . '<center>' . "
";
echo '<body>' . "
";
echo '  <div class="wrapper ">' . "
";
echo '  <br><br><br>' . "
";
echo "	" . '<div class="container" style="margin-top:30px">' . "
";
echo "	" . '    <div style="width:400px; margin:0 auto;">' . "
";
echo "		" . '<div class="row">' . "
";
echo "			" . '<div class="center">' . "
";
echo '                          <center><img src="' . $IIIIIIIl1llI . '" width="100" height="100" class="center" alt=""></a></center>' . "
";
echo "				" . '<br>' . "
";
echo "			" . '    <h3 class="text-center text-light"><strong>Ultra IBO</strong></h3>' . "
";
echo "			" . '    <h3 class="text-center text-light">' . $IIIIIIIl1lI1 . '</h3>' . "
";
echo "				" . '<h5 class="text-center text-light">Welcome</h5>' . "
";
echo "				" . '<br>' . "
";
echo "				" . '<div>' . "
";
echo "				" . '    <div style="width:400px; margin:0 auto;">' . "
";
echo "					" . '<form method="post">' . "
";
echo "					" . '<input type="text" class="form-control text-primary" placeholder="Username" name="username" required autofocus><br>' . "
";
echo "					" . '<input type="password" class="form-control text-primary" placeholder="Password" name="password" required><br>' . "
";
echo "					" . '<button class="btn btn-lg btn btn-primary btn-block" name="login" type="submit">LET ME IN</button>' . "
";
echo "					" . '</form>' . "
";
echo "				" . '</div>' . "
";
echo "			" . '<div class="card-body">' . "
";
echo "				" . '<div class="panel-body">' . "
";
echo "				" . '<p class="text-center text-warning">Time Of Arrival: "<i>';
echo date('d-m-Y H:i:s');
echo '</i>"</p>' . "
";
echo "				" . '<p class="text-center text-warning">IP Address: "<i>';
echo IIIIIIII1lIl();
echo ' </i>"</p>' . "
";
echo "			" . '</div>' . "
";
echo "			" . '</div>' . "
";
echo '      <!-- Footer -->' . "
";
echo '      <footer class="">' . "
";
echo '        <div class="container">' . "
";
echo '          <div class="copyright text-center my-auto">' . "
";
echo '          </div>' . "
";
echo '        </div>' . "
";
echo '      </footer>';
echo "	" . '</div>' . "
";
echo "	" . '</div>' . "
";
echo "	" . '</div>' . "
";
echo "	" . '</div>' . "
";
echo "	" . '</div>' . "
";
echo "	" . '</div>' . "
";
echo "	" . '<script src="vendor/jquery/jquery.min.js"></script>' . "
";
echo "	" . '<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>' . "
";
echo "	" . '<script src="vendor/jquery-easing/jquery.easing.min.js"></script>' . "
";
echo "	" . '<script src="js/sb-admin-2.min.js"></script>' . "
";
echo "
";
include 'includes/functions.php';
require 'includes/egz.php';
echo '</body>' . "
";
echo "
";
echo '</html>' . "
";