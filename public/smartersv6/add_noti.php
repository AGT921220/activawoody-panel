<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

$db = new SQLite3("./api/data/.boxbr_info.db");
if (isset($_POST["submit"])) {
    $db->exec("INSERT INTO notifications(Title, Description , CreateDate) VALUES('" . $_POST["Title"] . "', '" . $_POST["Description"] . "', '" . $_POST["CreateDate"] . "')");
    $db->close();
    header("Location: notifications.php");
}
include "includes/header.php";
echo "\r<!-- [ Main Content ] start -->\r    <div class=\"pcoded-main-container\">\r        <div class=\"pcoded-wrapper\">\r            <div class=\"pcoded-content\">\r                <div class=\"pcoded-inner-content\">\r                    <div class=\"main-body\">\r                        <div class=\"page-wrapper\">\r                            <!-- [ Main Content ] start -->\r                            <div class=\"row\">\r                    <!-- Column -->\r                    <div class=\"col-lg-12\">\r                        <div class=\"card mb-4\">\r\t\t\t\t\t\t\t<div class=\"card-header bg-primary py-3\">\r                \t\t\t\t<h4 align=\"center\" class=\"m-0 font-weight-bold text-white\"><i class=\"fas fa-bullhorn\" style=\"font-size:20px\">&nbsp;&nbsp;</i>Add A Notification</h4>\r                \t\t\t</div>\r                         <div class=\"card-body\">\r\t\t\t\t\t\t<form method=\"post\">\r                                <div class=\"form-group\">\r                                    <label class=\"form-label \" for=\"Title\"><strong>Message Title</strong></label>\r                                    <input class=\"form-control text-primary\" id=\"Title\" name=\"Title\" type=\"text\"/>\r                                </div>\r\t\t\t\t\t\t\t\t<div class=\"form-group\">\r                                    <label class=\"form-label \" for=\"Description\"><strong>Message</strong></label>\r                                    <input class=\"form-control text-primary\" id=\"Description\" name=\"Description\" type=\"text\"/>\r                                </div>\r\t\t\t\t\t\t\t    <div class=\"form-group\">\r\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"CreateDate\" value=\"";
echo date("Y-m-d h:i:s");
echo "\"/>\r                                </div>\r                                <div align=\"center\" class=\"form-group\">\r\t\t\t\t\t\t\t\t\t\t<br>\r\t\t\t\t\t\t\t\t\t\t<button class=\"btn btn-danger\" name=\"submit\" type=\"submit\"><span class=\"icon text-white-50\"><i class=\"fa fa-plus\"></i>&nbsp;&nbsp;</span><span class=\"text\"> Add A Notification</span></button>\r                                </div>\r                            </form>\r                            </div>\r                        </div>\r                    </div>\r                    <!-- Column -->\r                </div>\r            </div>\r            <!-- ============================================================== -->\r            <!-- End Container fluid  -->\r            <!-- ============================================================== -->\r        </div>\r        <!-- ============================================================== -->\r        <!-- End Page wrapper  -->\r        <!-- ============================================================== -->\r    </div>\r";
include "includes/functions.php";

?>