<?php
/**
*
* @ This file is created by http://DeZender.Net
* @ deZender (PHP7 Decoder for SourceGuardian Encoder)
*
* @ Version			:	4.1.0.1
* @ Author			:	DeZender
* @ Release on		:	29.08.2020
* @ Official site	:	http://DeZender.Net
*
*/

function getaction($urlnew)
{
	global $httpcode;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_URL, $urlnew);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_2; en-US) AppleWebKit/532.8 (KHTML, like Gecko) Chrome/4.0.302.2 Safari/532.8');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_AUTOREFERER, true);
	$html = curl_exec($ch);
	curl_close($ch);
	return $html;
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$db = new SQLite3('./.egg.db');
$db->exec('CREATE TABLE IF NOT EXISTS sport(id INTEGER PRIMARY KEY NOT NULL, title VARCHAR(25), url VARCHAR(200), c1 VARCHAR(25), c2 VARCHAR(25), c3 VARCHAR(25))');
$rows = $db->query('SELECT COUNT(*) as count FROM sport');
$row1 = $rows->fetchArray();
$numRows = $row1['count'];

if ($numRows == 0) {
	$db->exec('INSERT INTO sport(id, title, url, c1, c2, c3) VALUES(\'1\', \'Default\', \'https://www.tvsportguide.com/widget/5cc316f797659/?heading=Events&border_color=custom&autoscroll=1&custom_colors=\',\'#1d23dd\',\'#ffffff\',\'#000000\')');
}

$res = $db->query('SELECT * FROM sport WHERE id=\'1\'');
$rownew = $res->fetchArray();
$url = $rownew['url'];
$c1 = $rownew['c1'];
$c2 = $rownew['c2'];
$c3 = $rownew['c3'];
$bad_status_codes = ['404', '401', '502', 404, 401, 502];

if (isset($url)) {
	$urlnew = str_replace('#', '', $url . $c1 . ',' . $c2 . ',' . $c3);
	$resnew = getaction($urlnew);
	echo $resnew;
	exit();
}

?>