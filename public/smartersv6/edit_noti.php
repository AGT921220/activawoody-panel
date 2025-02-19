<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

ini_set("display_errors", 0);
ini_set("display_startup_errors", 0);
error_reporting(32767);
$db = new SQLite3("./api/data/.boxbr_info.db");
$res = $db->query("SELECT * \r\t\t\t\t  FROM notifications \r\t\t\t\t  WHERE id='" . $_GET["update"] . "'");
$row = $res->fetchArray();
if (isset($_POST["submit"])) {
    $db->exec("UPDATE notifications SET  \t\tTitle='" . $_POST["Title"] . "', \r\t\t\t\t\t\t\t\tDescription='" . $_POST["Description"] . "'\r\t\t\t\t\t\t  WHERE \r\t\t\t\t\t\t\t  \tid='" . $_POST["id"] . "'");
    $db->close();
    header("Location: notifications.php");
}
include "includes/header.php";
$id = $row["id"];
$title = $row["Title"];
$url = $row["Description"];
echo "\r<!-- [ Main Content ] start -->\r    <div class=\"pcoded-main-container\">\r        <div class=\"pcoded-wrapper\">\r            <div class=\"pcoded-content\">\r                <div class=\"pcoded-inner-content\">\r                    <div class=\"main-body\">\r                        <div class=\"page-wrapper\">\r                            <!-- [ Main Content ] start -->\r                            <div class=\"row\">\r                    <!-- Column -->\r                    <div class=\"col-lg-12\">\r                        <div class=\"card mb-4\">\r\t\t\t\t\t\t\t<div class=\"card-header bg-primary py-3\">\r                \t\t\t\t<h4 align=\"center\" class=\"m-0 font-weight-bold text-white\"><i class=\"fas fa-bullhorn\"  style=\"font-size:20px\">&nbsp;&nbsp;</i>Edit A Notification</h4>\r                \t\t\t</div>\r                         <div class=\"card-body\">\r\t\t\t\t\t\t\t<form method=\"post\">\r                        <div  type=\"hidden\" class=\"form-group\">\r\t\t\t\t\t\t   <input type=\"hidden\" name=\"id\" value=\"";
echo $row["id"];
echo "\">\r                          <input type=\"hidden\" id=\"id\" class=\"form-control text-primary\" name=\"id\" value=\"";
echo $row["id"];
echo "\">\r                        </div>\r                         <div class=\"form-group\">\r                          <label class=\"bmd-label-floating\"><strong>Message Title</strong></label>\r                          <input type=\"text\" id=\"Title\" class=\"form-control text-primary\" name=\"Title\" value=\"";
echo $row["Title"];
echo "\">\r                        </div>\r                                <div class=\"form-group\">\r                          <label class=\"bmd-label-floating\"><strong>Message</strong></label>\r                          <input type=\"Description\" class=\"form-control text-primary\" name=\"Description\" value=\"";
echo $row["Description"];
echo "\">\r                        </div>\r                         <div align=\"center\" class=\"form-group mb-3\">\r\t\t\t\t\t\t\t\t\t<br>\r\t\t\t\t\t\t\t\t\t\t<button class=\"btn btn-danger btn-icon-split\" name=\"submit\" type=\"submit\"><span class=\"icon text-white-50\"><i class=\"fas fa-save\"></i>&nbsp;&nbsp;</span><span class=\"text\"> Save Settings</span></button>\r                                </div>\r                            </form>\r                            </div>\r                        </div>\r                    </div>\r                    <!-- Column -->\r                </div>\r            </div>\r            <!-- ============================================================== -->\r            <!-- End Container fluid  -->\r            <!-- ============================================================== -->\r        </div>\r        <!-- ============================================================== -->\r        <!-- End Page wrapper  -->\r        <!-- ============================================================== -->\r    </div>\r";
include "includes/functions.php";

?>