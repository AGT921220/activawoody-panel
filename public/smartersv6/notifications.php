<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

$db = new SQLite3("./api/data/.boxbr_info.db");
$db->exec("CREATE TABLE IF NOT EXISTS notifications(id INTEGER PRIMARY KEY NOT NULL, Title TEXT, Description TEXT, CreateDate TEXT)");
$res = $db->query("SELECT * FROM notifications");
if (isset($_GET["delete"])) {
    $db->exec("DELETE FROM notifications WHERE id=" . $_GET["delete"]);
    $db->close();
    header("Location: notifications.php");
}
include "includes/header.php";
echo "\r<!-- [ Main Content ] start -->\r    <div class=\"pcoded-main-container\">\r        <div class=\"pcoded-wrapper\">\r            <div class=\"pcoded-content\">\r                <div class=\"pcoded-inner-content\">\r                    <div class=\"main-body\">\r                        <div class=\"page-wrapper\">\r                            <!-- [ Main Content ] start -->\r                            <div class=\"row\">\r                    <!-- Column -->\r                    <div class=\"col-lg-12\">\r                        <div class=\"card mb-4\">\r\t\t\t\t\t\t\t<div class=\"card-header bg-primary py-3\">\r                \t\t\t\t<h4 align=\"center\" class=\"m-0 font-weight-bold text-white\"><i class=\"fas fa-bullhorn\" style=\"font-size:20px\">&nbsp;&nbsp;</i>Notifications</h4>\r                \t\t\t</div>\r                         <div class=\"card-body\">\r\t\t\t\t\t\t\t <br>\r\t\t\t\t\t\t\t\t<div align=\"center\" class=\"col-12\">\r\t        \t\t\t\t\t\t<a  href=\"./add_noti.php\"><button class=\"btn btn-danger btn-icon-split\" name=\"submit\" type=\"submit\"><span class=\"icon text-white-50\"><i class=\"fa fa-plus\"></i></span>&nbsp;&nbsp;<span class=\"text\"> Add A Notification</span></button></a>\r    \t\t\t\t\t\t\t</div>\r\t\t\t\t\t\t\t <br>\r\t\t\t\t\t\t<div class=\"table-responsive\">\r\t\t\t\t\t\t\t<table class=\"table table-striped table-sm\">\r\t\t\t\t\t\t\t<thead align=\"center\">\r\t\t\t\t\t\t\t\t<tr>\r\t\t\t\t\t\t\t\t<th><strong>Title</strong></th>\r\t\t\t\t\t\t\t\t<th><strong>Description</strong></th>\r\t\t\t\t\t\t\t\t<th><strong>TimeStamp</strong></th>\r\t\t\t\t\t\t\t\t<th><strong>Edit</strong></th>\r\t\t\t\t\t\t\t\t<th><strong>Delete</strong></th>\r\t\t\t\t\t\t\t\t</tr>\r\t\t\t\t\t\t\t</thead>\r\t\t\t\t\t\t\t";
while ($row = $res->fetchArray()) {
    echo "\t\t\t\t\t\t\t<tbody align=\"center\">\r\t\t\t\t\t\t\t\t<tr class=\"text-primary\">\r\t\t\t\t\t\t\t\t<td>";
    echo $row["Title"];
    echo "</td>\r\t\t\t\t\t\t\t\t<td>";
    echo $row["Description"];
    echo "</td>\r\t\t\t\t\t\t\t\t<td>";
    echo $row["CreateDate"];
    echo "</td>\r\t\t\t\t\t\t\t\t<td><a href=\"./edit_noti.php?update=";
    echo $row["id"];
    echo "\"><i class=\"fas fa-edit\" style=\"font-size:20px;color:white\"></i></a></td>\r\t\t\t\t\t\t\t\t<td><a href=\"./notifications.php?delete=";
    echo $row["id"];
    echo "\"><i class=\"fas fa-trash\" style=\"font-size:20px;color:red\"></i></a></td>\r\t\t\t\t\t\t\t\t</tr>\r\t\t\t\t\t\t\t</tbody>\r\t\t\t\t\t\t\t";
}
echo "\t\t\t\t\t\t\t</table>\r\t\t\t\t\t\t</div>\r                            </div>\r                        </div>\r                    </div>\r                    <!-- Column -->\r                </div>\r            </div>\r            <!-- ============================================================== -->\r            <!-- End Container fluid  -->\r            <!-- ============================================================== -->\r        </div>\r        <!-- ============================================================== -->\r        <!-- End Page wrapper  -->\r        <!-- ============================================================== -->\r    </div>\r";
include "includes/functions.php";

?>