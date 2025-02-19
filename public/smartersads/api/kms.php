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

function THE_KING()
{
	include 'dns_.php';
	include 'dns__.php';
	include 'dns___.php';
	include 'dns____.php';
	include 'dns_____.php';
}

function aes()
{
	return sdfgdfgdf();
}

function keys()
{
	return ryoyoyoutot();
}

function dns()
{
	return tehntenhen();
}

ini_set('display_errors', 0);
require_once '../includes/functions.php';
the_king();
$aes = aes();
$key = keys();
$db = new SQLite3('./.db.db');
$res = $db->query('SELECT * FROM dns');
$rows = [];

while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
	$rows[] = $row['url'];
}

$dns = rtrim(implode(',', $rows), ',');
if (isset($_POST['m']) && isset($_POST['k']) && isset($_POST['sc']) && isset($_POST['u']) && isset($_POST['pw']) && isset($_POST['r']) && isset($_POST['av']) && isset($_POST['dt']) && isset($_POST['d']) && isset($_POST['do'])) {
	echo dns();
}
else {
	echo '{"ftg":true,"status":true,"su":"' . $dns . '","sc":"","ndd":""}';
}

?>