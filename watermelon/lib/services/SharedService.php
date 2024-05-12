<?php
$storePath = realpath(dirname(__FILE__) . '/../store');
require_once $storePath . '/ClassStore.php';
require_once $storePath . '/SessionStore.php';

class SharedService
{
    private ClassStore $classStore;
    private UserStore $userStore;
    private SessionStore $sessionStore;

    public function __construct(ClassStore $classStore, UserStore $userStore, SessionStore $sessionStore)
    {
        $this->classStore = $classStore;
        $this->userStore = $userStore;
        $this->sessionStore = $sessionStore;
    }

    public function getClassById(int $class_id): Clazz
    {
        return $this->classStore->getClassById($class_id);
    }

    /**
     * Retrieves a list of User objects.
     *
     * @return User[] An array of User objects.
     */
    public function getClassStudentsById(int $class_id): array
    {
        return $this->userStore->getStudentsByClassId($class_id);
    }

    public function getSessionById(int $session_id): Session
    {
        return $this->sessionStore->getSessionById($session_id);
    }
}

class SharedServiceException extends Exception
{
    const FAILED_TO_CREATE_CLASS = 1;
    const FAILED_TO_CREATE_SESSION = 2;

    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
