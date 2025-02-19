<?php
//parse config options
try {
	@$config_ini = parse_ini_file("./config.ini");
} catch (Exception $e) {
	@$config_ini = parse_ini_file("../config.ini");
}

if (@$config_ini['debug'] == 1 ){
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}else{
	ini_set('display_errors', 0);
}

$status = session_status();
if($status == PHP_SESSION_NONE){
	session_start();
}else
if($status == PHP_SESSION_DISABLED){
	//Sessions are not available
}else
if($status == PHP_SESSION_ACTIVE){
	//Destroy current and start new one
	session_destroy();
	session_start();
}


function generate_token() {
	if(!isset($_SESSION["ftg"])) {
		$token = random_bytes(64);
		$_SESSION["ftg"] = $token;
	} else {
		$token = $_SESSION["ftg"];
	}
	return $token;
}

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
	"user" => [
		"id" => "INTEGER PRIMARY KEY",
		"username" => "TEXT NOT NULL",
		"password" => "TEXT NOT NULL",
	],
	"dns" => [
		"id" => "INTEGER PRIMARY KEY",
		"title" => "TEXT",
		"url" => "TEXT",
	],
	"note" => [
		"id" => "INTEGER PRIMARY KEY",
		"note_title" => "TEXT",
		"note_content" => "TEXT",
		"createdate" => "TEXT",
	],
	"welcome" => [
		"id" => "INTEGER PRIMARY KEY",
		"message_one" => "TEXT",
		"message_two" => "TEXT",
		"message_three" =>"TEXT",
	],
];

createTables($tables, $dbPath);

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


class Encryption {

    public static function encrypt($i, $key, $iv) {
        $encrypted = openssl_encrypt($i, 'AES-128-CBC', $key, 0, $iv);
        $length = strlen($encrypted);
        return array($encrypted, $length);
    }

    public static function run($i) {
        $key = "RsKivDuoeRgHxS18";
        $key2 = "81SxHgReouDviKsR";
        $iv = 'tbDX3QvEUZW6gS5M';
        $substring = rand(20,strlen($i) - 20);
        $ep1 = self::encrypt(substr($i, 0, $substring), $key, $iv );
        $ep2 = self::encrypt(substr($i, $substring), $key2, $iv);
        $encoded = base64_encode($ep1[0] . $ep2[0] . '!' . $ep1[1]);
        return '{"data":"' . $encoded . '"}';
    }
}

////Get User IP
function real_ip() {
	$ip = 'undefined';
	if (isset($_SERVER)) {
		$ip = $_SERVER['REMOTE_ADDR'];
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		elseif (isset($_SERVER['HTTP_CLIENT_IP'])) $ip = $_SERVER['HTTP_CLIENT_IP'];
	} else {
		$ip = getenv('REMOTE_ADDR');
		if (getenv('HTTP_X_FORWARDED_FOR')) $ip = getenv('HTTP_X_FORWARDED_FOR');
		elseif (getenv('HTTP_CLIENT_IP')) $ip = getenv('HTTP_CLIENT_IP');
	}
	$ip = htmlspecialchars($ip, ENT_QUOTES, 'UTF-8');
	return $ip;
}
