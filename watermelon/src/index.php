<?php include 'lib/components/button.php' ?>

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
    <header class="flex flex-row justify-between items-center p-4 bg-green-300">
        <a href="/">
            <img src="/static/images/logo.svg" class="h-6" />
        </a>
        <div class="flex flex-row gap-4 font-medium">
            <a href="/features" class="hover:bg-green-400 rounded-lg px-3 py-2 transition-all">Features</a>
            <a href="/pricing" class="hover:bg-green-400 rounded-lg px-3 py-2 transition-all">Pricing</a>
            <a href="/testimonials" class="hover:bg-green-400 rounded-lg px-3 py-2 transition-all">Testimonials</a>
        </div>
    </header>
    <main class="flex-grow px-8">
        <div class="flex flex-col md:flex-row text-center md:text-start justify-between items-center">
            <div class="flex flex-col gap-2">
                <h1 class="text-green-600 font-bold text-5xl">Your go-to for attendance</br>and discipline!</h1>
                <h3 class="text-gray-800">Both teachers and students love us :D</h3>
                <div>
                    <?php LinkButton('/', 'Get Started') ?>
                </div>
            </div>
            <img src="/static/images/landing/man-scanning-qr-code.png" class="h-96" />
        </div>
    </main>
    <footer class="flex flex-col justify-center items-center bg-green-300 p-4">
        <p>Made with ❤️ in Riyadh 🇸🇦</p>
    </footer>
</body>

</html>