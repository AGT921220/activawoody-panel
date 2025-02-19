<?php
$db = new SQLite3('./api/database.db');
function initializeDatabase($db) {
	$tables = [
    "users" => "CREATE TABLE IF NOT EXISTS users(id INTEGER PRIMARY KEY,username TEXT ,password TEXT)",
    "dns" => "CREATE TABLE IF NOT EXISTS dns(id INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL, title TEXT, url TEXT)",
    "maintenance" => "CREATE TABLE IF NOT EXISTS maintenance (id INTEGER PRIMARY KEY, title TEXT, body TEXT, mode TEXT)",
    "devices" => "CREATE TABLE IF NOT EXISTS devices (id INTEGER PRIMARY KEY, deviceid TEXT, deviceusername TEXT, added_on TEXT)",
    "reports" => "CREATE TABLE IF NOT EXISTS reports (id INTEGER PRIMARY KEY, username TEXT, macaddress TEXT, section TEXT, section_category TEXT, report_title TEXT, report_sub_title TEXT, report_cases TEXT, report_custom_message TEXT, stream_name TEXT, stream_id INTEGER)",
    "feedback" => "CREATE TABLE IF NOT EXISTS feedback (id INTEGER PRIMARY KEY, username TEXT, macaddress TEXT, feedback_content TEXT)",
    "announcements" => "CREATE TABLE IF NOT EXISTS announcements (id INTEGER PRIMARY KEY AUTOINCREMENT, title TEXT NOT NULL, message TEXT NOT NULL, created_on TEXT NOT NULL)",
    "announcement_views" => "CREATE TABLE IF NOT EXISTS announcement_views (announcement_id INTEGER NOT NULL, deviceid TEXT NOT NULL, FOREIGN KEY (announcement_id) REFERENCES announcements(id))",
    "vpn" => "CREATE TABLE IF NOT EXISTS vpn(id INTEGER PRIMARY KEY AUTOINCREMENT  NOT NULL, vpn_country TEXT ,vpn_file_name TEXT, username TEXT, password TEXT, embed TEXT)",
    "advertisement" => "CREATE TABLE IF NOT EXISTS advertisement (id INTEGER PRIMARY KEY, title TEXT, text TEXT)",
    "ads" => "CREATE TABLE IF NOT EXISTS ads (id INTEGER PRIMARY KEY, title TEXT, text TEXT)",
    "ads2" => "CREATE TABLE IF NOT EXISTS ads2 (id INTEGER PRIMARY KEY, text TEXT)",
    "ads2_images" => "CREATE TABLE IF NOT EXISTS ads2_images (id INTEGER PRIMARY KEY AUTOINCREMENT, ads2_id INTEGER, url TEXT, FOREIGN KEY (ads2_id) REFERENCES ads2(id))",
    "settings" => "CREATE TABLE IF NOT EXISTS settings (id INTEGER PRIMARY KEY AUTOINCREMENT, tmdb_api_enabled INTEGER)"

];

	$insert = [
		"advertisement" => "INSERT OR REPLACE INTO advertisement (title, text) VALUES('','')",
		"maintenance" => "INSERT OR REPLACE INTO maintenance (title, body, mode) VALUES('','','no')"
		];

	foreach ($tables as $tableName => $createStmt) {
		$db->exec($createStmt);
	}
	
	foreach ($insert as $tableName => $createStmt) {
		$rows = $db->query("SELECT COUNT(*) as count FROM ".$tableName);
		$row = $rows->fetchArray();
		$numRows = $row['count'];
		if ($numRows == 0){
			$db->exec($createStmt);
		}
	}
}

function sanitize($data) {
	$data = trim($data);
	$data = htmlspecialchars($data, ENT_QUOTES );
	$data = SQLite3::escapeString($data);
	return $data;
}