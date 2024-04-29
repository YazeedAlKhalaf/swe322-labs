<?php
$storePath = realpath(dirname(__FILE__) . '/../store');
require_once $storePath . '/ClassStore.php';
require_once $storePath . '/SessionStore.php';

class TeacherService
{
    private ClassStore $classStore;
    private SessionStore $sessionStore;

    public function __construct(ClassStore $classStore, SessionStore $sessionStore)
    {
        $this->classStore = $classStore;
        $this->sessionStore = $sessionStore;
    }

    public function createClass(string $name, int $teacher_id, ?string $description, string $password): Clazz
    {
        $createdClass = $this->classStore->createClass($name, $teacher_id, $description, $password);
        if (!$createdClass) {
            throw new TeacherServiceException("Failed to create class", TeacherServiceException::FAILED_TO_CREATE_CLASS);
        }

        return $createdClass;
    }

    public function createSession(string $class_id, DateTime $start_datetime, DateTime $end_datetime, ?string $location): Session
    {
        $createdSession = $this->sessionStore->createSession($class_id, $start_datetime, $end_datetime, $location);
        if (!$createdSession) {
            throw new TeacherServiceException("Failed to create session", TeacherServiceException::FAILED_TO_CREATE_SESSION);
        }

        return $createdSession;
    }
}

class TeacherServiceException extends Exception
{
    const FAILED_TO_CREATE_CLASS = 1;
    const FAILED_TO_CREATE_SESSION = 2;

    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
