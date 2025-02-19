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

function Submit($db, $table_name)
{
	$db->exec('UPDATE users SET' . "\t" . 'username=\'' . $_POST['username'] . '\', password=\'' . $_POST['password'] . '\' WHERE id=\'1\' ');
	session_start();
	session_regenerate_id();
	$_SESSION['loggedin'] = true;
	$_SESSION['name'] = $_POST['username'];
}

include 'includes/header.php';
$res = $db->query('SELECT * FROM users WHERE id=\'1\'');
$row = $res->fetchArray();

if (isset($_POST['submit'])) {
	submit($db, $table_name);
	header('Location: ' . $base_file . '?status=2');
}

echo "\r\n" . '    ' . "\t" . '<div class="col-md-6 mx-auto">' . "\r\n\t\t\t" . '<div class="card-body">' . "\r\n\t\t\t\t" . '<div class="card bg-primary text-white">' . "\r\n\t\t\t\t\t" . '<div class="card-header card-header-warning">' . "\r\n" . '                        <center>' . "\r\n" . '                            <h2><i class="icon icon-user"></i> Update Credentials</h2>' . "\r\n" . '                        </center>' . "\r\n" . '                    </div>' . "\r\n\t\t\t\t\t" . '<div class="alert alert-info alert-dismissible" role="alert">' . "\r\n\t\t\t\t\t\t" . '<center>' . "\r\n\t\t\t\t\t\t\t" . '<h3 style="color:black!important">Do <strong style="color:black!important">not</strong> use <em>admin</em> for username or password!</h3>' . "\r\n\t\t\t\t\t\t" . '</center>' . "\r\n\t\t\t\t\t" . '</div>' . "\r\n\r\n\t\t\t\t\t" . '<div class="card-body">' . "\r\n\t\t\t\t\t\t" . '<form  method="post">' . "\r\n\r\n\t\t\t\t\t\t\t" . '<div class="form-group">' . "\r\n\t\t\t\t\t\t\t\t" . '<div class="form-group form-float form-group-lg">' . "\r\n" . '                                    <div class="form-line">' . "\r\n" . '                                        <label class="form-label">Username</label>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<input type="text" class="form-control" name="username" value="';
echo $row['username'];
echo '">' . "\r\n\t\t\t\t\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t\t\t" . '</div>' . "\r\n\r\n\t\t\t\t\t\t\t" . '<div class="form-group">' . "\r\n\t\t\t\t\t\t\t\t" . '<div class="form-group form-float form-group-lg">' . "\r\n" . '                                    <div class="form-line">' . "\r\n" . '                                        <label class="form-label">Password</label>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<input type="text" class="form-control" name="password" value="';
echo $row['password'];
echo '">' . "\r\n\t\t\t\t\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t\t\t" . '</div>' . "\r\n\r\n\t\t\t\t\t\t\t" . '<hr>' . "\r\n\r\n\t\t\t\t\t\t\t" . '<center>' . "\r\n\t\t\t\t\t\t\t\t" . '<button type="submit" name="submit" class="btn btn-info">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<i class="icon icon-check"></i>Update Credentials' . "\r\n\t\t\t\t\t\t\t\t" . '</button>' . "\r\n\t\t\t\t\t\t\t" . '</center>' . "\r\n\t\t\t\t\t\t" . '</form>' . "\r\n\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t" . '</div>' . "\r\n\t\t\t" . '</div>' . "\r\n\t\t" . '</div>' . "\r\n\r\n\r\n";
include 'includes/footer.php';
echo "\r\n" . '</body>' . "\r\n" . '</html>';

?>