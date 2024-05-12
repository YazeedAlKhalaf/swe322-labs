<?php
$storePath = realpath(dirname(__FILE__) . '/../store');
require_once $storePath . '/ClassStore.php';
require_once $storePath . '/SessionStore.php';

class StudentService
{
    private ClassStore $classStore;
    private SessionStore $sessionStore;

    public function __construct(ClassStore $classStore, SessionStore $sessionStore)
    {
        $this->classStore = $classStore;
        $this->sessionStore = $sessionStore;
    }

    /**
     * Retrieves a list of Clazz objects.
     *
     * @return Clazz[] An array of Clazz objects.
     */
    public function getClasses(int $student_id): array
    {
        $classes = $this->classStore->getClassesByStudentId($student_id);

        return $classes;
    }

    public function attendMeInSession(int $session_id, int $student_id): bool
    {
        return $this->sessionStore->attendStudentInSession($session_id, $student_id);
    }

    public function joinClass(int $class_id, string $invitation_code): bool
    {
        return $this->classStore->joinClass($class_id, $invitation_code);
    }
}

class StudentServiceException extends Exception
{
    const FAILED_TO_CREATE_CLASS = 1;
    const FAILED_TO_CREATE_SESSION = 2;

    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
