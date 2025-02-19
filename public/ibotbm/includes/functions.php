<?php
$dbPath = './api/.db.db';

$db = new SQLiteWrapper($dbPath);

function createTables($tables, $dbLoc) {
	try {
		$db = new SQLite3($dbLoc);
	} catch (Exception $e) {
		$db = new SQLite3('.db.db');
	}

	if (!$db) {
		die("Error connecting to the database");
	}

	foreach ($tables as $tableName => $columns) {
		$sql = "CREATE TABLE IF NOT EXISTS $tableName (";
		foreach ($columns as $columnName => $columnType) {
			$sql .= "$columnName $columnType, ";
		}
		$sql = rtrim($sql, ', ');
		$sql .= ");";
		if ($db->exec($sql)) {
		} else {
			echo "Error creating table: " . $db->lastErrorMsg();
		}
	}
	$db->close();
}


$tables = [
	"users" => [
		"id" => "INTEGER PRIMARY KEY",
		"username" => "TEXT NOT NULL",
		"password" => "TEXT NOT NULL",
	],
	"dns" => [
		"id" => "INTEGER PRIMARY KEY",
		"title" => "TEXT NOT NULL",
		"url" => "REAL NOT NULL",
	],
	"playlist" => [
		"id" => "INTEGER PRIMARY KEY",
		"dns_id" => "INTEGER",
		"mac_address" => "TEXT NOT NULL",
		"username" => "TEXT NOT NULL",
		"password" => "TEXT NOT NULL",
	],
	"settings" => [
		"id" => "INTEGER PRIMARY KEY",
		"note_title" => "TEXT NOT NULL",
		"note_content" => "TEXT NOT NULL",
		"pin" => "TEXT NOT NULL",
	],
];

createTables($tables, $dbPath);

function sanitize($data) {
	$data = trim($data);
	$data = htmlspecialchars($data, ENT_QUOTES );
	$data = SQLite3::escapeString($data);
	return $data;
}

const ALLOWED_CHARACTERS = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

function getDecodedString($str) {
	$encryptKeyPosition = strpos(ALLOWED_CHARACTERS,substr($str, -2, 1));
	$encryptKeyPosition2 = strpos(ALLOWED_CHARACTERS,substr($str, -1));
	$substring = substr($str, 0, -2);
	return trim(utf8_decode(base64_decode(substr($substring, 0, $encryptKeyPosition) . substr($substring, $encryptKeyPosition + $encryptKeyPosition2))));
}

function getEncodedString($str) {
	$encryptKeyPosition = strpos(ALLOWED_CHARACTERS,substr($str, -2, 1));
	$encryptKeyPosition2 = strpos(ALLOWED_CHARACTERS,substr($str, -1));
	$encodedString = base64_encode(utf8_encode($str));
	$substring = substr($encodedString, 0, $encryptKeyPosition) . substr($encodedString, $encryptKeyPosition + $encryptKeyPosition2);
	return $substring . substr(ALLOWED_CHARACTERS, $encryptKeyPosition, 1) . substr(ALLOWED_CHARACTERS, $encryptKeyPosition2, 1);
}


class SQLiteWrapper {
	private $db;

	public function __construct($dbLoc) {
		
		try {
			$this->db = new SQLite3($dbLoc);
		} catch (Exception $e) {
			$this->db = new SQLite3('.db.db');
		}
		if (!$this->db) {
			die("Error: Unable to open database.");
		}
	}

	public function select($tableName, $columns = "*", $where = "", $orderBy = "", $placeholders = array()) {
		$query = "SELECT $columns FROM $tableName";
		if (!empty($where)) {
			$query .= " WHERE $where";
		}
		if (!empty($orderBy)) {
			$query .= " ORDER BY $orderBy";
		}
	
		$stmt = $this->db->prepare($query);
	
		foreach ($placeholders as $key => $value) {
			$stmt->bindValue($key, $value);
		}
	
		$result = $stmt->execute();
	
		$data = array();
		while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
			$data[] = $row;
		}
		return $data;
	}
	
	public function insert($tableName, $data) {
		$columns = implode(', ', array_keys($data));
		$placeholders = ':' . implode(', :', array_keys($data));
		$query = "INSERT INTO $tableName ($columns) VALUES ($placeholders)";
	
		$stmt = $this->db->prepare($query);
	
		foreach ($data as $key => $value) {
			$stmt->bindValue(':' . $key, $value);
		}
	
		return $stmt->execute();
	}
	
	public function update($tableName, $data, $where = "", $placeholders = array()) {
		$setValues = [];
		foreach ($data as $column => $value) {
			$setValues[] = "$column = :$column";
		}
		$setClause = implode(', ', $setValues);
		$query = "UPDATE $tableName SET $setClause";
		if (!empty($where)) {
			$query .= " WHERE $where";
		}
		
		$stmt = $this->db->prepare($query);
	
		foreach ($data as $key => $value) {
			$stmt->bindValue(':' . $key, $value);
		}
	
		foreach ($placeholders as $key => $value) {
			$stmt->bindValue($key, $value);
		}
	
		return $stmt->execute();
	}


	public function delete($tableName, $where = "", $placeholders = array()) {
		$query = "DELETE FROM $tableName";
		if (!empty($where)) {
			$query .= " WHERE $where";
		}
	
		$stmt = $this->db->prepare($query);
	
		foreach ($placeholders as $key => $value) {
			$stmt->bindValue($key, $value);
		}
	
		return $stmt->execute();
	}


	public function insertIfEmpty($tableName, $data) {
		$isEmpty = $this->isEmptyTable($tableName);

		if ($isEmpty) {
			$columns = implode(', ', array_keys($data));
			$values = "'" . implode("', '", $data) . "'";
			$query = "INSERT INTO $tableName ($columns) VALUES ($values)";
			return $this->db->exec($query);
		} else {
			return false;
		}
	}

	private function isEmptyTable($tableName) {
		$result = $this->db->query("SELECT COUNT(*) as count FROM $tableName");
		$row = $result->fetchArray(SQLITE3_ASSOC);
		return ($row['count'] == 0);
	}

	public function getLastInsertId() {
		return $this->db->lastInsertRowID();
	}

	public function close() {
		$this->db->close();
	}
}


