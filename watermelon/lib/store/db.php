<?php
require_once __DIR__ . '/UserStore.php';

class Database
{
    private mysqli $conn;

    public function __construct(string $host, string $username, string $password, string $database, ?int $port)
    {
        $this->conn = new mysqli($host, $username, $password, $database, $port);
        if ($this->conn->connect_error) {
            throw new Exception("Connection failed: ", $this->conn->connect_error);
        }
    }

    public function get_connection(): mysqli
    {
        return $this->conn;
    }

    public function close_connection(): void
    {
        $this->conn->close();
    }
}

$db_host = getenv("DB_HOST") ?: "localhost";
$db_user = getenv("DB_USER") ?: "username";
$db_pass = getenv("DB_PASS") ?: "password";
$db_name = getenv("DB_NAME") ?: "database_name";
$db_port = getenv("DB_PORT");

$database = new Database($db_host, $db_user, $db_pass, $db_name, $db_port);
$userStore = new UserStore($database);
