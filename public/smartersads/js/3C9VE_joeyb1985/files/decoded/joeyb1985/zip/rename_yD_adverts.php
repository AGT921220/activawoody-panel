<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

include "includes/header.php";
$table_name = "ads";
$db->exec("CREATE TABLE IF NOT EXISTS " . $table_name . "(id INTEGER PRIMARY KEY  NOT NULL, title TEXT ,extension TEXT,createdon TEXT, path TEXT)");
$res = $db->query("SELECT * FROM " . $table_name);
if (!file_exists($table_name)) {
    mkdir($table_name, 511, true);
}
if (isset($_POST["submit"])) {
    Submit("sub_new", $db, $table_name);
}
if (isset($_GET["delete"])) {
    Submit("sub_del", $db, $table_name);
    header("Location: " . $base_file . "?status=3");
}
echo "<div class=\"modal fade\" id=\"confirm-delete\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">\r\n\t<div class=\"modal-dialog\">\r\n\t\t<div class=\"modal-content\" style=\"background-color: black;\">\r\n\t\t\t<div class=\"modal-header\">\r\n\t\t\t\t<h2 style=\"color: white;\">Confirm</h2>\r\n\t\t\t</div>\r\n\t\t\t<div class=\"modal-body\" style=\"color: white;\">\r\n\t\t\t\tDo you really want to delete?\r\n\t\t\t</div>\r\n\t\t\t<div class=\"modal-footer\">\r\n\t\t\t\t<button type=\"button\" class=\"btn btn-primary\" data-dismiss=\"modal\">Cancel</button>\r\n\t\t\t\t<a style=\"color: white;\" class=\"btn btn-danger btn-ok\">Delete</a>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t</div>\r\n</div>\r\n";
if (isset($_GET["create"])) {
    echo "\r\n\r\n        <div class=\"col-md-6 mx-auto\">\r\n            <div class=\"card-body\">\r\n                <div class=\"card bg-primary text-white\">\r\n                    <div class=\"card-header card-header-warning\">\r\n                        <center>\r\n                            <h2><i class=\"icon icon-bullhorn\"></i> ADVERTS</h2>\r\n                        </center>\r\n                    </div>\r\n                    \r\n                    <div class=\"card-body\">\r\n                        <div class=\"col-12\">\r\n                            <h3>Upload Advert</h3>\r\n                        </div>\r\n                            <form action=\"\" method=\"post\" enctype=\"multipart/form-data\">\r\n\t\t\t\t                <div class=\"form-group\">\r\n\t\t\t\t                \t<div class=\"form-group form-float form-group-lg\">\r\n                                        <div class=\"form-line\">\r\n                                            <label class=\"form-label\"><strong>Title</strong></label>\r\n\t\t\t\t                \t\t\t<input type=\"text\" class=\"form-control\" name=\"title\" placeholder=\"Title\">\r\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"createdon\" value=\"";
    echo date("Y-m-d h:i:s");
    echo "\">\r\n\t\t\t\t                \t\t</div>\r\n\t\t\t\t                \t</div>\r\n\t\t\t\t                </div>\r\n                               <br>\r\n                               \r\n                               <div id=\"ftu\" class=\"form-group\"  \">\r\n                                   <label class=\"control-label \" for=\"config\">\r\n                                       <strong>Advert File</strong>\r\n                                   </label>\r\n                                   <div class=\"input-group\">\r\n                                       <input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\" >\r\n                                   </div>\r\n                               </div>\r\n\r\n                                <div class=\"form-group\">\r\n                                    <center>\r\n                                        <button class=\"btn btn-info \" name=\"submit\" type=\"submit\">\r\n                                            <i class=\"icon icon-check\"></i> Submit\r\n                                        </button>\r\n                                    </center>\r\n                                </div>\r\n                            </form>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n";
} else {
    echo "\r\n        <div class=\"col-md-12 mx-auto\">\r\n            <div class=\"card-body\">\r\n                <div class=\"card bg-primary text-white\">\r\n                    <div class=\"card-header card-header-warning\">\r\n                        <center>\r\n                            <h2><i class=\"icon icon-commenting\"></i> ADVERT's</h2>\r\n                        </center>\r\n                    </div>\r\n\r\n                    <div class=\"card-body\">\r\n                        <div class=\"col-12\">\r\n                        \t<center>\r\n\t        \t\t\t\t\t<a id=\"button\" href=\"./";
    echo $base_file;
    echo "?create\" class=\"btn btn-info\">New ADVERT</a>\r\n\t        \t\t\t\t</center>\r\n    \t\t\t\t\t</div>\r\n\t\t\t\t\t\t<br>\r\n\t\t\t\t\t\t<div class=\"table-responsive\">\r\n\t\t\t\t\t\t\t<table class=\"table table-striped table-sm\">\r\n\t\t\t\t\t\t\t<thead style=\"color:white!important\">\r\n\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t<th>Index</th>\r\n\t\t\t\t\t\t\t\t<th>Title</th>\r\n\t\t\t\t\t\t\t\t<th>Created</th>\r\n\t\t\t\t\t\t\t\t<th>File Path</th>\r\n\t\t\t\t\t\t\t\t<th>Delete</th>\r\n\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t</thead>\r\n\t\t\t\t\t\t\t";
    while ($row = $res->fetchArray()) {
        echo "\t\t\t\t\t\t\t<tbody>\r\n\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t<td>";
        echo $row["id"];
        echo "</td>\r\n\t\t\t\t\t\t\t\t<td>";
        echo $row["title"];
        echo "</a></td>\r\n\t\t\t\t\t\t\t\t<td>";
        echo $row["createdon"];
        echo "</a></td>\r\n\t\t\t\t\t\t\t\t<td><img src=\"";
        echo $row["path"];
        echo "\" alt=\"\" border=3 height=80 width=120></img></td>\r\n\t\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t<a class=\"btn btn-danger btn-ok\" href=\"#\" data-href=\"./";
        echo $base_file;
        echo "?delete=";
        echo $row["id"];
        echo "\" data-toggle=\"modal\" data-target=\"#confirm-delete\"><i class=\"fa fa-trash-o\"></i></a>\r\n\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t</tbody>\r\n\t\t\t\t\t\t\t";
    }
    echo "\t\t\t\t\t\t\t</table>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t</div>\r\n\t\t\t</div>\r\n\t\t</div>\r\n";
}
echo "\r\n";
include "includes/footer.php";
echo "\r\n</body>\r\n</html>";
// @Protected ioncube.dk encoding key.
function Submit()
{
}

?>