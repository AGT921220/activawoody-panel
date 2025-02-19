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
$res = $db->query('SELECT * FROM update_apk');
$row = $res->fetchArray(SQLITE3_ASSOC);

if ($_GET['id'] == $row['package']) {
	header('Location: ' . $row['url']);
	exit();
}
else {
	echo "\r\n" . '<!DOCTYPE html>' . "\r\n" . '<html>' . "\r\n" . '<head>' . "\r\n" . '<style>' . "\r\n" . '/* Why are you here unless you want to copy this...... POSER*/' . "\r\n" . '.table {' . "\r\n" . '  display: table;         ' . "\r\n" . '  width: auto;         ' . "\r\n" . '  background-color: #eee;         ' . "\r\n" . '  border: 1px solid #666666;         ' . "\r\n" . '  border-spacing: 5px;' . "\r\n" . '}' . "\r\n" . '.hAyfc {' . "\r\n" . '  display: table-row;' . "\r\n" . '  width: auto;' . "\r\n" . '  clear: both;' . "\r\n" . '}' . "\r\n" . '.BgcNfc {' . "\r\n" . '  float: left;' . "\r\n" . '  display: table-column;         ' . "\r\n" . '  width: 200px;         ' . "\r\n" . '  background-color: #ccc;  ' . "\r\n" . '}' . "\r\n" . '</style>' . "\r\n" . '</head>' . "\r\n" . '<body>' . "\r\n" . '<div class="table">' . "\r\n" . '<div class="hAyfc"><div class="BgcNfc">App Name</div><span class="htlgb"><div class="IQ1z0d"><span class="htlgb">' . $row['app_name'] . '</span></div></span></div>' . "\r\n" . '<div class="hAyfc"><div class="BgcNfc">Updated</div><span class="htlgb"><div class="IQ1z0d"><span class="htlgb">' . $row['u_date'] . '</span></div></span></div>' . "\r\n" . '<div class="hAyfc"><div class="BgcNfc">Package Name</div><span class="htlgb"><div class="IQ1z0d"><span class="htlgb">' . $row['package'] . '</span></div></span></div>' . "\r\n" . '<div class="hAyfc"><div class="BgcNfc">Current Version</div><span class="htlgb"><div class="IQ1z0d"><span class="htlgb">' . $row['version'] . '</span></div></span>' . "\r\n" . '<div class="hAyfc"><div class="BgcNfc">Created By</div><span class="htlgb"><div class="IQ1z0d"><span class="htlgb"><a href="https://t.me/ftsoltech">FTSOL Panels</a></span></div></span>' . "\r\n" . '</div>' . "\r\n" . '</body>' . "\r\n" . '</html>' . "\r\n";
}

?>