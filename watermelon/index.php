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
    <?php HeaderComponent($landing_links) ?>
    <main class="flex-grow px-8">
        <div class="flex flex-col md:flex-row text-center md:text-start justify-between items-center">
            <div class="flex flex-col gap-2">
                <h1 class="text-green-600 font-bold text-5xl">Your go-to for attendance</br>and discipline!</h1>
                <h2 class="text-gray-800">Both teachers and students love us :D</h2>
                <div class="flex flex-row gap-4">
                    <?php LinkButton('login.php', 'Login') ?>
                    <?php LinkButton('register.php', 'Register') ?>
                </div>
            </div>
            <img src="static/images/landing/man-scanning-qr-code.png" class="h-96" />
        </div>
    </main>
    <?php FooterComponent() ?>
</body>

</html>