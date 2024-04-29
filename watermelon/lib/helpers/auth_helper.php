<?php

function redirectToDashboardIfLoggedIn()
{
    startSecureSession();


    if (isset($_SESSION['username'])) {
        header("Location: dashboard");
        exit;
    }
}

function redirectToLoginIfNotAuthenticated()
{
    startSecureSession();


    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }
}

function startSecureSession()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start([
            "cookie_secure" => true,
            "cookie_httponly" => true,
            "cookie_samesite" => "Lax",
        ]);
    }
}

function login(string $username, string $accountType)
{
    startSecureSession();

    $_SESSION["username"] = $username;
    $_SESSION["accountType"] = $accountType;

    header("Location: dashboard");
}

class LoggedInSessionData
{
    public string $username;
    public string $accountType;
}

function getLoggedInSessionData(): ?LoggedInSessionData
{
    startSecureSession();

    if (!isset($_SESSION['username'])) {
        return null;
    }

    $data = new LoggedInSessionData();
    $data->username = $_SESSION["username"];
    $data->accountType = $_SESSION["accountType"];

    return $data;
}

function logout()
{
    startSecureSession();


    $_SESSION = [];

    // Destroy the session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    session_destroy();

    header("Location: login.php");
    exit;
}
