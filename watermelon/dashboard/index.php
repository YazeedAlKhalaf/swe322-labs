<?php
require_once '../lib/helpers/auth_helper.php';
startSecureSession();

redirectToLoginIfNotAuthenticated();

$loggedInSessionData = getLoggedInSessionData();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logout"])) {
    logout();
}
?>

<?php include '../lib/components/button.php' ?>
<?php include '../lib/components/header_component.php' ?>
<?php include '../lib/components/footer_component.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include '../lib/components/head/meta.php' ?>
    <?php include '../lib/components/head/facebook_meta.php' ?>
    <?php include '../lib/components/head/twitter_meta.php' ?>

    <?php include '../lib/components/head/favicon.php' ?>
    <?php include '../lib/components/head/tailwind_css.php' ?>
</head>

<body class="flex flex-col min-h-screen">
    <?php HeaderComponent() ?>
    <main class="flex-grow px-8 flex flex-col justify-center items-center">
        <h1 class="text-3xl font-bold text-center">Welcome to the dashboard, <?php echo $loggedInSessionData->username; ?>!</h1>
        <h2 class="text-xl font-semibold text-center">Account Type: <?php echo $loggedInSessionData->accountType; ?></h2>
        <form method="POST">
            <button type="submit" name="logout" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded mt-4">Logout</button>
        </form>
    </main>
    <?php FooterComponent() ?>
</body>

</html>