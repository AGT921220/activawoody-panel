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
$db = new SQLite3("./api/data/.boxbr_snoop.db");
$res = $db->query("SELECT * FROM logs");
if (isset($_GET["delete"])) {
    $db->exec("DELETE FROM logs WHERE id=" . $_GET["delete"]);
    header("Location: snoop.php");
}
include "includes/header.php";
echo "\r<div class=\"modal fade\" id=\"confirm-delete\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">\r    <div class=\"modal-dialog\">\r        <div class=\"modal-content\">\r            <div class=\"modal-header\">\r                <h2>Confirm</h2>\r            </div>\r            <div class=\"modal-body\">\r               Do you really want to delete?\r            </div>\r            <div class=\"modal-footer\">\r                <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Cancel</button>\r                <a class=\"btn btn-danger btn-ok\">Delete</a>\r            </div>\r        </div>\r    </div>\r</div>\r\r<!-- [ Main Content ] start -->\r    <div class=\"pcoded-main-container\">\r        <div class=\"pcoded-wrapper\">\r            <div class=\"pcoded-content\">\r                <div class=\"pcoded-inner-content\">\r                    <div class=\"main-body\">\r                        <div class=\"page-wrapper\">\r                            <!-- [ Main Content ] start -->\r                            <div class=\"row\">\r                    <!-- Column -->\r                    <div class=\"col-lg-12\">\r                        <div class=\"card mb-4\">\r\t\t\t\t\t\t\t<div class=\"card-header bg-primary py-3\">\r                \t\t\t\t<h4 align=\"center\" class=\"m-0 font-weight-bold text-white\"><i class=\"fas fa-eye\" style=\"font-size:20px\">&nbsp;&nbsp;</i>Snooping Logs</h4>\r                \t\t\t</div>\r                         <div class=\"card-body\">\r\t\t\t\t\t\t\t <div class=\"table-responsive\">\r\t\t\t\t\t\t\t<table class=\"table table-striped table-sm\">\r\t\t\t\t\t\t\t<thead align=\"center\" class=\"text-primary\">\r\t\t\t\t\t\t\t\t<tr>\r\t\t\t\t\t\t\t\t\t<th>IP Address</th>\r\t\t\t\t\t\t\t\t\t<th>Date</th>\r\t\t\t\t\t\t\t\t\t<th>Delete</th>\r\t\t\t\t\t\t\t\t<tr>\r\t\t\t\t\t\t\t</thead>\r\t\t\t\t\t\t\t";
while ($row = $res->fetchArray()) {
    echo "\t\t\t\t\t\t\t<tbody align=\"center\">\r\t\t\t\t\t\t\t\t<tr style=\"color:white!important\">\r\t\t\t\t\t\t\t\t<td>";
    echo $row["ipaddress"];
    echo "</td>\r\t\t\t\t\t\t\t\t<td>";
    echo $row["date"];
    echo "</td>\r\t\t\t\t\t\t\t\t<td><a href=\"./snoop.php?delete=";
    echo $row["id"];
    echo "\"><i class=\"fas fa-trash\" style=\"font-size:20px;color:red\"></i></a></td>\r\t\t\t\t\t\t\t\t</tr>\r\t\t\t\t\t\t\t</tbody>\r\t\t\t\t\t\t\t";
}
echo "\t\t\t\t\t\t\t</table>\r</div>\r</div>\r</div>\r</div>\r</div>\r</div>\r</div>\r";
require "includes/functions.php";

?>