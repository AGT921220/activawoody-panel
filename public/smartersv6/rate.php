<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

error_reporting(0);
include "includes/header.php";
$db = new SQLite3("./api/data/.boxbr_rate.db");
$table_name = "rate";
$db->exec("CREATE TABLE IF NOT EXISTS " . $table_name . "(id INTEGER PRIMARY KEY,url TEXT)");
$rows = $db->query("SELECT COUNT(*) as count FROM " . $table_name);
$row = $rows->fetchArray();
$numRows = $row["count"];
if ($numRows == 0) {
    $db->exec("INSERT INTO " . $table_name . "(url) VALUES('')");
}
$res = $db->query("SELECT * FROM " . $table_name . " WHERE id='1'");
$rowU = $res->fetchArray();
if (isset($_POST["submit"])) {
    $db->exec("UPDATE " . $table_name . " SET\turl='" . $_POST["url"] . "' WHERE id='1' ");
    header("Location: rate.php");
}
echo "\r<!-- [ Main Content ] start -->\r    <div class=\"pcoded-main-container\">\r        <div class=\"pcoded-wrapper\">\r            <div class=\"pcoded-content\">\r                <div class=\"pcoded-inner-content\">\r                    <div class=\"main-body\">\r                        <div class=\"page-wrapper\">\r                            <!-- [ Main Content ] start -->\r                            <div class=\"row\">\r                    <!-- Column -->\r                    <div class=\"col-lg-12\">\r                        <div class=\"card mb-4\">\r\t\t\t\t\t\t\t<div class=\"card-header bg-primary py-3\">\r                \t\t\t\t<h4 align=\"center\" class=\"m-0 font-weight-bold text-white\"><i class=\"fas fa-star\" style=\"font-size:20px\"></i><i class=\"fas fa-star-half-alt\" style=\"font-size:20px\"></i><i class=\"far fa-star\" style=\"font-size:20px\">&nbsp;&nbsp;</i>Rate Us</h4>\r                \t\t\t</div>\r                         <div class=\"card-body\">\r\t\t\t\t\t\t\t<form method=\"post\">\r                \t\t\t\t<div class=\"form-group mb-3\">\r                        \t\t\t<label class=\"control-label text-primary\" for=\"url\">\r                        \t\t\t\t<strong>Rate Us URL: </strong>\r                        \t\t\t</label>\r                        \t\t<div class=\"input-group\">\r                        \t\t\t<input class=\"form-control\" id=\"url\" name=\"url\" value=\"";
echo $rowU["url"];
echo "\" type=\"text\"/>\r                        \t\t</div>\r\t\t\t\t\t\t\t\t</div>\r\t\t\t\t\t\t\t\t<div align=\"center\" class=\"form-group mb-3\">\r\t\t\t\t\t\t\t\t\t<br>\r                                    <div>\r\t\t\t\t\t\t\t\t\t\t<button class=\"btn btn-danger\" name=\"submit\" type=\"submit\"><span class=\"icon text-white-50\"><i class=\"fas fa-save\"></i>&nbsp;&nbsp;</span><span class=\"text\"> Save Settings</span></button>\r                                    </div>\r                                </div>\r              \t\t\t</form>\r                         </div>\r                        </div>\r                    </div>\r                    <!-- Column -->\r                </div>\r            </div>\r            <!-- ============================================================== -->\r            <!-- End Container fluid  -->\r            <!-- ============================================================== -->\r        </div>\r        <!-- ============================================================== -->\r        <!-- End Page wrapper  -->\r        <!-- ============================================================== -->\r    </div>\r";
include "includes/functions.php";

?>