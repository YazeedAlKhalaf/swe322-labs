<?php

class User
{
    public int $id;
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
        if (!$stmt_check) {
            return false;
        }

        $stmt_check->bind_param("s", $username);
        $stmt_check->execute();
        $result = $stmt_check->get_result();

        $row = $result->fetch_assoc();
        if ($row['count'] > 0) {
            throw new UserStoreException("Username already exists", UserStoreException::USERNAME_ALREADY_USED);
        }

        $stmt_insert = $conn->prepare("INSERT INTO user (username, password) VALUES (?, ?)");
        if (!$stmt_insert) {
            return false;
        }

        $stmt_insert->bind_param("ss", $username, $password);
        $success = $stmt_insert->execute();

        return $success;
    }


    public function getUserByUsername(string $username): ?User
    {
        $conn = $this->db->get_connection();

        $stmt = $conn->prepare("SELECT id, username, password FROM user WHERE username = ?");
        if (!$stmt) {
            return null;
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        $assoc = $result->fetch_assoc();
        if (!$assoc) {
            return null;
        }

        $user = new User();
        $user->id = $assoc["id"];
        $user->username = $assoc["username"];
        $user->password = $assoc["password"];

        return $user;
    }
}

class UserStoreException extends Exception
{
    const USERNAME_ALREADY_USED = 1;

    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
