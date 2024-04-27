<?php
require_once './lib/store/db.php';
require_once './lib/services/AuthService.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $authService = new AuthService($userStore);

    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        $didCreateAccount = $authService->register($username, $password);
        if ($didCreateAccount) {
            header("Location: login.php");
            exit;
        } else {
            $errorMessage = "We failed to create an account for you. Please try again.";
        }
    } catch (Exception $e) {
        $errorMessage = "An error occured while registering. Please try again later.";
        error_log("Error registering user: " . $e->getMessage());
    }
}
?>

<?php include 'lib/components/button.php' ?>
<?php include 'lib/components/header_component.php' ?>
<?php include 'lib/components/footer_component.php' ?>

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
        <form method="POST" class="flex flex-col justify-center items-center w-96 gap-4">
            <?php if (isset($errorMessage)) : ?>
                <div class="bg-red-200 text-red-800 py-2 px-4 rounded-lg mb-4">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>

            <div class="flex flex-col w-full">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="border rounded-lg" required />
            </div>

            <div class="flex flex-col w-full">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="border rounded-lg" required />
            </div>

            <?php Button("Register", "submit", "w-full") ?>
        </form>
    </main>
    <?php FooterComponent() ?>
</body>

</html>