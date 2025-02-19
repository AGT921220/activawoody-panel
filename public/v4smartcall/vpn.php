<?php
/**
*
* @ This file is created by http://DeZender.Net
* @ deZender (PHP7 Decoder for ionCube Encoder)
*
* @ Version			:	4.1.0.1
* @ Author			:	DeZender
* @ Release on		:	29.08.2020
* @ Official site	:	http://DeZender.Net
*
*/

function Submit($sub_type, $db, $table_name)
{
	if ($sub_type == 'sub_new') {
		$target_dir = 'vpn/';
		$target_file = basename($_FILES['fileToUpload']['name']);
		$gtg = 1;
		$ft = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$file_path = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] !== 'off') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/vpn/';

		if (file_exists($target_dir . $target_file)) {
			unlink($target_dir . $target_file);
		}

		if ($_POST['type'] == 'file') {
			if (500000 < $_FILES['fileToUpload']['size']) {
				echo '<div class="alert alert-danger" id="success-alert1"><h4><i class="icon fa fa-times"></i>Sorry, your file is too large.</h4></div>';
				$gtg = 0;
			}

			if ($ft != 'ovpn') {
				echo '<div class="alert alert-danger" id="success-alert"><h4><i class="icon fa fa-times"></i>Sorry, only OVPN files are allowed.</h4></div>';
				$gtg = 0;
			}

			if ($gtg != 0) {
				if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_dir . $target_file)) {
					$config = '' . $file_path . htmlspecialchars(basename($_FILES['fileToUpload']['name'])) . '';
					$file_name = htmlspecialchars(basename($_FILES['fileToUpload']['name']));
				}

				$db->exec('INSERT INTO ' . $table_name . '(vpn_country, vpn_config, vpn_file_name) VALUES(\'' . sanitize($_POST['vpn_country']) . ('\', \'' . $config . '\', \'' . $file_name . '\')'));
				$db->close();
				header('Location: ' . $base_file . '?status=1');
			}
		}

		if ($_POST['type'] == 'url') {
			$path = pathinfo($_POST['ovpn_url']);
			$config = '' . $file_path . $path['basename'] . '';
			$ovpn_in = file_get_contents($_POST['ovpn_url']);
			file_put_contents($target_dir . '/' . $path['basename'], $ovpn_in);
			$file_name = $path['basename'];
			$db->exec('INSERT INTO ' . $table_name . '(vpn_country, vpn_config, vpn_file_name) VALUES(\'' . sanitize($_POST['vpn_country']) . ('\', \'' . $config . '\', \'' . $file_name . '\')'));
			$db->close();
			header('Location: ' . $base_file . '?status=1');
		}
	}
	else if ($sub_type == 'sub_del') {
		$arr = $db->query('SELECT * FROM ' . $table_name . ' WHERE id=' . sanitize($_GET['delete']));
		$del = $arr->fetchArray();
		$ftd = $del['vpn_file_name'];
		$ftd = 'vpn/' . $ftd;
		unlink($ftd);
		$db->exec('DELETE FROM ' . $table_name . ' WHERE id=' . sanitize($_GET['delete']));
	}

	$db->close();
}

include 'includes/header.php';
$table_name = 'vpn';
$db->exec('CREATE TABLE IF NOT EXISTS ' . $table_name . '(id INTEGER PRIMARY KEY' . "\t" . 'AUTOINCREMENT  NOT NULL, vpn_country TEXT ,vpn_config TEXT,vpn_file_name TEXT)');
$res = $db->query('SELECT * FROM ' . $table_name);

if (!file_exists('vpn')) {
	mkdir('vpn', 511, true);
}

if (isset($_POST['submit'])) {
	Submit('sub_new', $db, $table_name);
}

if (isset($_GET['delete'])) {
	Submit('sub_del', $db, $table_name);
	header('Location: ' . $base_file . '?status=3');
}

echo '<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' . "\r\n\t" . '<div class="modal-dialog">' . "\r\n\t\t" . '<div class="modal-content" style="background-color: black;">' . "\r\n\t\t\t" . '<div class="modal-header">' . "\r\n\t\t\t\t" . '<h2 style="color: white;">Confirm</h2>' . "\r\n\t\t\t" . '</div>' . "\r\n\t\t\t" . '<div class="modal-body" style="color: white;">' . "\r\n\t\t\t\t" . 'Do you really want to delete?' . "\r\n\t\t\t" . '</div>' . "\r\n\t\t\t" . '<div class="modal-footer">' . "\r\n\t\t\t\t" . '<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>' . "\r\n\t\t\t\t" . '<a style="color: white;" class="btn btn-danger btn-ok">Delete</a>' . "\r\n\t\t\t" . '</div>' . "\r\n\t\t" . '</div>' . "\r\n\t" . '</div>' . "\r\n" . '</div>' . "\r\n";

if (isset($_GET['create'])) {
	echo "\r\n\r\n" . '        <div class="col-md-6 mx-auto">' . "\r\n" . '            <div class="card-body">' . "\r\n" . '                <div class="card ctcard">' . "\r\n" . '                    <div class="card-header card-header-warning">' . "\r\n" . '                        <center>' . "\r\n" . '                            <h2><i class="fa fa-bullhorn"></i> OVPN</h2>' . "\r\n" . '                        </center>' . "\r\n" . '                    </div>' . "\r\n" . '                    ' . "\r\n" . '                    <div class="card-body">' . "\r\n" . '                        <div class="col-12">' . "\r\n" . '                            <h3>Upload OVPN</h3>' . "\r\n" . '                        </div>' . "\r\n" . '                            <form action="" method="post" enctype="multipart/form-data">' . "\r\n\t\t\t\t" . '                <div class="form-group ctinput">' . "\r\n\t\t\t\t" . '                ' . "\t" . '<div class="form-group form-float form-group-lg">' . "\r\n" . '                                        <div class="form-line">' . "\r\n" . '                                            <label class="form-label"><strong>Location</strong></label>' . "\r\n\t\t\t\t" . '                ' . "\t\t\t" . '<input type="text" class="form-control" name="vpn_country" placeholder="Country / State">' . "\r\n\t\t\t\t" . '                ' . "\t\t" . '</div>' . "\r\n\t\t\t\t" . '                ' . "\t" . '</div>' . "\r\n\t\t\t\t" . '                </div>' . "\r\n\r\n" . '                               <br>' . "\r\n" . '                               <div class="ctinput">' . "\r\n" . '                                   <label for="selector">Select OVPN Source</label>' . "\r\n" . '                                   <select class="form-control"  style="width:auto;" name = "type" onchange="yesnoCheck(this);">' . "\r\n" . '                                       <option value="url">URL</option>' . "\r\n" . '                                       <option value="file">FILE</option>' . "\r\n" . '                                   </select>' . "\r\n" . '                               </div>' . "\r\n" . '                               <br>' . "\r\n" . '                               ' . "\r\n" . '                               ' . "\r\n" . '                               <div id="loc" class="form-group form-float form-group-lg ctinput">' . "\r\n" . '                                   <div class="form-line">' . "\r\n" . '                                       <label class="form-label"><strong>OVPN URL</strong></label>' . "\r\n" . '                               ' . "\t\t" . '<input type="text" class="form-control" name="ovpn_url" placeholder="http://host.com/folder/poland.ovpn">' . "\r\n" . '                               ' . "\t" . '</div>' . "\r\n" . '                               </div>' . "\r\n" . '                               ' . "\r\n" . '                               <div id="ftu" class="form-group ctinput"  style="display: none;">' . "\r\n" . '                                   <label class="control-label " for="vpn_config">' . "\r\n" . '                                       <strong>OVPN File</strong>' . "\r\n" . '                                   </label>' . "\r\n" . '                                   <div class="input-group">' . "\r\n" . '                                       <input type="file" name="fileToUpload" id="fileToUpload" >' . "\r\n" . '                                   </div>' . "\r\n" . '                               </div>' . "\r\n\r\n" . '                                <div class="form-group">' . "\r\n" . '                                    <center>' . "\r\n" . '                                        <button class="btn btn-info ctbtn ctuserbtn" name="submit" type="submit">' . "\r\n" . '                                            <i class="icon icon-check"></i> Submit' . "\r\n" . '                                        </button>' . "\r\n" . '                                    </center>' . "\r\n" . '                                </div>' . "\r\n" . '                            </form>' . "\r\n" . '                    </div>' . "\r\n" . '                </div>' . "\r\n" . '            </div>' . "\r\n" . '        </div>' . "\r\n";
}
else {
	echo "\r\n" . '        <div class="col-md-12 mx-auto">' . "\r\n" . '            <div class="card-body">' . "\r\n" . '                <div class="card ctcard">' . "\r\n" . '                    <div class="card-header card-header-warning">' . "\r\n" . '                        <center>' . "\r\n" . '                            <h2><i class="fa fa-shield"></i> OVPN\'s</h2>' . "\r\n" . '                        </center>' . "\r\n" . '                    </div>' . "\r\n\r\n" . '                    <div class="card-body p-0">' . "\r\n" . '                        <div class="col-12 ctaddnew">' . "\r\n" . '                        ' . "\t" . '<center>' . "\r\n\t" . '        ' . "\t\t\t\t\t" . '<a id="button" href="./';
	echo $base_file;
	echo '?create" class="btn btn-info">New OVPN</a>' . "\r\n\t" . '        ' . "\t\t\t\t" . '</center>' . "\r\n" . '    ' . "\t\t\t\t\t" . '</div>' .  "\r\n\t\t\t\t\t\t" . '<div class="table-responsive">' . "\r\n\t\t\t\t\t\t\t" . '<table class="table table-striped table-sm">' . "\r\n\t\t\t\t\t\t\t" . '<thead style="color:white!important">' . "\r\n\t\t\t\t\t\t\t\t" . '<tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<th>Index</th>' . "\r\n\t\t\t\t\t\t\t\t" . '<th>Location</th>' . "\r\n\t\t\t\t\t\t\t\t" . '<th>File Name</th>' . "\r\n\t\t\t\t\t\t\t\t" . '<th>Delete</th>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t" . '</thead>' . "\r\n\t\t\t\t\t\t\t";
	echo "\t\t\t\t\t\t\t" . '<tbody>';
	while ($row = $res->fetchArray()) {
		echo "\r\n\t\t\t\t\t\t\t\t" . '<tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<td>';
		echo $row['id'];
		echo '</td>' . "\r\n\t\t\t\t\t\t\t\t" . '<td>';
		echo $row['vpn_country'];
		echo '</a></td>' . "\r\n\t\t\t\t\t\t\t\t" . '<td>';
		echo $row['vpn_file_name'];
		echo '</td>' . "\r\n\t\t\t\t\t\t\t\t" . '<td>' . "\r\n\t\t\t\t\t\t\t\t" . '<a class="btn btn-danger btn-ok" href="#" data-href="./';
		echo $base_file;
		echo '?delete=';
		echo $row['id'];
		echo '" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>' . "\r\n\t\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t";
	}
	echo "\r\n\t\t\t\t\t\t\t" . '</tbody>' . "\r\n\t\t\t\t\t\t\t";
	echo "\t\t\t\t\t\t\t" . '</table>' . "\r\n\t\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t" . '</div>' . "\r\n\t\t\t" . '</div>' . "\r\n\t\t" . '</div>' . "\r\n";
}

echo "\r\n";
include 'includes/footer.php';
echo '<script>' . "\r\n\r\n" . 'function yesnoCheck(that){' . "\r\n" . '    if (that.value == "url"){' . "\r\n" . '        document.getElementById("loc").style.display = "block";' . "\r\n" . '    }else{' . "\r\n" . '        document.getElementById("loc").style.display = "none";' . "\r\n" . '    }' . "\r\n" . '    if (that.value == "file"){' . "\r\n" . '        document.getElementById("ftu").style.display = "block";' . "\r\n" . '    }else{' . "\r\n" . '        document.getElementById("ftu").style.display = "none";' . "\r\n" . '    }' . "\r\n" . '}' . "\r\n" . '</script>' . "\r\n" . '</body>' . "\r\n" . '</html>';

?>