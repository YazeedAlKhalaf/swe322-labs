<?php

class AuthService
{
    private UserStore $userStore;

    public function __construct(UserStore $userStore)
    {
        $this->userStore = $userStore;
    }

    public function register(string $username, string $password): bool
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $result = $this->userStore->createUser($username, $hashed_password);

        return $result;
    }

    public function login(string $username, string $password): bool
    {
        $user = $this->userStore->getUserByUsername($username);
        if ($user == null) {
            return false;
        }

        $result = password_verify($password, $user->password);

        return $result;
    }
}
