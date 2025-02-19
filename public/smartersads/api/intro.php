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

error_reporting(0);
$db = new SQLite3('./.db.db');
$intro = $db->querySingle('SELECT url FROM intro WHERE id=1');

if ($intro != '') {
	header('Location: ' . $intro);
	exit();
}
else {
	header('Location: ../img/blank.mp4');
	exit();
}

?>