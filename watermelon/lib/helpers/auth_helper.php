<?php

function redirectToDashboardIfLoggedIn()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['username'])) {
        header("Location: dashboard.php");
        exit;
    }
}

function redirectToLoginIfNotAuthenticated()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

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


function login($username)
{
    startSecureSession();

    $_SESSION["username"] = $username;

    header("Location: dashboard.php");
}

function logout()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

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
