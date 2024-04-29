<?php
$commonPath = realpath(dirname(__FILE__) . '/../common');
require_once $commonPath . '/account_type.php';

function redirectToDashboardIfLoggedIn()
{
    startSecureSession();


    if (isset($_SESSION['username'])) {
        header("Location: /dashboard");
        exit;
    }
}

function redirectToLoginIfNotAuthenticated()
{
    startSecureSession();


    if (!isset($_SESSION['username'])) {
        header("Location: /login.php");
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

function login(string $id, string $username, string $accountType)
{
    startSecureSession();

    $_SESSION["id"] = $id;
    $_SESSION["username"] = $username;
    $_SESSION["accountType"] = $accountType;

    header("Location: /dashboard");
}

class LoggedInSessionData
{
    public int $id;
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
    $data->id = $_SESSION["id"];
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

    header("Location: /login.php");
    exit;
}

function redirectToDashboardIfNotTeacher()
{
    $loggedInSessionData = getLoggedInSessionData();

    if ($loggedInSessionData->accountType != AccountType::TEACHER) {
        header("Location: /dashboard");
    }
}

function redirectToDashboardIfNotStudent()
{
    $loggedInSessionData = getLoggedInSessionData();

    if ($loggedInSessionData->accountType != AccountType::STUDENT) {
        header("Location: /dashboard");
    }
}
