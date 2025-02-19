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
		$u_date = date('Y-m-d');
		$db->exec('UPDATE ' . $table_name . ' SET' . "\t" . 'app_name=\'' . sanitize($_POST['app_name']) . '\', version=\'' . sanitize($_POST['version']) . '\', apk=\'' . sanitize($_POST['apk']) . '\', package=\'' . sanitize($_POST['package']) . ('\', u_date=\'' . $u_date . '\'WHERE id=\'1\' '));
	}

	$db->close();
}

include 'includes/header.php';
$table_name = 'update_apk';
$db->exec('CREATE TABLE IF NOT EXISTS ' . $table_name . '(id INTEGER PRIMARY KEY,app_name TEXT,version TEXT ,apk TEXT,package TEXT,u_date TEXT)');
$rows = $db->query('SELECT COUNT(*) as count FROM ' . $table_name);
$row = $rows->fetchArray();
$numRows = $row['count'];

if ($numRows == 0) {
	$db->exec('INSERT INTO ' . $table_name . '(app_name,version,apk,package,u_date) VALUES(\'\',\'\',\'\',\'\',\'\')');
}

$res = $db->query('SELECT * FROM ' . $table_name . ' WHERE id=\'1\'');
$rowU = $res->fetchArray();

if (isset($_POST['submit'])) {
	submit('sub_new', $db, $table_name);
	header('Location: ' . $base_file . '?status=2');
}

echo "\r\n" . '        <div class="col-md-6 mx-auto">' . "\r\n" . '            <div class="card-body">' . "\r\n" . '                <div class="card ctcard">' . "\r\n" . '                    <div class="card-header card-header-warning">' . "\r\n" . '                        <center>' . "\r\n" . '                            <h2><i class="fa fa-bullhorn"></i> Update</h2>' . "\r\n" . '                        </center>' . "\r\n" . '                    </div>' . "\r\n" . '                    ' . "\r\n" . '                    <div class="card-body">' . "\r\n" . '                        <div class="col-12 p-0">' . "\r\n" . '                            <h3>Push Update</h3>' . "\r\n" . '                        </div>' . "\r\n" . '                            <form method="post">' . "\r\n" . '                                <div class="form-group ctinput">' . "\r\n" . '                                    <label class="form-label " for="version">App Name</label>' . "\r\n" . '                                        <input class="form-control" placeholder="My App" name="app_name" value="';
echo $rowU['app_name'];
echo '" type="text"/>' . "\r\n" . '                                </div>' . "\r\n" . '                                <div class="form-group ctinput">' . "\r\n" . '                                    <label class="form-label " for="version">Version Number</label>' . "\r\n" . '                                        <input class="form-control" placeholder="3.0" name="version" value="';
echo $rowU['version'];
echo '" type="text"/>' . "\r\n" . '                                </div>' . "\r\n" . '                                <div class="form-group ctinput">' . "\r\n" . '                                    <label class="form-label " for="package">Package name</label>' . "\r\n" . '                                        <input class="form-control" placeholder="com.package.name" name="package" value="';
echo $rowU['package'];
echo '" type="text"/>' . "\r\n" . '                                </div>' . "\r\n" . '                                <div class="form-group ctinput">' . "\r\n" . '                                    <label class="form-label " for="apk">APK URL</label>' . "\r\n" . '                                        <input class="form-control" placeholder="http://apkurl.com/yourapp.apk" name="apk" value="';
echo $rowU['apk'];
echo '" type="text"/>' . "\r\n" . '                                </div>' . "\r\n" . '                                <div class="form-group">' . "\r\n" . '                                    <center>' . "\r\n" . '                                        <button class="btn btn-info ctbtn ctuserbtn" name="submit" type="submit">' . "\r\n" . '                                            <i class="fa fa-check"></i> Submit' . "\r\n" . '                                        </button>' . "\r\n" . '                                    </center>' . "\r\n" . '                                </div>' . "\r\n" . '                            </form>' . "\r\n" . '                    </div>' . "\r\n" . '                </div>' . "\r\n" . '            </div>' . "\r\n" . '        </div>' . "\r\n\r\n";
include 'includes/footer.php';

?>