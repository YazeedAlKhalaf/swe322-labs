<?php

class Session
{
    public int $id;
    public int $class_id;
    public DateTime $start_datetime;
    public DateTime $end_datetime;
    public ?string $location;
    public DateTime $created_at;
}

class SessionStore
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function createSession(string $class_id, DateTime $start_datetime, DateTime $end_datetime, ?string $location): ?Session
    {
        $conn = $this->db->get_connection();

        try {
            $conn->begin_transaction();

            $stmt = $conn->prepare("INSERT INTO session (class_id, start_datetime, end_datetime, location) VALUES (?, ?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Failed to prepare statement for session insertion");
            }

            $startDatetimeStr = $start_datetime->format('Y-m-d H:i:s');
            $endDatetimeStr = $end_datetime->format('Y-m-d H:i:s');

            $stmt->bind_param("ssss", $class_id, $startDatetimeStr, $endDatetimeStr, $location);
            $success = $stmt->execute();

            if (!$success) {
                throw new Exception("Failed to insert session into the database");
            }

            $session_id = $conn->insert_id;

            $stmt = $conn->prepare("SELECT * FROM session WHERE id = ?");
            if (!$stmt) {
                throw new Exception("Failed to prepare statement for session retrieval");
            }

            $stmt->bind_param("i", $session_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $session = new Session();
                $session->id = $row['id'];
                $session->class_id = $row['class_id'];
                $session->start_datetime = new DateTime($row['start_datetime']);
                $session->end_datetime = new DateTime($row['end_datetime']);
                $session->location = $row['location'];
                $session->created_at = new DateTime($row['created_at']);

                $conn->commit();

                return $session;
            } else {
                throw new Exception("Session not found after insertion");
            }
        } catch (Exception $e) {
            $conn->rollback();
            return null;
        }
    }
}
