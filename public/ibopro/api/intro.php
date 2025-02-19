<?php
error_reporting(0);
$db = new SQLite3('intro.db');
$canal = $db->querySingle('SELECT url FROM intro WHERE id=1');

if ($canal != '') {
	header('Location: ' . $canal);
	exit();
}
else {
	header('Location: https://google.com');
	exit();
}

?>