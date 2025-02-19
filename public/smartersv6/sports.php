<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2 & 7.3
 * @ Decoder version: 1.0.6
 * @ Release: 10/08/2022
 */

$db = new SQLite3("./api/data/.boxbr_sports.db");
$table_name = "boxbrsports";
$base_file = basename($_SERVER["SCRIPT_NAME"]);
$db->exec("CREATE TABLE IF NOT EXISTS " . $table_name . "(id INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL, api TEXT, header_n TEXT, border_c TEXT, background_c TEXT, text_c TEXT, days TEXT, auto_s TEXT, url TEXT, urljs TEXT, type TEXT)");
$rows = $db->query("SELECT COUNT(*) as count FROM " . $table_name);
$row = $rows->fetchArray();
$numRows = $row["count"];
if ($numRows == 0) {
    $db->exec("INSERT INTO " . $table_name . "(id, api, header_n, border_c, background_c, text_c, days, auto_s, url, urljs, type) VALUES('1', '5cc316f797659', 'Event', '#000000', '#000000', '#ffffff', '3', '1', 'https://www.tvsportguide.com/widget/5cc316f797659?filter_mode=all&filter_value=&days=3&heading=Event&border_color=custom&autoscroll=1&prev_nonce=a7242d2019&custom_colors=000000,000000,ffffff','js_code', '0')");
}
$resU = $db->query("SELECT * FROM " . $table_name . " WHERE id='1'");
$rowU = $resU->fetchArray();
$new_url = str_replace(" ", "", $rowU["url"]);
$new_js = $rowU["urljs"];
if (isset($_POST["submit"])) {
    $new_url = str_replace(" ", "", $_POST["url"]);
    $new_js = htmlentities($_POST["urljs"]);
    $db->exec("UPDATE " . $table_name . " SET api='" . $_POST["api"] . "',\r\n\t                                    header_n='" . $_POST["header_n"] . "',\r\n\t\t\t\t\t\t\t\t\t\tborder_c='" . $_POST["border_c"] . "', \r\n\t\t\t\t\t\t\t\t\t\tbackground_c='" . $_POST["background_c"] . "', \r\n\t\t\t\t\t\t\t\t\t\ttext_c='" . $_POST["text_c"] . "',\r\n\t\t\t\t\t\t\t\t\t\tdays='" . $_POST["days"] . "',\r\n\t\t\t\t\t\t\t\t\t\tauto_s='" . $_POST["auto_s"] . "',\r\n\t\t\t\t\t\t\t\t\t\turl='" . $new_url . "',\r\n\t\t\t\t\t\t\t\t\t\turljs='" . $new_js . "',\r\n\t\t\t\t\t\t\t\t\t\ttype='" . $_POST["type"] . "'\r\n\t\t\t\t\t\t\t\t\tWHERE \r\n\t\t\t\t\t\t\t\t\t\tid='1'");
    $db->close();
    header("Location: " . $base_file);
}
include "includes/header.php";
echo "\r\n<!-- [ Main Content ] start -->\r\n    <div class=\"pcoded-main-container\">\r\n        <div class=\"pcoded-wrapper\">\r\n            <div class=\"pcoded-content\">\r\n                <div class=\"pcoded-inner-content\">\r\n                    <div class=\"main-body\">\r\n                        <div class=\"page-wrapper\">\r\n                            <!-- [ Main Content ] start -->\r\n                            <div class=\"row\">\r\n                    <!-- Column -->\r\n                    <div class=\"col-lg-12\">\r\n                        <div class=\"card mb-4\">\r\n\t\t\t\t\t\t\t<div class=\"card-header bg-primary py-3\">\r\n                \t\t\t\t<h4 align=\"center\" class=\"m-0 font-weight-bold text-white\"><i class=\"fas fa-futbol\"></i>  Widget Sports Events\r\n\t\t\t\t\t\t</center></h4>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"card-body\">\r\n\t\t\t\t\t\t\t<form method=\"post\">\r\n\t\t\t\t  \r\n\t\t\t\t\t\t\t\t<div class=\"form-group \">\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-line\">\r\n\t\t\t\t\t\t\t\t\t  <label class=\"form-group form-float form-group-lg\">Sports Widget Type:\r\n\t\t\t\t\t\t\t\t\t  </label>  \r\n\r\n\t\t\t\t\t\t\t\t\t  <select class=\"form-control type\" id=\"type\" name=\"type\">\r\n\t\t\t\t\t\t\t\t\t\t  <option data-value=\"op0\" value=\"0\" ";
echo $rowU["type"] == "0" ? "selected" : "";
echo ">Default Dashboard Widget\t\t\t\t\t\t\t\t\t\t  </option>\r\n\t\t\t\t\t\t\t\t\t\t  <option data-value=\"op1\" value=\"1\" ";
echo $rowU["type"] == "1" ? "selected" : "";
echo ">Enter External URL Widget\r\n\t\t\t\t\t\t\t\t\t\t  </option>\r\n\t\t\t\t\t\t\t\t\t\t  <option data-value=\"op2\" value=\"2\" ";
echo $rowU["type"] == "2" ? "selected" : "";
echo ">Enter External JS Widget\r\n\t\t\t\t\t\t\t\t\t\t  </option>\r\n\t\t\t\t\t\t\t\t\t  </select>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t<div class=\"activeu\">\t\t  \r\n\t\t\t\t\t\t\t\t<div class=\"form-group \">\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-line\">\r\n\t\t\t\t\t\t\t\t\t  <label class=\"form-group form-float form-group-lg\">Sports URL</label>\r\n\t\t\t\t\t\t\t\t\t  <input type=\"text\" class=\"form-control text-primary\" style=\"text-align:center;\"\r\n\t\t\t\t\t\t\t\t\t  name=\"url\" value=\"";
echo $new_url;
echo "\" placeholder=\"Enter Sports URL\">\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t<div class=\"activej\">\t\t  \r\n\t\t\t\t\t\t\t\t<div class=\"form-group \">\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-line\">\r\n\t\t\t\t\t\t\t\t\t  <label class=\"form-group form-float form-group-lg\">Sports Widget JS</label>\r\n\t\t\t\t\t\t\t\t\t  \r\n\t\t\t\t\t\t\t\t\t  <textarea  rows=\"6\" id=\"urls\" name=\"urljs\"  class=\"form-control text-primary\" style=\"text-align:center;\" placeholder=\"Enter Sports  Widget JavaScript\">";
echo $new_js;
echo "</textarea>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t<div class=\"actived\">\r\n\t\t\t\t\t\t\t\t    \r\n\t\t\t\t\t\t\t\t<div class=\"form-group \">\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-line\">\r\n\t\t\t\t\t\t\t\t\t\t<label class=\"form-group form-float form-group-lg\">Api Code</label>\r\n\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\" name=\"api\" value=\"";
echo $rowU["api"];
echo "\" type=\"text\"/>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t<div class=\"form-group \">\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-line\">\r\n\t\t\t\t\t\t\t\t\t\t<label class=\"form-group form-float form-group-lg\">Border</label>\r\n\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\" name=\"border_c\" value=\"";
echo $rowU["border_c"];
echo "\" type=\"color\"/>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\r\n\t\t\t\t\t\t\t\t<div class=\"form-group \">\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-line\">\r\n\t\t\t\t\t\t\t\t\t\t<label class=\"form-group form-float form-group-lg\">Background Color</label>\r\n\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\" name=\"background_c\" value=\"";
echo $rowU["background_c"];
echo "\" type=\"color\"/>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\r\n\t\t\t\t\t\t\t\t<div class=\"form-group \">\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-line\">\r\n\t\t\t\t\t\t\t\t\t\t<label class=\"form-group form-float form-group-lg\">Text Color</label>\r\n\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\" name=\"text_c\" value=\"";
echo $rowU["text_c"];
echo "\" type=\"color\"/>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\r\n\t\t\t\t\t\t\t\t<div class=\"form-group \">\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-line\">\r\n\t\t\t\t\t\t\t\t\t  <label class=\"form-group form-float form-group-lg\">Days</label>\r\n\t\t\t\t\t\t\t\t\t  <select class=\"form-control\" id=\"select\" name=\"days\">\r\n\t\t\t\t\t\t\t\t\t\t  <option value=\"1\" ";
echo $rowU["days"] == "1" ? "selected" : "";
echo ">1</option>\r\n\t\t\t\t\t\t\t\t\t\t  <option value=\"3\" ";
echo $rowU["days"] == "3" ? "selected" : "";
echo ">3</option>\r\n\t\t\t\t\t\t\t\t\t\t  <option value=\"7\" ";
echo $rowU["days"] == "7" ? "selected" : "";
echo ">7</option>\r\n\t\t\t\t\t\t\t\t\t  </select>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t  \r\n\t\t\t\t\t\t\t\t<div class=\"form-group \">\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-line\">\r\n\t\t\t\t\t\t\t\t\t  <label class=\"form-group form-float form-group-lg\">Auto Scroll</label>\r\n\t\t\t\t\t\t\t\t\t  <select class=\"form-control\" id=\"select\" name=\"auto_s\">\r\n\t\t\t\t\t\t\t\t\t\t  <option value=\"0\" ";
echo $rowU["auto_s"] == "0" ? "selected" : "";
echo ">No</option>\r\n\t\t\t\t\t\t\t\t\t\t  <option value=\"1\" ";
echo $rowU["auto_s"] == "1" ? "selected" : "";
echo ">Yes</option>\r\n\t\t\t\t\t\t\t\t\t  </select>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t<div class=\"form-group \">\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-line\">\r\n\t\t\t\t\t\t\t\t\t\t<label class=\"form-group form-float form-group-lg\">Header Name</label>\r\n\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\" name=\"header_n\" value=\"";
echo $rowU["header_n"];
echo "\" type=\"text\"/>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\r\n\t\t\t\t\t\t\t\t\r\n</div>\r\n\t\t\t\t\t\t\t\t<hr>\r\n\t\t\t\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t\t\t\t<center>\r\n\t\t\t\t\t<button class=\"btn btn-danger\" name=\"submit\"  type=\"submit\"><span class=\"icon text-white-50\"><i class=\"fa fa-save\"></i>&nbsp;&nbsp;</span><span class=\"text\">  Save Settings</span></button>\r\n                                </div>\r\n\t\t\t\t\t\t\t\t\t</center>\r\n\t\t\t\t\t\t\t\t</div>\r\n              \t\t\t</form>\r\n                         </div>\r\n                         </div>\r\n                        </div>\r\n                    </div>\r\n                    <!-- Column -->\r\n                </div>\r\n            </div>\r\n            <!-- ============================================================== -->\r\n            <!-- End Container fluid  -->\r\n            <!-- ============================================================== -->\r\n        </div>\r\n        <!-- ============================================================== -->\r\n        <!-- End Page wrapper  -->\r\n        <!-- ============================================================== -->\r\n    </div>\r\n    \r\n    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>\r\n    <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js\"></script>\r\n    <script>\r\n//select activecode form\r\n//var response = {};\r\n//response.val = \"op2\";\r\n//\$(\"#codemode option[data-value='\" + response.val +\"']\").attr(\"selected\",\"selected\");\r\n\r\n//hide activecode form\r\n//\$('.actived').show(); \r\n//\$('.activeu').hide(); \r\n//\$('.activej').hide(); \r\n\r\n\r\n//Show/hide activecode select\r\n\$(document).ready(function(){\r\n  \$('.type').change(function(){\r\n    if(\$('.type').val() == '2') {\r\n      \$('.activej').show(); \r\n      \$('.activeu').hide(); \r\n      \$('.actived').hide(); \r\n    }\r\n    if(\$('.type').val() == '1') {\r\n      \$('.activej').hide(); \r\n      \$('.activeu').show(); \r\n      \$('.actived').hide(); \r\n    }\r\n    if(\$('.type').val() == '0') {\r\n      \$('.activej').hide(); \r\n      \$('.activeu').hide(); \r\n      \$('.actived').show(); \r\n     //document.getElementById(\"activeu\").value = ' ';\r\n     //document.getElementById(\"activej\").value = ' ';\r\n    } \r\n  });\r\n  \$('.type').ready(function(){\r\n    if(\$('.type').val() == '2') {\r\n      \$('.activeu').hide(); \r\n      \$('.actived').hide(); \r\n      \$('.activej').show(); \r\n    }\r\n    if(\$('.type').val() == '1') {\r\n      \$('.activej').hide(); \r\n      \$('.activeu').show(); \r\n      \$('.actived').hide(); \r\n    }\r\n    if(\$('.type').val() == '0') {\r\n      \$('.activej').hide(); \r\n      \$('.activeu').hide(); \r\n      \$('.actived').show(); \r\n    // document.getElementById(\"actived\").value = ' ';\r\n      \r\n    } \r\n  });\r\n});\r\n</script>\r\n";
include "includes/functions.php";

?>