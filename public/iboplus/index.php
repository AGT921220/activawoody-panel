<?php
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
            } else {
                header('Location: dns.php');
            }
        } else {
            header('Location: ./api/index.php');
        }
    } else {
        header('Location: ./api/index.php');
    }

    $db->close();
}

$downloadLink = 'https://link.apk'; // Substitua com seu link de download
$moreModelsLink = 'https://youweblink'; // Substitua com seu link para mais modelos
$whatsappLink = 'https://wa.me/35192623192'; // Substitua com seu número de WhatsApp

echo '<!DOCTYPE html>' . "\r\n";
echo '<html lang="en">' . "\r\n";
echo '<head>' . "\r\n";
echo '    <meta charset="utf-8">' . "\r\n";
echo '    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">' . "\r\n";
echo '    <meta name="author" content="WCTV APPS.">' . "\r\n";
echo '    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">' . "\r\n";
echo '    <link rel="stylesheet" href="./css/css.css">' . "\r\n";
echo '    <title> TELA IBO 4.1</title>' . "\r\n";
echo '    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">' . "\r\n";
echo '</head>' . "\r\n";
echo '<style>' . "\r\n";
echo '    body {' . "\r\n";
echo '        background-color: #181828;' . "\r\n";
echo '        background-image: url("./img/binding_dark.webp");' . "\r\n";
echo '        color: #fff;' . "\r\n";
echo '    }' . "\r\n";
echo '    #particles-js {' . "\r\n";
echo '        background-size: cover;' . "\r\n";
echo '        background-position: 50% 50%;' . "\r\n";
echo '        background-repeat: no-repeat;' . "\r\n";
echo '        background: #8000FF;' . "\r\n";
echo '        display: flex;' . "\r\n";
echo '        justify-content: center;' . "\r\n";
echo '        align-items: center;' . "\r\n";
echo '    }' . "\r\n";
echo '    .particles-js-canvas-el {' . "\r\n";
echo '        position: fixed;' . "\r\n";
echo '    }' . "\r\n";
echo '    .footer {' . "\r\n";
echo '        position: fixed;' . "\r\n";
echo '        left: 0;' . "\r\n";
echo '        bottom: 0;' . "\r\n";
echo '        width: 100%;' . "\r\n";
echo '        color: black;' . "\r\n";
echo '        text-align: center;' . "\r\n";
echo '    }' . "\r\n";
echo '    .footer a {' . "\r\n";
echo '        color: #000;' . "\r\n";
echo '    }' . "\r\n";
echo '    .footer a:hover {' . "\r\n";
echo '        color: #2e2e2e;' . "\r\n";
echo '    }' . "\r\n";
echo '    .btn-group .btn {' . "\r\n";
echo '        margin: 5px;' . "\r\n";
echo '        width: 100%;' . "\r\n";
echo '    }' . "\r\n";
echo '    .btn-group {' . "\r\n";
echo '        display: flex;' . "\r\n";
echo '        flex-direction: column;' . "\r\n";
echo '    }' . "\r\n";
echo '    .btn-group .btn:last-child {' . "\r\n";
echo '        margin-bottom: 0;' . "\r\n";
echo '    }' . "\r\n";
echo '    .btn-lg-custom {' . "\r\n";
echo '        width: 100%;' . "\r\n";
echo '    }' . "\r\n";
echo '    .btn-android {' . "\r\n";
echo '        background-color: #3DDC84;' . "\r\n";
echo '        color: white;' . "\r\n";
echo '    }' . "\r\n";
echo '</style>' . "\r\n";
echo '<div id="js-particles"></div>' . "\r\n";
echo '<br><br>' . "\r\n";
echo '<div class="container">' . "\r\n";
echo '    <div class="row">' . "\r\n";
echo '        <div class="col-lg-4 mx-md-auto">' . "\r\n";
echo '            <div class="text-center">' . "\r\n";
echo '                <img class="w-75 p-3" src="./img/logo.png" alt="">' . "\r\n";
echo '            </div>' . "\r\n";
echo '            <br>' . "\r\n";
echo '            <form method="post">' . "\r\n";
echo '                <div class="form-group">' . "\r\n";
echo '                    <input type="text" class="form-control form-control-lg" placeholder="Username" name="username" required autofocus>' . "\r\n";
echo '                </div>' . "\r\n";
echo '                <div class="form-group">' . "\r\n";
echo '                    <input type="password" class="form-control form-control-lg" placeholder="Password" name="password" required>' . "\r\n";
echo '                </div>' . "\r\n";
echo '                <input type="submit" class="btn btn-warning btn-lg btn-block" value="Log In" name="login">' . "\r\n";
echo '            </form>' . "\r\n";
echo '            <br>' . "\r\n";
echo '            <div class="text-center">' . "\r\n";
echo '                <h5>Informações:</h5>' . "\r\n";
echo '                <div class="btn-group">' . "\r\n";
echo '                    <a id="downloadLink" href="' . $downloadLink . '" class="btn btn-primary btn-lg btn-lg-custom" target="_blank">Baixar seu app.</a>' . "\r\n";
echo '                    <button class="btn btn-info btn-lg btn-lg-custom" onclick="copyLink()">Copiar Link do app</button>' . "\r\n";
echo '                    <a href="' . $whatsappLink . '" class="btn btn-success btn-lg btn-lg-custom" target="_blank"><i class="fab fa-whatsapp"></i> Suporte</a>' . "\r\n";
echo '                    <button class="btn btn-warning btn-lg btn-lg-custom" onclick="startDownload()">Downloader: youcode </button>' . "\r\n";
echo '                </div>' . "\r\n";
echo '                <br>' . "\r\n";
echo '                <a href="' . $moreModelsLink . '" class="btn btn-android btn-lg btn-lg-custom"><i class="fab fa-android"></i> Veja aqui mais modelos de apps</a>' . "\r\n";
echo '            </div>' . "\r\n";
echo '            <br>' . "\r\n";
echo '            <center><a href="';
echo $config_ini['contact'];
echo '">';
echo $config_ini['brand_name'];
echo ' &nbsp; &copy; &nbsp; ' . date("Y") . '</a></center>';
echo '        </div>' . "\r\n";
echo '    </div>' . "\r\n";
echo '</div>' . "\r\n";
echo '</body>' . "\r\n";
echo '<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>' . "\r\n";
echo '<script>' . "\r\n";
echo '  function copyLink() {' . "\r\n";
echo '    var dummy = document.createElement(\'input\');' . "\r\n";
echo '    var text = document.getElementById(\'downloadLink\').href;' . "\r\n";
echo '    document.body.appendChild(dummy);' . "\r\n";
echo '    dummy.value = text;' . "\r\n";
echo '    dummy.select();' . "\r\n";
echo '    document.execCommand(\'copy\');' . "\r\n";
echo '    document.body.removeChild(dummy);' . "\r\n";
echo '    alert(\'Link copiado com sucesso!\');' . "\r\n";
echo '  }' . "\r\n";
echo '  function startDownload() {' . "\r\n";
echo '    window.location.href = "' . $downloadLink . '";' . "\r\n";
echo '  }' . "\r\n";
echo '  particlesJS.load(\'js-particles\', \'./particlesjs-config.json\', function() {' . "\r\n";
echo '    console.log(\'particles.js config loaded\');' . "\r\n";
echo '  });' . "\r\n";
echo '</script>' . "\r\n";
echo '</html>';
?>
