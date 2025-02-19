<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

error_reporting(0);
include "includes/header.php";
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
    submit("sub_new", $db, $table_name);
    header("Location: " . $base_file . "?status=2");
}
echo "\r\n        <div class=\"col-md-8 mx-auto\">\r\n            <div class=\"card-body\">\r\n                <div class=\"card bg-primary text-white\">\r\n                    <div class=\"card-header card-header-warning\">\r\n                        <center>\r\n                            <h2><i class=\"icon icon-bullhorn\"></i> Service Url</h2>\r\n                        </center>\r\n                    </div>\r\n                    \r\n                    <div class=\"card-body\">\r\n                        <div class=\"col-12\">\r\n                            <h3>Push Url</h3>\r\n                        </div>\r\n                            <form method=\"post\">\r\n                                <div class=\"form-group\">\r\n                                    <label class=\"form-label \" for=\"version\">Service Url</label>\r\n                                        <input class=\"form-control\" placeholder=\"Service Url\" name=\"url\" value=\"";
echo $rowU["url"];
echo "\" type=\"text\"/>\r\n                                </div>\r\n                                <div class=\"form-group\">\r\n                                    <center>\r\n                                        <button class=\"btn btn-info \" name=\"submit\" type=\"submit\">\r\n                                            <i class=\"icon icon-check\"></i> Submit\r\n                                        </button>\r\n                                    </center>\r\n                                </div>\r\n                            </form>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n\r\n";
include "includes/footer.php";
// @Protected ioncube.dk encoding key.
function Submit()
{
}

?>