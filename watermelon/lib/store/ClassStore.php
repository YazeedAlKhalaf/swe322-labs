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

        $stmt->bind_param("siss", $name, $teacher_id, $description, $password);
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

    public function getClassesByTeacherId(int $teacher_id): array
    {
        $conn = $this->db->get_connection();
        $stmt = $conn->prepare("SELECT * FROM class WHERE teacher_id = ?");
        if (!$stmt) {
            return null;
        }

        $stmt->bind_param("i", $teacher_id);
        $success = $stmt->execute();
        if (!$success) {
            return null;
        }

        $result = $stmt->get_result();

        $classes = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $clazz = new Clazz();
            $clazz->id = $row['id'];
            $clazz->name = $row['name'];
            $clazz->teacher_id = $row['teacher_id'];
            $clazz->description = $row['description'];
            $clazz->password = $row['password'];
            $clazz->created_at = new DateTime($row['created_at']);

            $classes[] = $clazz;
        }

        return $classes;
    }
}
