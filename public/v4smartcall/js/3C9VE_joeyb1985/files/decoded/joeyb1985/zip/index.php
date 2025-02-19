<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

@session_start();
$config_ini = parse_ini_file("./config.ini");
$db = new SQLite3("./api/.db.db");
$db->exec("CREATE TABLE IF NOT EXISTS users(id INTEGER PRIMARY KEY,username TEXT ,password TEXT)");
$log_check = $db->query("SELECT * FROM users WHERE id='1'");
$roe = $log_check->fetchArray();
$loggedinuser = $roe["username"];
if (isset($_SESSION["name"]) === $loggedinuser) {
    header("location: dns.php");
}
$rows = $db->query("SELECT COUNT(*) as count FROM users");
$row = $rows->fetchArray();
$numRows = $row["count"];
if ($numRows == 0) {
    $db->exec("INSERT INTO users(id ,username, password) VALUES('1' ,'admin', 'admin')");
    $db->close();
}
if (isset($_POST["login"])) {
    if (!$db) {
        echo $db->lastErrorMsg();
    }
    $sql = "SELECT * from users where username=\"" . $_POST["username"] . "\";";
    $ret = $db->query($sql);
    while ($row = $ret->fetchArray()) {
        $id = $row["id"];
        $username = $row["username"];
        $password = $row["password"];
    }
    if ($id != "") {
        if ($password == $_POST["password"]) {
            session_regenerate_id();
            $_SESSION["loggedin"] = true;
            $_SESSION["name"] = $_POST["username"];
            if ($_POST["username"] == "admin") {
                header("Location: user.php");
            } else {
                header("Location: dns.php");
            }
        } else {
            header("Location: ./api/index.php");
        }
    } else {
        header("Location: ./api/index.php");
    }
    $db->close();
}
echo "<!DOCTYPE html>\r\n<html lang=\"en\">\r\n<head>\r\n\t<meta charset=\"utf-8\">\r\n\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">\r\n\t<meta name=\"author\" content=\"FTSOL\">\r\n\t<link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css\">\r\n\t<link rel=\"stylesheet\" href=\"./css/css.css\">\r\n    <title>FTSOL Panels</title>\r\n</head>\r\n<style>\r\nbody{\r\n  background-color: #181828;\r\n  background-image: url(\"./img/binding_dark.webp\");\r\n  color #fff;\r\n}\r\n\r\n#particles-js{\r\n  background-size: cover;\r\n  background-position: 50% 50%;\r\n  background-repeat: no-repeat;\r\n  /*width: 100%;\r\n  height: 100vh;*/\r\n  background: #8000FF;\r\n  display: flex;\r\n  justify-content: center;\r\n  align-items: center;\r\n\r\n}\r\n\r\n.particles-js-canvas-el{\r\n  position: fixed;\r\n}\r\n\r\n.footer {\r\n   position: fixed;\r\n   left: 0;\r\n   bottom: 0;\r\n   width: 100%;\r\n   color: black;\r\n   text-align: center;\r\n}\r\n.footer a {\r\n     color: #000;\r\n}\r\n\r\n.footer a:hover {\r\n     color: #2e2e2e;\r\n}\r\n</style>\r\n<div id=\"js-particles\"></div>\r\n<br><br>\r\n        <div class=\"container\">\r\n            <div class=\"row\">\r\n                <div class=\"col-lg-4 mx-md-auto\">\r\n                    <div class=\"text-center\">\r\n                        <img class=\"w-75 p-3\" src=\"./img/logo.png\" alt=\"\">\r\n                    </div>\r\n                    <br>\r\n                    <form method=\"post\">\r\n                        <div class=\"form-group\">\r\n                            <input type=\"text\" class=\"form-control form-control-lg\"\r\n                                   placeholder=\"Username\" name=\"username\" required autofocus>\r\n                        </div>\r\n                        <div class=\"form-group\">\r\n                            <input type=\"text\" class=\"form-control form-control-lg\"\r\n                                   placeholder=\"Password\" name=\"password\" required>\r\n                        </div>\r\n                        <input type=\"submit\" class=\"btn btn-warning btn-lg btn-block\" value=\"Log In\" name=\"login\">\r\n                    </form>\r\n\t\t\t\t\t<br>\r\n                 <center><a href=\"";
echo $config_ini["contact"];
echo "\" target=\"_blank\">&nbsp&nbsp&nbsp&nbsp&#169  &nbsp";
echo date("Y");
echo " *&nbsp ";
echo $config_ini["brand_name"];
echo " &nbsp* </a></center>\r\n                </div>\r\n            </div>\r\n        </div>\r\n<br><br>\r\n<div class=\"footer\">\r\n  <center><a class=\"list-grup-item\" href=\"https://t.me/ftsoltech\" target=\"_blank\">* FTSOL Panels *</a></center>\r\n</div>\r\n<script src=\"https://code.jquery.com/jquery-3.3.1.js\"></script>\r\n<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js\" integrity=\"sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49\" crossorigin=\"anonymous\"></script>\r\n<script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js\" integrity=\"sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy\" crossorigin=\"anonymous\"></script>\r\n<script src=\"https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js\"></script>\r\n<script src=\"js/particles.js\"></script>\r\n\r\n";

?>