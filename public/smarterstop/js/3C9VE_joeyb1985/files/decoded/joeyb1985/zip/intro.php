<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

error_reporting(0);
include "includes/header.php";
$table_name = "intro";
$db->exec("CREATE TABLE IF NOT EXISTS " . $table_name . "(id INTEGER PRIMARY KEY,url TEXT)");
$rows = $db->query("SELECT COUNT(*) as count FROM " . $table_name);
$row = $rows->fetchArray();
$numRows = $row["count"];
if ($numRows == 0) {
    $db->exec("INSERT INTO " . $table_name . "(url) VALUES('')");
}
$intro = $db->querySingle("SELECT url FROM intro WHERE id=1");
if (isset($_POST["submit"])) {
    submit("sub_new", $db, $table_name);
}
if (!file_exists("intro")) {
    mkdir("intro", 511, true);
}
echo "\r\n        <div class=\"col-md-6 mx-auto\">\r\n            <div class=\"card-body\">\r\n                <div class=\"card bg-primary text-white\">\r\n                    <div class=\"card-header card-header-warning\">\r\n                        <center>\r\n                            <h2><i class=\"icon icon-bullhorn\"></i> Intro</h2>\r\n                        </center>\r\n                    </div>\r\n                    \r\n                    <div class=\"card-body\">\r\n                        <div class=\"col-12\">\r\n                            <h3>Upload Intro</h3>\r\n\t\t\t\t\t\t\t<h6>For no intro leave URL blank and submit</h6>\r\n                        </div>\r\n                            <form action=\"\" method=\"post\" enctype=\"multipart/form-data\">\r\n                               <br>\r\n                               <div>\r\n                                   <label for=\"selector\">Select Intro Source</label>\r\n                                   <select class=\"form-control\"  style=\"width:auto;\" name = \"type\" onchange=\"yesnoCheck(this);\">\r\n                                       <option value=\"url\">URL</option>\r\n                                       <option value=\"file\">FILE</option>\r\n                                   </select>\r\n                               </div>\r\n                               <br>\r\n                               \r\n                               \r\n                               <div id=\"loc\" class=\"form-group form-float form-group-lg\">\r\n                                   <div class=\"form-line\">\r\n                                       <label class=\"form-label\"><strong>Intro URL</strong></label>\r\n                               \t\t<input type=\"text\" class=\"form-control\" name=\"intro_url\" placeholder=\"http://host.com/folder/video.mp4\">\r\n                               \t</div>\r\n                               </div>\r\n                               \r\n                               <div id=\"ftu\" class=\"form-group\"  style=\"display: none;\">\r\n                                   <label class=\"control-label \">\r\n                                       <strong>Intro File</strong>\r\n                                   </label>\r\n                                   <div class=\"input-group\">\r\n                                       <input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\" >\r\n                                   </div>\r\n                               </div>\r\n\r\n                                <div class=\"form-group\">\r\n                                    <center>\r\n                                        <button class=\"btn btn-info \" name=\"submit\" type=\"submit\">\r\n                                            <i class=\"icon icon-check\"></i> Submit\r\n                                        </button>\r\n                                    </center>\r\n                                </div>\r\n                            </form>\r\n                  <div class=\"align-items-center\">\r\n                        <center>\r\n                      <h3\">Current Intro</h3>\r\n                      <div><video width=\"500\" autoplay=\"true\" muted preload=\"auto\" controls>  <source src=\"";
echo $intro . "?t=" . time();
echo "\" type=\"video/mp4\"></video></div>\r\n                  </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n\r\n";
include "includes/footer.php";
echo "<script>\r\n\r\nfunction yesnoCheck(that){\r\n    if (that.value == \"url\"){\r\n        document.getElementById(\"loc\").style.display = \"block\";\r\n    }else{\r\n        document.getElementById(\"loc\").style.display = \"none\";\r\n    }\r\n    if (that.value == \"file\"){\r\n        document.getElementById(\"ftu\").style.display = \"block\";\r\n    }else{\r\n        document.getElementById(\"ftu\").style.display = \"none\";\r\n    }\r\n}\r\n</script>";
// @Protected ioncube.dk encoding key.
function Submit()
{
}

?>