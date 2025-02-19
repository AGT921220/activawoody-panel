<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

$db = new SQLite3("./api/data/.boxbr_user.db");
$res = $db->query("SELECT * \r\t\t\t\t  FROM USERS \r\t\t\t\t  WHERE ID='1'");
$row = $res->fetchArray();
$message = "<div class=\"alert alert-success\" id=\"flash-msg\"><h4><i class=\"icon fa fa-check\"></i>Items Updated!</h4></div>";
if (isset($_POST["submit"])) {
    $db->exec("UPDATE USERS \r\t\t\tSET\tUSERNAME='" . $_POST["username"] . "', \r\t\t\t\tPASSWORD='" . $_POST["password"] . "' \r\t\t\tWHERE \r\t\t\t\tID='1' ");
    $_SESSION["loggedin"] = true;
    $_SESSION["name"] = $_POST["username"];
    header("Location: edit_user.php?message=" . $message);
}
include "includes/header.php";
echo "\r<!-- [ Main Content ] start -->\r    <div class=\"pcoded-main-container\">\r        <div class=\"pcoded-wrapper\">\r            <div class=\"pcoded-content\">\r                <div class=\"pcoded-inner-content\">\r                    <div class=\"main-body\">\r                        <div class=\"page-wrapper\">\r                            <!-- [ Main Content ] start -->\r                            <div class=\"row\">\r                    <!-- Column -->\r                    <div class=\"col-lg-12\">\r                        <div class=\"card mb-4\">\r\t\t\t\t\t\t\t<div class=\"card-header bg-primary py-3\">\r                \t\t\t\t<h4 align=\"center\" class=\"m-0 font-weight-bold text-white\"><i class=\"fas fa-pencil-alt\" style=\"font-size:20px\">&nbsp;&nbsp;</i>Username and Password</h4>\r                \t\t\t</div>\r                         <div class=\"card-body\">\r\t\t\t\t\t\t\t <form method=\"post\">\r                                <div class=\"form-group mb-3\">\r                                    <label class=\"control-label \" for=\"username\">\r\t\t\t\t\t\t\t\t\t\t<strong>Username</strong>\r                                    </label>\r                                    <div class=\"input-group\">\r                                        <input class=\"form-control text-primary\" id=\"description\" name=\"username\" value=\"";
echo $row["USERNAME"];
echo "\" type=\"text\"/>\r                                    </div>\r                                </div>\r                                <div class=\"form-group mb-3\">\r                                    <label class=\"control-label \" for=\"password\">\r\t\t\t\t\t\t\t\t\t\t<strong>Password</strong>\r                                    </label>\r                                    <div class=\"input-group\">\r                                        <input type=\"text\" class=\"form-control text-primary\" name=\"password\" id=\"date\" value=\"";
echo $row["PASSWORD"];
echo "\">\r                                    </div>\r                                </div>\r                                <div align=\"center\" class=\"form-group mb-3\">\r\t\t\t\t\t\t\t\t\t<br>\r                                    <div>\r                                        <button class=\"btn btn-danger btn-icon-split\" name=\"submit\" type=\"submit\"><span class=\"icon text-white-50\"><i class=\"fas fa-save\"></i>&nbsp;&nbsp;</span><span class=\"text\"> Save Settings</span></button>\r                                    </div>\r                                </div>\r                            </form> \r                            </div>\r                        </div>\r                    </div>\r                    <!-- Column -->\r                </div>\r            </div>\r            <!-- ============================================================== -->\r            <!-- End Container fluid  -->\r            <!-- ============================================================== -->\r        </div>\r        <!-- ============================================================== -->\r        <!-- End Page wrapper  -->\r        <!-- ============================================================== -->\r    </div>\r";
include "includes/functions.php";

?>