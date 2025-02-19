<?php

class SQLiteWrapper {
    private $db;

    public function __construct($dbPath) {
        $this->db = new SQLite3($dbPath);
        $this->createTables();
    }

    private function createTables() {
        // Cria a tabela playlist se não existir
        $this->db->exec("CREATE TABLE IF NOT EXISTS playlist (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            client_name TEXT,
            usuario TEXT,
            senha TEXT,
            vencimento TEXT,
            email TEXT
        )");

        // Cria a tabela users se não existir
        $this->db->exec("CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT NOT NULL UNIQUE,
            password TEXT NOT NULL
        )");
    }

    public function insertUser($username, $password) {
        $stmt = $this->db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bindValue(1, $username);
        $stmt->bindValue(2, password_hash($password, PASSWORD_DEFAULT));
        return $stmt->execute();
    }

    // Outras funções de manipulação do banco de dados...

    public function select($table, $columns, $where = '', $order = '', $params = []) {
        $sql = "SELECT $columns FROM $table" . ($where ? " WHERE $where" : "") . ($order ? " ORDER BY $order" : "");
        $stmt = $this->db->prepare($sql);

        if ($params) {
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
        }

        $result = $stmt->execute();
        $rows = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function __destruct() {
        $this->db->close();
    }
}

// Inicializando o banco de dados
$db = new SQLiteWrapper('./api/.adb.db');

?>
