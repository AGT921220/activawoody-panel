<?php

include "includes/header.php";
$table_name = "ads";
$db->exec("CREATE TABLE IF NOT EXISTS " . $table_name . "(id INTEGER PRIMARY KEY  NOT NULL, title TEXT ,extension TEXT,createdon TEXT, path TEXT)");
$db->exec("CREATE TABLE IF NOT EXISTS type (id INTEGER PRIMARY KEY  NOT NULL, type TEXT)");
$rowsc = $db->query("SELECT COUNT(*) as count FROM type");
$rowc = $rowsc->fetchArray();
$numRows = $rowc["count"];
if ($numRows == 0) {
    $db->exec("INSERT INTO type(type) VALUES('ua')");
}
$resT = $db->querySingle("SELECT type FROM type WHERE id=1");
$res = $db->query("SELECT * FROM " . $table_name);
if (!file_exists($table_name)) {
    mkdir($table_name, 511, true);
}
if (isset($_POST["submit"])) {
    Submit("sub_new", $db, $table_name);
}
if (isset($_POST["submit_type"])) {
    $db->exec("UPDATE type SET type='" . sanitize($_POST["type_1"]) . "'");
    $db->close();
	header('Location: ' . $base_file . '?status=2');
}
if (isset($_GET['delete'])) {
	Submit('sub_del', $db, $table_name);
	header('Location: ' . $base_file . '?status=3');
}
echo "<div class=\"modal fade\" id=\"confirm-delete\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">\r\n\t<div class=\"modal-dialog\">\r\n\t\t<div class=\"modal-content\" style=\"background-color: black;\">\r\n\t\t\t<div class=\"modal-header\">\r\n\t\t\t\t<h2 style=\"color: white;\">Confirm</h2>\r\n\t\t\t</div>\r\n\t\t\t<div class=\"modal-body\" style=\"color: white;\">\r\n\t\t\t\tDo you really want to delete?\r\n\t\t\t</div>\r\n\t\t\t<div class=\"modal-footer\">\r\n\t\t\t\t<button type=\"button\" class=\"btn btn-primary\" data-dismiss=\"modal\">Cancel</button>\r\n\t\t\t\t<a style=\"color: white;\" class=\"btn btn-danger btn-ok\">Delete</a>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t</div>\r\n</div>\r\n";
if (isset($_GET['create'])) {
	echo "\r\n\r\n" . '        <div class="col-md-6 mx-auto">' . "\r\n" . '            <div class="card-body">' . "\r\n" . '                <div class="card bg-primary text-white">' . "\r\n" . '                    <div class="card-header card-header-warning">' . "\r\n" . '                        <center>' . "\r\n" . '                            <h2><i class="icon fa fa-image"></i> ADVERTS</h2>' . "\r\n" . '                        </center>' . "\r\n" . '                    </div>' . "\r\n" . '                    ' . "\r\n" . '                    <div class="card-body">' . "\r\n" . '                        <div class="col-12">' . "\r\n" . '                            <h3>Upload Advert</h3>' . "\r\n" . '                        </div>' . "\r\n" . '                            <form action="" method="post" enctype="multipart/form-data">' . "\r\n\t\t\t\t" . '                <div class="form-group">' . "\r\n\t\t\t\t" . '                ' . "\t" . '<div class="form-group form-float form-group-lg">' . "\r\n" . '                                        <div class="form-line">' . "\r\n" . '                                            <label class="form-label"><strong>Title</strong></label>' . "\r\n\t\t\t\t" . '                ' . "\t\t\t" . '<input type="text" class="form-control" name="title" placeholder="Title">' . "\r\n\t\t\t\t\t\t\t\t\t\t\t" . '<input type="hidden" name="createdon" value="';
	echo date('Y-m-d h:i:s');
	echo '">' . "\r\n\t\t\t\t" . '                ' . "\t\t" . '</div>' . "\r\n\t\t\t\t" . '                ' . "\t" . '</div>' . "\r\n\t\t\t\t" . '                </div>' . "\r\n" . '                               <br>' . "\r\n" . '                               ' . "\r\n" . '                               <div id="ftu" class="form-group"  ">' . "\r\n" . '                                   <label class="control-label " for="config">' . "\r\n" . '                                       <strong>Advert File</strong>' . "\r\n" . '                                   </label>' . "\r\n" . '                                   <div class="input-group">' . "\r\n" . '                                       <input type="file" name="fileToUpload" id="fileToUpload" >' . "\r\n" . '                                   </div>' . "\r\n" . '                               </div>' . "\r\n\r\n" . '                                <div class="form-group">' . "\r\n" . '                                    <center>' . "\r\n" . '                                        <button class="btn btn-info " name="submit" type="submit">' . "\r\n" . '                                            <i class="icon icon-check"></i> Submit' . "\r\n" . '                                        </button>' . "\r\n" . '                                    </center>' . "\r\n" . '                                </div>' . "\r\n" . '                            </form>' . "\r\n" . '                    </div>' . "\r\n" . '                </div>' . "\r\n" . '            </div>' . "\r\n" . '        </div>' . "\r\n";
} else {
    echo "        <div class=\"col-md-12 mx-auto\">\r\n            <div class=\"card-body\">\r\n                <div class=\"card bg-primary text-white\">\r\n                    \r\n                    <div class=\"card-body\">\r\n                               <br>\r\n\t\t\t\t\t\t\t   \r\n\t\t\t\t\t\t\t   <center>\r\n\t\t\t\t\t\t\t<form action=\"\" method=\"post\">\r\n                               <div>\r\n                                   <label for=\"selector\">Select Advert Source</label>\r\n                                   <select class=\"form-control\"  style=\"width:auto;\" name = \"type_1\" onchange=\"yesnoCheck(this);\">\r\n\t\t\t\t\t\t\t\t\t\t<option value=\"ua\" ";
    echo $resT == "ua" ? "selected" : "";
    echo ">Manual Entry</option>\r\n\t\t\t\t\t\t\t\t\t\t<option value=\"rt\" ";
    echo $resT == "rt" ? "selected" : "";
    echo ">Rotten Tomatoes</option>\r\n                                   </select>\r\n\t\t\t\t\t\t\t\t   <button class=\"btn btn-info \" name=\"submit_type\" type=\"submit\"><i class=\"icon icon-check\"></i> Update</button>\r\n                               </div>\r\n                               <br>\r\n\t\t\t\t\t\t\t\t";
    echo $resT == "rt" ? "<label>Rotten Tomatoes is selected for use</label>" : "<label>Manual Entry is selected for use</label>";
    echo "<br>\r\n\t\t\t\t\t\t\t</form>\r\n                            </center>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t    </div>\r\n                </div>\r\n            </div>\r\n            <div id=\"ftu\" class=\"card-body\">\r\n                <div class=\"card bg-primary text-white\">\r\n                    <div class=\"card-header card-header-warning\">\r\n                        <center>\r\n                            <h2><i class=\"icon icon-commenting\"></i> ADVERT's</h2>\r\n                        </center>\r\n                    </div>\r\n                    <div class=\"card-body\" >\r\n                        <div class=\"col-12\">\r\n                        \t<center>\r\n\t        \t\t\t\t\t<a id=\"button\" href=\"./";
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
    echo "\t\t\t\t\t\t\t</table>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t</div>\r\n\t\t\t</div>\r\n\t\t</div>\r\n";
}
echo "\r\n";
include "includes/footer.php";
echo $resT == "rt" ? "<script>document.getElementById('ftu').style.display = 'none'</script>" : "";
echo "<script>\r\n\r\nfunction yesnoCheck(that){\r\n\r\n    if (that.value == \"ua\"){\r\n        document.getElementById(\"ftu\").style.display = \"block\";\r\n    }else{\r\n        document.getElementById(\"ftu\").style.display = \"none\";\r\n    }\r\n}\r\n</script>\r\n</body>\r\n</html>";

function Submit($sub_type, $db, $table_name)
{
    if ($sub_type == "sub_new") {
        $target_dir = "ads/";
        $target_file = preg_replace("/[^a-z0-9.]/i", "", basename($_FILES["fileToUpload"]["name"]));
        $gtg = 1;
        $ft = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $file_path = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off" ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/" . $target_dir;
        if (file_exists($target_dir . $target_file)) {
            unlink($target_dir . $target_file);
        }
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if (10000000 < $_FILES["fileToUpload"]["size"]) {
            echo "<div class=\"alert alert-danger\" id=\"success-alert1\"><h4><i class=\"icon fa fa-times\"></i>Sorry, your file is too large.</h4></div>";
            $gtg = 0;
        }
        if ($check = false) {
            echo "<div class=\"alert alert-danger\" id=\"success-alert\"><h4><i class=\"icon fa fa-times\"></i>Sorry, only OVPN files are allowed.</h4></div>";
            $gtg = 0;
        }
        if ($gtg != 0) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $target_file)) {
                $config = "" . $file_path . htmlspecialchars(basename($target_file)) . "";
                $file_name = htmlspecialchars(pathinfo($target_file)["extension"]);
            }
            $db->exec("INSERT INTO " . $table_name . "(title ,extension,createdon, path) VALUES('" . sanitize($_POST["title"]) . "','" . sanitize($file_name) . "','" . sanitize($_POST["createdon"]) . "', '" . $config . "')");
            $db->close();
			header('Location: ' . $base_file . '?status=1');        }
    } else {
        if ($sub_type == "sub_del") {
            $arr = $db->query("SELECT * FROM " . $table_name . " WHERE id=" . sanitize($_GET["delete"]));
            $del = $arr->fetchArray();
            $ftd = pathinfo($del["path"]);
            $ftdd = "ads/" . $ftd["basename"];
            unlink($ftdd);
            $db->exec("DELETE FROM " . $table_name . " WHERE id=" . sanitize($_GET["delete"]));
        }
    }
    $db->close();
}

?>