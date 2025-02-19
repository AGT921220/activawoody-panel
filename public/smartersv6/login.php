<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

session_start();
if (isset($_SESSION["loggedin"])) {
    header("location:dns.php");
}
$db = new SQLite3("./api/data/.boxbr_user.db");
$db->exec("CREATE TABLE IF NOT EXISTS USERS(ID INT PRIMARY KEY,USERNAME TEXT ,PASSWORD TEXT)");
$db->exec("CREATE TABLE IF NOT EXISTS messages(id INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL, message VARCHAR(100), userid TEXT,status TEXT,expire TEXT)");
$rows = $db->query("SELECT COUNT(*) as count FROM USERS");
$row = $rows->fetchArray();
$numRows = $row["count"];
if ($numRows == 0) {
    $db->exec("INSERT INTO USERS(ID ,USERNAME, PASSWORD) VALUES('1' ,'admin', 'admin')");
}
if (isset($_POST["login"])) {
    if (!$db) {
        echo $db->lastErrorMsg();
    }
    $sql = "SELECT * from USERS where USERNAME=\"" . $_POST["username"] . "\";";
    $ret = $db->query($sql);
    while ($row = $ret->fetchArray()) {
        $id = $row["ID"];
        $username = $row["USERNAME"];
        $password = $row["PASSWORD"];
    }
    if ($id != "") {
        if ($password == $_POST["password"]) {
            session_regenerate_id();
            $_SESSION["loggedin"] = true;
            $_SESSION["N"] = $_POST["username"];
            header("Location: dns.php");
        } else {
            echo "Wrong Password";
        }
    } else {
        echo "User Does Not Exist, Please Try Again!";
    }
    $db->close();
}
$date = date("d-m-Y H:i:s");
$IPADDRESS = isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : "undefined";
$db1 = new SQLite3("./api/data/.boxbr_snoop.db");
$db1->exec("CREATE TABLE IF NOT EXISTS logs(id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, date datetime, ipaddress TEXT)");
$db1->exec("INSERT INTO logs(date,ipaddress) VALUES('" . $date . "','" . $IPADDRESS . "')");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Smarters Manager</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style2.css">
    
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/css.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <style>
        html {
          height: 100%;
        }

        .login-box {
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
          font-size: 14px;
          text-decoration: none;
          text-transform: uppercase;
          overflow: hidden;
          transition: 0.5s;
          letter-spacing: 4px
        }

        .login-box a:hover {
          background: #02700ff;
          color: #fff;
          border-radius: 5px;
          box-shadow: 0 0 5px #0072ff,
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
        
        table {
          table-layout: fixed;
        }

        td {
          word-wrap: break-word;
        }

        .main {
          padding-top: 25px;
        }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
          <div class="content-wrapper full-page-wrapper d-flex aalign-items-center auth login-bg">
            <div class="col-lg-4 mx-auto">
              <div align="center" class="login-box card-body px-2 py-2">
                <h4>
                  <img src="assets/images/login.png" width="80" height="80" class="logo"></h4>
                  
                  <h4>Smarters<sup>v3++</sup> Manager</h4>
                  <br>
                  <form  method="post" name="boxbr_form" id="boxbr_form">
                    <input type="hidden" name="login"/><br>
                    <div class="user-box">
                      <input type="text" name="username" required="">
                      <label>Username</label>
                    </div>
                    <br>
                    <div class="user-box">
                      <input type="password" name="password" required="">
                      <label>Password</label>
                    </div> <br>
                     
                     <a href="#" class="btn btn-lg btn-block" onClick="document.getElementById('boxbr_form').submit();">
                      <span></span>
                      <span></span>
                      <span></span>
                      <span></span>
                      ENTER PANEL
                    </a>
                  </form>
                  
                    <!-- ... Tu código existente ... -->

<div class="text-center mt-4">
    <a href="#" data-toggle="modal" data-target="#zoomModal">
        <img id="enlargableImage" class="w-50" src="https://i.postimg.cc/MGv1Xn8v/Screenshot-20230908-005759.png" alt="Captura de pantalla">
    </a>
</div>

<div class="copy-box bg-dark text-white p-3">
    <input type="text" class="form-control form-control-lg" value="https://t.me/apkrebrandec" id="copyInput" readonly>
    <button class="btn btn-secondary btn-lg btn-block" onclick="copyText()">Copiar Enlace</button>
</div>

<div class="modal fade" id="zoomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <img class="w-100" src="https://i.postimg.cc/MGv1Xn8v/Screenshot-20230908-005759.png" alt="Captura de pantalla">
      </div>
    </div>
  </div>
</div>

<script>
function copyText() {
    var copyText = document.getElementById("copyInput");
    copyText.select();
    document.execCommand("copy");
    alert("Enlace copiado al portapapeles: " + copyText.value);
}
</script>

<!-- ... Tu código existente ... -->


                <center> <br>
                    <div class="panel-body">
                    <h3 class="card-title mb-3"><a href="#" class="btn btn-lg btn-block" onClick="document.getElementById('boxbr_form').submit();">
    <strong>RebrandECUADOR</strong>
    </a></h3> </center>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
  </body>
</html>
