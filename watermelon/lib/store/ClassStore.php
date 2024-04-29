<?php

// we use "Clazz" cuz "Class" is reserved :D
class Clazz
{
    public int $id;
    public string $name;
    public int $teacher_id;
    public string $description;
    public string $password;
    public DateTime $created_at;
}

class ClassStore
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function createClass(string $name, int $teacher_id, string $description, string $password): ?Clazz
    {
        $conn = $this->db->get_connection();
        $stmt = $conn->prepare("INSERT INTO class (name, teacher_id, description, password) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            return null;
        }

        $stmt->bind_param("ssss", $name, $teacher_id, $description, $password);
        $success = $stmt->execute();

        if (!$success) {
            return null;
        }

        $class_id = $conn->insert_id;

        $stmt = $conn->prepare("SELECT * FROM class WHERE id = ?");
        $stmt->bind_param("i", $class_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $class = new Clazz();
            $class->id = $row['id'];
            $class->name = $row['name'];
            $class->teacher_id = $row['teacher_id'];
            $class->description = $row['description'];
            $class->password = $row['password'];
            $class->created_at = new DateTime($row['created_at']);
            return $class;
        }

        return null;
    }
}
