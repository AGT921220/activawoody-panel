<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
$intro_file = "intro.mp4";
$folder_name = "intro/";
$folder_data = "includes/";
$file_api = $folder_data . "intro_settings.json";
$jsondata = file_get_contents($file_api);
$data = json_decode($jsondata, true);
$json = $data["app"];
if (isset($_POST["intro_on_off"])) {
    $jsonData = file_get_contents($file_api);
    $arrayData = json_decode($jsonData, true);
    if (empty($_POST["intro_on_off"])) {
        $intro_on_off = "no";
    } else {
        $intro_on_off = $_POST["intro_on_off"];
    }
    if (empty($_POST["intro_url"])) {
        $intro_url = "";
    } else {
        $intro_url = $_POST["intro_url"];
    }
    $replacementData = ["app" => ["intro" => $intro_on_off, "intro_url" => $intro_url]];
    $newArrayData = array_replace_recursive($arrayData, $replacementData);
    $newJsonData = json_encode($newArrayData, JSON_UNESCAPED_UNICODE);
    file_put_contents($file_api, $newJsonData);
    header("Location: intro.php?message=" . $message);
}
if (isset($_POST["images"])) {
    $errors = [];
    $file_name = $_FILES["image"]["name"];
    $file_size = $_FILES["image"]["size"];
    $file_tmp = $_FILES["image"]["tmp_name"];
    $file_type = $_FILES["image"]["type"];
    $file_ext = strtolower(end(explode(".", $_FILES["image"]["name"])));
    $extensions = ["jpeg", "jpg", "png", "gif", "JPEG", "JPG", "PNG", "GIF", "mp4", "MP4"];
    if (in_array($file_ext, $extensions) === false) {
    }
    if (11242880 < $file_size) {
    }
    if (empty($errors)) {
        if ($_POST["image"] == "intro") {
            $file_name1 = "intro.mp4";
        }
        move_uploaded_file($file_tmp, $folder_name . $file_name1);
        header("Location: " . $_SERVER["PHP_SELF"]);
    } else {
        header("Location: " . $_SERVER["PHP_SELF"]);
    }
}
include "includes/header.php";
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(32767);
echo "\r\n<!-- [ Main Content ] start -->\r\n    <div class=\"pcoded-main-container\">\r\n        <div class=\"pcoded-wrapper\">\r\n            <div class=\"pcoded-content\">\r\n                <div class=\"pcoded-inner-content\">\r\n                    <div class=\"main-body\">\r\n                        <div class=\"page-wrapper\">\r\n                            <!-- [ Main Content ] start -->\r\n\r\n                            <div class=\"row\">\r\n                    <!-- Column -->\r\n\r\n                    <div class=\"col-lg-12\">\r\n                        <div class=\"card mb-4\">\r\n\t\t\t\t\t\t\t<div class=\"card-header bg-primary py-3\">\r\n                \t\t\t\t<h4 align=\"center\" class=\"m-0 font-weight-bold text-white\"><i class=\"fas fa-video\" style=\"font-size:20px\">&nbsp;&nbsp;</i>Intro Video </h4>\r\n                \t\t\t</div>\r\n                \t\t\t<div class=\"card-body\">\r\n                \t\t\t    <center>\r\n        <form name=\"\" id=\"onoff\" method=\"post\" enctype=\"multipart/form-data\">\r\n                        <div class=\"form-group \">\r\n                            \t<h6 align=\"center\" class=\"m-0 font-weight-bold text-white\">\r\n                             <strong> Active Intro Video ?</strong>\r\n                            </h6>\r\n<p>\r\n                        <label>Yes <input type=\"radio\" onchange=\"formSubmit(this)\" class=\"option--input\" id=\"radio1\" name=\"intro_on_off\" value=\"yes\"  ";
if ($json["intro"] == "yes") {
    echo "checked=\\\"checked\\\"";
}
echo "> </label> &nbsp&nbsp&nbsp\r\n            <label>No <input type=\"radio\" onchange=\"formSubmit(this)\" class=\"option--input\" id=\"radio2\" name=\"intro_on_off\" value=\"no\" ";
if ($json["intro"] == "no") {
    echo "checked=\\\"checked\\\"";
}
echo "></label>\r\n                     </form>\r\n                </div></center>\r\n                \r\n\t\t\t\t\t\t<form method=\"post\" enctype=\"multipart/form-data\">\r\n                            <label class=\"control-label \" for=\"intro\">\r\n                               <strong> Upload Intro Video File</strong>\r\n                           </label>\r\n\t\t\t\t\t\t<div class=\"input-group\">\r\n\t\t\t\t\t\t<div class=\"custom-file\">\r\n\t\t\t\t\t\t<input type=\"file\" class=\"custom-file-input\" name=\"image\" id=\"intro\" placeholder=\"Choose Intro\" onchange=\"uploadintro(this)\" aria-describedby=\"intro\">\r\n\t\t\t<label class=\"custom-file-label\" for=\"intro\" placeholder=\"Choose Intro\"><span id=\"image-intro\"></span></label>\r\n\t\t\t\t<input type=\"hidden\" name=\"image\" value=\"intro\">\r\n\t\t\t\t\t</div>\r\n\t\t\t</div>\r\n\t\t\t                                <div align=\"center\" class=\"form-group\">\r\n\t\t\t\t\t\t\t\t\t\t<br>\r\n\t\t\t\t\t\t\t\t\t\t<button class=\"btn btn-danger\" name=\"images\"  type=\"submit\"><span class=\"icon text-white-50\"><i class=\"fa fa-plus\"></i>&nbsp;&nbsp;</span><span class=\"text\"> Upload Video</span></button>\r\n                                </div>\r\n\r\n\t\t\t\t\t\t\t</form>\r\n\r\n                         <div align=\"center\"  class=\"form-group\">\r\n\t\t\t\t\t\t \r\n\t\t\t\t\t\t <div class=\"text-xs font-weight-bold text-primary text-uppercase mb-1\">Current Intro</div>\r\n                      <div class=\"h5 mb-0 font-weight-bold text-gray-800\"><video controls=\"\" autoplay=\"\" name=\"media\" width=\"600\"><source src=\"";
echo $folder_name . $intro_file . "?" . time();
echo "\" type=\"video/mp4\"></video></div>\r\n\t\t\t\t\t\t \r\n                        </div>\r\n\r\n                      \r\n                            </form>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <!-- Column -->\r\n                </div>\r\n            </div>\r\n            <!-- ============================================================== -->\r\n            <!-- End Container fluid  -->\r\n            <!-- ============================================================== -->\r\n        </div>\r\n        <!-- ============================================================== -->\r\n        <!-- End Page wrapper  -->\r\n        <!-- ============================================================== -->\r\n    </div>\r\n\r\n<script>\r\nfunction formSubmit(radioObj){\r\n  if(radioObj.checked){\r\n    document.getElementById(\"onoff\").submit();\r\n\r\n  }\r\n}\r\n</script>\r\n<script>function uploadintro(target) {\n\tdocument.getElementById(\"image-intro\").innerHTML = target.files[0].name;\n}\n\n\$(document).ready(function() {\n    if (location.hash) {\n        \$(\"a[href='\" + location.hash + \"']\").tab(\"show\");\n    }\n    \$(document.body).on(\"click\", \"a[data-toggle='tab']\", function(event) {\n        location.hash = this.getAttribute(\"href\");\n    });\n});\n\$(window).on(\"popstate\", function() {\n    var anchor = location.hash || \$(\"a[data-toggle='tab']\").first().attr(\"href\");\n    \$(\"a[href='\" + anchor + \"']\").tab(\"show\");\n});\n\n</script>";
include "includes/functions.php";

?>