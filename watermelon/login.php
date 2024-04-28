<?php
ob_start(); // Start output buffering
require_once './lib/helpers/auth_helper.php';
startSecureSession();

redirectToDashboardIfLoggedIn();
?>

<?php
require_once './lib/store/db.php';
require_once './lib/services/AuthService.php';

function validateInput($input, $minLength, $maxLength, $errorMessage)
{
    if ($input == "" || strlen($input) < $minLength || strlen($input) > $maxLength) {
        return $errorMessage;
    }
    return null;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $authService = new AuthService($userStore);

    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    $errorMessage = "";

    $usernameError = validateInput($username, 3, 15, "• Username must be between 3 and 15 characters.");
    if ($usernameError) {
        $errorMessage .= ($errorMessage ? "<br />" : "") . $usernameError;
    }

    $passwordError = validateInput($password, 8, 64, "• Password must be between 8 and 64 characters.");
    if ($passwordError) {
        $errorMessage .= ($errorMessage ? "<br />" : "") . $passwordError;
    }

    if (!$errorMessage) {
        try {
            $canLogin = $authService->login($username, $password);
            if ($canLogin) {
                login($username);
                exit;
            } else {
                $errorMessage = "We failed to log you in. Please try again.";
            }
        } catch (Exception $e) {
            $errorMessage = "An error occurred while logging you in. Please try again later.";
            error_log("Error registering user: " . $e->getMessage());
        }
    }
}
?>

<?php include 'lib/components/button.php' ?>
<?php include 'lib/components/header_component.php' ?>
<?php include 'lib/components/footer_component.php' ?>
<?php include 'lib/components/input.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include 'lib/components/head/meta.php' ?>
    <?php include 'lib/components/head/facebook_meta.php' ?>
    <?php include 'lib/components/head/twitter_meta.php' ?>

    <?php include 'lib/components/head/favicon.php' ?>
    <?php include 'lib/components/head/tailwind_css.php' ?>
</head>

<body class="flex flex-col min-h-screen">
    <?php HeaderComponent() ?>
    <main class="flex-grow px-8 flex flex-col justify-center items-center">
        <h1 class="text-5xl font-bold text-cente mb-4">Login</h1>

        <?php if (isset($errorMessage)) : ?>
            <div class="bg-red-200 text-red-800 py-2 px-4 rounded-lg mb-4">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="flex flex-col justify-center items-center w-96 gap-4">
            <?php Input("username", "username", "text", "Username", "", isset($username) ? $username : ''); ?>

            <?php PasswordInput("password", "password", "Password"); ?>

            <?php Button("Login", "submit", "w-full") ?>
        </form>
    </main>
    <?php FooterComponent() ?>
</body>

</html>