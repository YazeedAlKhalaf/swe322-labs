<?php
require_once './lib/helpers/auth_helper.php';
startSecureSession();

redirectToLoginIfNotAuthenticated();
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
        <h1>You are in the dashbaord :D</h1>
    </main>
    <?php FooterComponent() ?>
</body>

</html>