<?php
$db = new SQLite3('sportsdb.db');

if (isset($_GET['getSport'])) {
	$query = 'SELECT DISTINCT strSport FROM leagues';

	$result = $db->query($query);

	$sports = [];

	while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
		$sports[] = $row['strSport'];
	}
	header('Content-Type: application/json');
	echo json_encode($sports);
} else if (isset($_GET['selectedSport'])) {
	$selectedSport = SQLite3::escapeString($_GET['selectedSport']);
	$query = "SELECT idLeague, strLeague FROM leagues WHERE strSport = '$selectedSport'";

	$result = $db->query($query);

	$leagues = [];

	while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
		$leagues[] = $row;
	}
	header('Content-Type: application/json');
	echo json_encode($leagues);
} else {
	header('HTTP/1.1 400 Bad Request');
	echo json_encode(['error' => 'Invalid parameter provided']);
}
$db->close();