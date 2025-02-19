<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2 & 7.3
 * @ Decoder version: 1.0.6
 * @ Release: 10/08/2022
 */

ini_set("display_errors", 0);
ini_set("display_startup_errors", 0);
error_reporting(32767);
if (!file_exists("vpn")) {
    mkdir("vpn", 511, true);
}
$results_per_page = 10;
if (isset($_GET["view"])) {
    $page = $_GET["view"];
} else {
    $page = 1;
}
$start_from = ($page - 1) * $results_per_page;
$db1 = new SQLite3("./api/data/.boxbr_vpn.db");
$db1->exec("CREATE TABLE IF NOT EXISTS boxbrvpn(id INTEGER PRIMARY KEY,vpn_country TEXT ,vpn_config TEXT,vpn_file_name TEXT)");
$sql = "SELECT COUNT(id) AS total FROM boxbrvpn";
$result = $db1->query($sql);
$rownew = $result->fetchArray();
$totaleview = $rownew["total"];
$total_pages = ceil($rownew["total"] / $results_per_page);
$res1 = $db1->query("SELECT * FROM boxbrvpn ORDER by id DESC LIMIT " . $start_from . ", " . $results_per_page);
if (isset($_GET["delete"])) {
    $res1 = $db1->query("SELECT * FROM boxbrvpn WHERE id=" . $_GET["delete"]);
    $row_del = $res1->fetchArray();
    $file_to_delete = $row_del["vpn_file_name"];
    $file_to_delete = "vpn/" . $file_to_delete;
    unlink($file_to_delete);
    $db1->exec("DELETE FROM boxbrvpn WHERE id=" . $_GET["delete"]);
    $db1->close();
    $msg = "Deleted, OVPN Stored File.";
    header("Location: vpn.php?messageE=" . $msg);
}
require "includes/header.php";
echo "<!-- [ Main Content ] start -->\n    <div class=\"pcoded-main-container\">\n        <div class=\"pcoded-wrapper\">\n            <div class=\"pcoded-content\">\n                <div class=\"pcoded-inner-content\">\n                    <div class=\"main-body\">\n                        <div class=\"page-wrapper\">\n                            <!-- [ Main Content ] start -->\n";
if (isset($_GET["messageA"])) {
    echo "<div class=\"alert alert-danger bg-primary py-3\" id=\"flash-msg\"><h4 align=\"center\" class=\"m-0 font-weight-bold text-white\"><i class=\"icon fa fa-check\"></i> " . $_GET["messageA"] . "</h4></div>";
}
if (isset($_GET["messageE"])) {
    echo "<div class=\"alert alert-danger bg-danger py-3\" id=\"flash-msg\"><h4 align=\"center\" class=\"m-0 font-weight-bold text-white\"><i class=\"icon fa fa-times\"></i> " . $_GET["messageE"] . "</h4></div>";
}
if (isset($_GET["messageS"])) {
    echo "<div class=\"alert alert-danger bg-success py-3\" id=\"flash-msg\"><h4 align=\"center\" class=\"m-0 font-weight-bold text-white\"><i class=\"icon fa fa-check\"></i> " . $_GET["messageS"] . "</h4></div>";
}
echo "                            <div class=\"row\">\n                    <!-- Column -->\n                    <div class=\"col-lg-12\">\n                        <div class=\"card mb-4\">\n\t\t\t\t\t\t\t<div class=\"card-header bg-primary py-3\">\n                \t\t\t\t<h4 align=\"center\" class=\"m-0 font-weight-bold text-white\"><i class=\"fas fa-user-secret\" style=\"font-size:20px\">&nbsp;&nbsp;</i>Virtual Private Network</h4>\n                \t\t\t</div>\n                         <div class=\"card-body\">\n\t\t\t\t\t\t\t <br>\n\t\t\t\t\t\t\t\t<div align=\"center\" class=\"col-12\">\n\t        \t\t\t\t\t\t<a  href=\"./add_vpn.php\"><button class=\"btn btn-danger btn-icon-split\" name=\"submit\" type=\"submit\"><span class=\"icon text-white-50\"><i class=\"fa fa-plus\"></i></span>&nbsp;&nbsp;<span class=\"text\"> Add A VPN</span></button></a>\n    \t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t <br>\n\t\t\t\t\t\t<div class=\"table-responsive\">\n\t\t\t<table class=\"table table-striped table-sm\">\n\t\t\t<thead align=\"center\" class=\"text-primary\">\n\t\t\t\t<tr>\n\t\t\t\t  <th>Country</th>\n                  <th>File Name</th>\n\t\t\t\t  <th>Delete</th>\n                </tr>\n              </thead>\n";
while ($row1 = $res1->fetchArray()) {
    $id = $row1["id"];
    $vpn_country = $row1["vpn_country"];
    $vpn_config = $row1["vpn_file_name"];
    $vpn_country = "./assets/images/flags/" . strtolower($vpn_country) . ".png";
    echo "              <tbody align=\"center\" class=\" text-primary\">\n                <tr>\n";
    echo "                  <td><img type=\"image\" src=\"" . $vpn_country . "\" alt=\"image\"/></td>" . "\n";
    echo "                  <td>" . $vpn_config . "</td>" . "\n";
    echo "                  <td><a href=\"./vpn.php?delete=" . $id . "\"><i class=\"fas fa-trash\" style=\"font-size:20px;color:red\"></i></a></td>" . "\n";
    echo "\t\t\t\t</tr>\n\t\t\t</tbody>\n";
}
echo "\t\t\t</table>\n\t\t</div>\n";
if ($results_per_page < $totaleview) {
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a class=\"btn btn-icon\" href='vpn.php?view=" . $i . "'";
        if ($i == $page) {
            echo " class='curPage'";
        }
        echo ">Page " . $i . "</a> ";
    }
}
echo "</main>\n\n    <br><br><br>";
require "includes/functions.php";
echo "</body>\n";

?>