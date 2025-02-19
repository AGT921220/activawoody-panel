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
$note = $db->query('SELECT * FROM note');

while ($notes = $note->fetchArray(SQLITE3_ASSOC)) {
	$data[] = ['Title' => $notes['Title'], 'Description' => $notes['Description'], 'CreateDate' => $notes['CreateDate']];
}

$jdata = json_encode($data);
echo '{"status":true,' . "\r\n\t\t" . '"response":' . "\r\n\t\t" . $jdata . "\r\n\t\t" . '}';

?>