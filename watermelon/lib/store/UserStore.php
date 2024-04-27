<?php

class User
{
    public string $username;
    public string $password;
}

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

        $stmt_check = $conn->prepare("SELECT COUNT(*) as count FROM user WHERE username = ?");
        $stmt_check->bind_param("s", $username);
        $stmt_check->execute();

        $result = $stmt_check->get_result();
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {
            return false;
        }

        $stmt_insert = $conn->prepare("INSERT INTO user (username, password) VALUES (?, ?)");
        $stmt_insert->bind_param("ss", $username, $password);
        $success = $stmt_insert->execute();

        return $success;
    }

    public function getUserByUsername(string $username): ?User
    {
        $conn = $this->db->get_connection();

        $stmt = $conn->prepare("SELECT id, password FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();

        $assoc = $result->fetch_assoc();
        if (!$assoc) {
            return null;
        }

        $user = new User();
        $user->username = $assoc["username"];
        $user->password = $assoc["password"];

        return $user;
    }
}
