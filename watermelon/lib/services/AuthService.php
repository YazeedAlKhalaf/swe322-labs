<?php

class AuthService
{
    private UserStore $userStore;

    public function __construct(UserStore $userStore)
    {
        $this->userStore = $userStore;
    }

    public function register(string $username, string $password, string $account_type): bool
    {
        try {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $result = $this->userStore->createUser($username, $hashed_password, $account_type);
            return $result;
        } catch (UserStoreException $e) {
            if ($e->getCode() === UserStoreException::USERNAME_ALREADY_USED) {
                throw new AuthServiceException("Username already exists", AuthServiceException::USERNAME_ALREADY_USED);
            } elseif ($e->getCode() === UserStoreException::ACCOUNT_TYPE_INVALID) {
                throw new AuthServiceException("Account type invalud", AuthServiceException::ACCOUNT_TYPE_INVALID);
            } else {
                throw $e;
            }
        }
    }

    public function login(string $username, string $password): User
    {
        try {
            $user = $this->userStore->getUserByUsername($username);
            if ($user == null) {
                throw new AuthServiceException("User not found", AuthServiceException::INVALID_USERNAME_OR_PASSWORD);
            }

            $result = password_verify($password, $user->password);
            if (!$result) {
                throw new AuthServiceException("Invalid password", AuthServiceException::INVALID_USERNAME_OR_PASSWORD);
            }

            return $user;
        } catch (Exception $e) {
            throw new AuthServiceException("Authentication failed", $e->getCode(), $e);
        }
    }
}


class AuthServiceException extends Exception
{
    const USERNAME_ALREADY_USED = 1;
    const INVALID_USERNAME_OR_PASSWORD = 2;
    const ACCOUNT_TYPE_INVALID = 2;

    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
