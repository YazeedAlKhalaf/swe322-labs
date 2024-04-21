<?php
class UserStore
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function createUser(string $username, string $password): bool
    {
        $conn = $this->db->get_connection();

        $stmt = $conn->prepare("INSERT INTO user (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);
        return $stmt->execute();
    }

    public function getUserByUsername(string $username): ?array
    {
        $conn = $this->db->get_connection();

        $stmt = $conn->prepare("SELECT id, password FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
