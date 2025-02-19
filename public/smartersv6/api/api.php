<?php

error_reporting(0);
$db = new SQLite3('./data/.bet3ads.db');

if (isset($_GET['type'])) {
	$action = $_GET['type'];
}
if ($action == 'vod') {
	$ad = $db->query('SELECT * FROM movie_ads');
	while ($ads = $ad->fetchArray(SQLITE3_ASSOC)) {
	$path[] = $ads{'images'};
	}
$bet3 = json_encode($path);
echo '{"result":"success","totalrecords":1, "images":' . $bet3 .' }';
}


if ($action == 'series') {
	$ad = $db->query('SELECT * FROM series_ads');
	while ($ads = $ad->fetchArray(SQLITE3_ASSOC)) {
	$path[] = $ads{'images'};
	}
	
$bet3 = json_encode($path);
echo '{"result":"success","totalrecords":1, "images":' . $bet3 .' }';
}

?>