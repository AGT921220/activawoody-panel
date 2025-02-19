<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

include "includes/header.php";
$table_name = "dns";
$db->exec("CREATE TABLE IF NOT EXISTS " . $table_name . "(id INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL, title TEXT, url TEXT)");
$res = $db->query("SELECT * FROM " . $table_name);
$resU = @$db->query("SELECT * FROM " . $table_name . " WHERE id='" . @sanitize($_GET["update"]) . "'");
$rowU = @$resU->fetchArray();
if (isset($_POST["submitU"])) {
    submit("sub_up", $db, $table_name);
    header("Location: " . $base_file . "?status=2");
}
if (isset($_POST["submit"])) {
    submit("sub_new", $db, $table_name);
    header("Location: " . $base_file . "?status=1");
}
if (isset($_GET["delete"])) {
    submit("sub_del", $db, $table_name);
    header("Location: " . $base_file . "?status=3");
}
echo "<div class=\"modal fade\" id=\"confirm-delete\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">\r\n    <div class=\"modal-dialog\">\r\n        <div class=\"modal-content\">\r\n            <div class=\"modal-header\">\r\n                <h2>Confirm</h2>\r\n            </div>\r\n            <div class=\"modal-body\">\r\n                Do you really want to delete?\r\n            </div>\r\n            <div class=\"modal-footer\">\r\n                <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Cancel</button>\r\n                <a class=\"btn btn-danger btn-ok\">Delete</a>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>\r\n";
if (isset($_GET["create"])) {
    echo "        <div class=\"col-md-8 mx-auto\">\r\n            <div class=\"card-body\">\r\n                <div class=\"card bg-primary text-white\">\r\n                    <div class=\"card-header card-header-warning\">\r\n                        <center>\r\n                            <h2><i class=\"icon icon-bullhorn\"></i> DNS's</h2>\r\n                        </center>\r\n                    </div>\r\n                    \r\n                    <div class=\"card-body\">\r\n                        <div class=\"col-12\">\r\n                            <h3>Create DNS</h3>\r\n                        </div>\r\n                            <form method=\"post\">\r\n                                <div class=\"form-group\">\r\n                                    <label class=\"form-label \" for=\"title\">Title</label>\r\n                                        <input class=\"form-control\" id=\"description\" name=\"title\" placeholder=\"Title\" type=\"text\"/>\r\n                                </div>\r\n                                <div class=\"form-group\">\r\n                                    <label class=\"form-label \" for=\"dns\">DNS</label>\r\n                                        <input class=\"form-control\" id=\"description\" name=\"url\" placeholder=\"DNS\" type=\"text\"/>\r\n                                </div>\r\n                                <div class=\"form-group\">\r\n                                    <center>\r\n                                        <button class=\"btn btn-info \" name=\"submit\" type=\"submit\">\r\n                                            <i class=\"icon icon-check\"></i> Submit\r\n                                        </button>\r\n                                    </center>\r\n                                </div>\r\n                            </form>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n\r\n";
} else {
    if (isset($_GET["update"])) {
        echo "        <div class=\"col-md-8 mx-auto\">\r\n            <div class=\"card-body\">\r\n                <div class=\"card bg-primary text-white\">\r\n                    <div class=\"card-header card-header-warning\">\r\n                        <center>\r\n                            <h2><i class=\"icon icon-bullhorn\"></i> DNS's</h2>\r\n                        </center>\r\n                    </div>\r\n                    \r\n                    <div class=\"card-body\">\r\n                        <div class=\"col-12\">\r\n                            <h3>Edit DNS</h3>\r\n                        </div>\r\n                            <form method=\"post\">\r\n                                <div class=\"form-group\">\r\n                                    <label class=\"form-label \" for=\"title\">Title</label>\r\n                                        <input class=\"form-control\" id=\"description\" name=\"title\" placeholder=\"Title\" value=\"";
        echo $rowU["title"];
        echo "\" type=\"text\"/>\r\n                                </div>\r\n                                <div class=\"form-group\">\r\n                                    <label class=\"form-label \" for=\"dns\">DNS</label>\r\n                                        <input class=\"form-control\" id=\"description\" name=\"url\" placeholder=\"DNS\" value=\"";
        echo $rowU["url"];
        echo "\" type=\"text\"/>\r\n                                </div>\r\n                                <div class=\"form-group\">\r\n                                    <center>\r\n                                        <button class=\"btn btn-info \" name=\"submitU\" type=\"submit\">\r\n                                            <i class=\"icon icon-check\"></i> Submit\r\n                                        </button>\r\n                                    </center>\r\n                                </div>\r\n                            </form>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n";
    } else {
        echo "        <div class=\"col-md-12 mx-auto\">\r\n            <div class=\"card-body\">\r\n                <div class=\"card bg-primary text-white\">\r\n                    <div class=\"card-header card-header-warning\">\r\n                        <center>\r\n                            <h2><i class=\"icon icon-commenting\"></i> DNS's</h2>\r\n                        </center>\r\n                    </div>\r\n\r\n                    <div class=\"card-body\">\r\n                        <div class=\"col-12\">\r\n                        \t<center>\r\n\t        \t\t\t\t\t<a id=\"button\" href=\"./";
        echo $base_file;
        echo "?create\" class=\"btn btn-info\">New DNS</a>\r\n\t        \t\t\t\t</center>\r\n    \t\t\t\t\t</div>\r\n\t\t\t\t\t\t<br>\r\n\t\t\t\t\t\t<div class=\"table-responsive\">\r\n\t\t\t\t\t\t\t<table class=\"table table-striped table-sm\">\r\n\t\t\t\t\t\t\t<thead style=\"color:white!important\">\r\n\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t<th>Index</th>\r\n\t\t\t\t\t\t\t\t<th>Title</th>\r\n\t\t\t\t\t\t\t\t<th>DNS</th>\r\n\t\t\t\t\t\t\t\t<th>Edit&nbsp&nbsp&nbspDelete</th>\r\n\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t</thead>\r\n\t\t\t\t\t\t\t";
        while ($row = $res->fetchArray()) {
            echo "\t\t\t\t\t\t\t<tbody>\r\n\t\t\t\t\t\t\t\t<tr>\r\n\t\t\t\t\t\t\t\t<td>";
            echo $row["id"];
            echo "</td>\r\n\t\t\t\t\t\t\t\t<td>";
            echo $row["title"];
            echo "</a></td>\r\n\t\t\t\t\t\t\t\t<td>";
            echo $row["url"];
            echo "</td>\r\n\t\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t<a class=\"btn btn-info btn-ok\" href=\"./";
            echo $base_file;
            echo "?update=";
            echo $row["id"];
            echo "\"><i class=\"fa fa-pencil-square-o\"></i></a>\r\n\t\t\t\t\t\t\t\t&nbsp&nbsp&nbsp\r\n\t\t\t\t\t\t\t\t<a class=\"btn btn-danger btn-ok\" href=\"#\" data-href=\"./";
            echo $base_file;
            echo "?delete=";
            echo $row["id"];
            echo "\" data-toggle=\"modal\" data-target=\"#confirm-delete\"><i class=\"fa fa-trash-o\"></i></a>\r\n\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t</tbody>\r\n\t\t\t\t\t\t\t";
        }
        echo "\t\t\t\t\t\t\t</table>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t</div>\r\n\t\t\t</div>\r\n\t\t</div>\r\n";
    }
}
echo "\r\n";
include "includes/footer.php";
echo "\r\n</body>\r\n</html>";
// @Protected ioncube.dk encoding key.
function Submit()
{
}

?>