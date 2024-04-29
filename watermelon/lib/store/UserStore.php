<?php
$commonPath = realpath(dirname(__FILE__) . '/../common');
require_once $commonPath . '/account_type.php';

class User
{
    public int $id;
    public string $username;
    public string $password;
    public string $account_type;
}

class UserStore
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function createUser(string $username, string $password, string $account_type): bool
    {
        if ($account_type !== AccountType::STUDENT && $account_type !== AccountType::TEACHER) {
            throw new UserStoreException("Invalid account type", UserStoreException::ACCOUNT_TYPE_INVALID);
        }

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

        $stmt_insert = $conn->prepare("INSERT INTO user (username, password, account_type) VALUES (?, ?, ?)");
        if (!$stmt_insert) {
            return false;
        }

        $stmt_insert->bind_param("sss", $username, $password, $account_type);
        $success = $stmt_insert->execute();

        return $success;
    }


    public function getUserByUsername(string $username): ?User
    {
        $conn = $this->db->get_connection();

        $stmt = $conn->prepare("SELECT id, username, password, account_type FROM user WHERE username = ?");
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
        $user->account_type = $assoc["account_type"];

        return $user;
    }
}

class UserStoreException extends Exception
{
    const USERNAME_ALREADY_USED = 1;
    const ACCOUNT_TYPE_INVALID = 2;

    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
