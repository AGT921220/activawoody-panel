<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

error_reporting(0);
$db = new SQLite3("./api/data/.boxbr_update.db");
$table_name = "update_apk";
$db->exec("CREATE TABLE IF NOT EXISTS " . $table_name . "(id INTEGER PRIMARY KEY,version TEXT ,apk TEXT,package TEXT)");
$rows = $db->query("SELECT COUNT(*) as count FROM " . $table_name);
$row = $rows->fetchArray();
$numRows = $row["count"];
if ($numRows == 0) {
    $db->exec("INSERT INTO " . $table_name . "(version,apk,package) VALUES('','','')");
}
$res = $db->query("SELECT * FROM " . $table_name . " WHERE id='1'");
$rowU = $res->fetchArray();
if (isset($_POST["submit"])) {
    $db->exec("UPDATE " . $table_name . " SET\tversion='" . $_POST["version"] . "', apk='" . $_POST["apk"] . "', package='" . $_POST["package"] . "' WHERE id='1' ");
    header("Location: update.php");
}
include "includes/header.php";
echo "<!-- [ Main Content ] start -->\r\n\r\n    <div class=\"pcoded-main-container\">\r\n        <div class=\"pcoded-wrapper\">\r\n            <div class=\"pcoded-content\">\r\n                <div class=\"pcoded-inner-content\">\r\n                    <div class=\"main-body\">\r\n                        <div class=\"page-wrapper\">\r\n                            <!-- [ Main Content ] start -->\r\n                            <div class=\"row\">\r\n                    <!-- Column -->\r\n                    <div class=\"col-lg-12\">\r\n                        <div class=\"card mb-4\">\r\n\t\t\t\t\t\t\t<div class=\"card-header bg-primary py-3\">\r\n                \t\t\t\t<h4 align=\"center\" class=\"m-0 font-weight-bold text-white\"><i class=\"fas fa-cloud-upload-alt\" style=\"font-size:20px\">&nbsp;&nbsp;</i>Push Update</h4>\r\n                \t\t\t</div>\r\n            <div class=\"card-body wow-bg\" id=\"formBg\">\r\n              <h3 class=\"colorboard\">Push Update</h3>\r\n              <form  method=\"post\">\r\n                <div class=\"input-group mb-3\"> <input type=\"text\" class=\"form-control textbox-dg\" placeholder=\"Version Number\" name=\"version\" value=\"";
echo $rowU["version"];
echo "\" > </div>\r\n                <div class=\"input-group mb-3\"> <input type=\"text\" class=\"form-control textbox-dg\" placeholder=\"Package name\" name=\"package\" value=\"";
echo $rowU["package"];
echo "\" > </div>\r\n                <div class=\"input-group mb-4\"> <input type=\"text\" class=\"form-control textbox-dg\" placeholder=\"APK URL\" name=\"apk\" value=\"";
echo $rowU["apk"];
echo "\" > </div>\r\n                <div class=\"row\">\r\n                  <div class=\"col-12\"> <button type=\"submit\" name=\"submit\" class=\"btn btn-primary btn-block logn-btn\">Submit</button> </div>\r\n                </div>\r\n              </form>\r\n            </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <!-- Column -->\r\n                </div>\r\n            </div>\r\n            <!-- ============================================================== -->\r\n            <!-- End Container fluid  -->\r\n            <!-- ============================================================== -->\r\n        </div>\r\n        <!-- ============================================================== -->\r\n        <!-- End Page wrapper  -->\r\n        <!-- ============================================================== -->\r\n    </div>\r\n";
include "includes/functions.php";

?>