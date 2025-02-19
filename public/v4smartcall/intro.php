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
		$target_dir = 'intro/';
		$target_file = basename($_FILES['fileToUpload']['name']);
		$gtg = 1;
		$ft = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$file_path = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] !== 'off') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/intro/';

		if ($_POST['type'] == 'file') {
			if (1000000 < $_FILES['fileToUpload']['size']) {
				echo '<div class="alert alert-danger" id="success-alert1"><h4><i class="icon fa fa-times"></i>Sorry, your file is too large, max is 10mb.</h4></div>';
				$gtg = 0;
			}

			if ($ft != 'mp4') {
				echo '<div class="alert alert-danger" id="success-alert"><h4><i class="icon fa fa-times"></i>Sorry, only MP4 files are allowed.</h4></div>';
				$gtg = 0;
			}

			if ($gtg != 0) {
				$intro_f = $file_path . 'intro.mp4';

				if (file_exists($intro_f)) {
					unlink($intro_f);
				}

				move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_dir . 'intro.mp4');
				$db->exec('UPDATE ' . $table_name . ' SET' . "\t" . 'url=\'' . $intro_f . '\' WHERE id=\'1\' ');
				header('Location: ' . $base_file . '?status=2');
			}
		}

		if ($_POST['type'] == 'url') {
			$db->exec('UPDATE ' . $table_name . ' SET' . "\t" . 'url=\'' . $_POST['intro_url'] . '\' WHERE id=\'1\' ');
			header('Location: ' . $base_file . '?status=2');
		}
	}

	$db->close();
}

error_reporting(0);
include 'includes/header.php';
$table_name = 'intro';
$db->exec('CREATE TABLE IF NOT EXISTS ' . $table_name . '(id INTEGER PRIMARY KEY,url TEXT)');
$rows = $db->query('SELECT COUNT(*) as count FROM ' . $table_name);
$row = $rows->fetchArray();
$numRows = $row['count'];

if ($numRows == 0) {
	$db->exec('INSERT INTO ' . $table_name . '(url) VALUES(\'\')');
}

$intro = $db->querySingle('SELECT url FROM intro WHERE id=1');

if (isset($_POST['submit'])) {
	submit('sub_new', $db, $table_name);
}

if (!file_exists('intro')) {
	mkdir('intro', 511, true);
}

echo "\r\n" . '        <div class="col-md-6 mx-auto">' . "\r\n" . '            <div class="card-body">' . "\r\n" . '                <div class="card ctcard">' . "\r\n" . '                    <div class="card-header card-header-warning">' . "\r\n" . '                        <center>' . "\r\n" . '                            <h2><i class="fa fa-bullhorn"></i> Intro</h2>' . "\r\n" . '                        </center>' . "\r\n" . '                    </div>' . "\r\n" . '                    ' . "\r\n" . '                    <div class="card-body">' . "\r\n" . '                        <div class="col-12 p-0">' . "\r\n" . '                            <h3>Upload Intro</h3>' . "\r\n\t\t\t\t\t\t\t" . '<h6>For no intro leave URL blank and submit</h6>' . "\r\n" . '                        </div>' . "\r\n" . '                            <form action="" method="post" enctype="multipart/form-data">' . "\r\n" . '                               <br>' . "\r\n" . '                               <div class="ctinput">' . "\r\n" . '                                   <label for="selector">Select Intro Source</label>' . "\r\n" . '                                   <select class="form-control"  style="width:auto;" name = "type" onchange="yesnoCheck(this);">' . "\r\n" . '                                       <option value="url">URL</option>' . "\r\n" . '                                       <option value="file">FILE</option>' . "\r\n" . '                                   </select>' . "\r\n" . '                               </div>' . "\r\n" . '                               <br>' . "\r\n" . '                               ' . "\r\n" . '                               ' . "\r\n" . '                               <div id="loc" class="form-group form-float form-group-lg ctinput">' . "\r\n" . '                                   <div class="form-line">' . "\r\n" . '                                       <label class="form-label"><strong>Intro URL</strong></label>' . "\r\n" . '                               ' . "\t\t" . '<input type="text" class="form-control" name="intro_url" placeholder="http://host.com/folder/video.mp4">' . "\r\n" . '                               ' . "\t" . '</div>' . "\r\n" . '                               </div>' . "\r\n" . '                               ' . "\r\n" . '                               <div id="ftu" class="form-group ctinput ctfile"  style="display: none;">' . "\r\n" . '                                   <label class="control-label ">' . "\r\n" . '                                       <strong>Intro File</strong>' . "\r\n" . '                                   </label>' . "\r\n" . '                                   <div class="input-group ">' . "\r\n" . '                                       <input type="file" name="fileToUpload" id="fileToUpload" >' . "\r\n" . '                                   </div>' . "\r\n" . '                               </div>' . "\r\n\r\n" . '                                <div class="form-group">' . "\r\n" . '                                    <center>' . "\r\n" . '                                        <button class="btn btn-info ctbtn ctuserbtn" name="submit" type="submit">' . "\r\n" . '                                            <i class="fa fa-check"></i> Submit' . "\r\n" . '                                        </button>' . "\r\n" . '                                    </center>' . "\r\n" . '                                </div>' . "\r\n" . '                            </form>' . "\r\n" . '                  <div class="align-items-center">' . "\r\n" . '                        <center>' . "\r\n" . '                      <h3>Current Intro</h3>' . "\r\n" . '                      <div><video width="100%" autoplay="true" muted preload="auto" controls>  <source src="';
echo $intro . '?t=' . time();
echo '" type="video/mp4"></video></div>' . "\r\n" . '                  </div>' . "\r\n" . '                    </div>' . "\r\n" . '                </div>' . "\r\n" . '            </div>' . "\r\n" . '        </div>' . "\r\n\r\n";
include 'includes/footer.php';
echo '<script>' . "\r\n\r\n" . 'function yesnoCheck(that){' . "\r\n" . '    if (that.value == "url"){' . "\r\n" . '        document.getElementById("loc").style.display = "block";' . "\r\n" . '    }else{' . "\r\n" . '        document.getElementById("loc").style.display = "none";' . "\r\n" . '    }' . "\r\n" . '    if (that.value == "file"){' . "\r\n" . '        document.getElementById("ftu").style.display = "block";' . "\r\n" . '    }else{' . "\r\n" . '        document.getElementById("ftu").style.display = "none";' . "\r\n" . '    }' . "\r\n" . '}' . "\r\n" . '</script>';

?>