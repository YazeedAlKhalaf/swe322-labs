<?php
require_once '../lib/helpers/auth_helper.php';
startSecureSession();

redirectToLoginIfNotAuthenticated();

$loggedInSessionData = getLoggedInSessionData();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logout"])) {
    logout();
}
?>

<?php
require_once '../lib/store/db.php';
require_once '../lib/services/TeacherService.php';
require_once '../lib/services/StudentService.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if ($loggedInSessionData->accountType === AccountType::TEACHER) {
        $teacherService = new TeacherService($classStore, $sessionStore, $userStore);

        $classes = $teacherService->getClasses($loggedInSessionData->id);
    } else if ($loggedInSessionData->accountType === AccountType::STUDENT) {
        $studentService = new StudentService($classStore, $sessionStore);

        $classes = $studentService->getClasses($loggedInSessionData->id);
    }
}
?>

<?php require_once '../lib/components/button.php' ?>
<?php require_once '../lib/components/header_component.php' ?>
<?php require_once '../lib/components/footer_component.php' ?>
<?php require_once '../lib/components/class_card.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require_once '../lib/components/head/meta.php' ?>
    <?php require_once '../lib/components/head/facebook_meta.php' ?>
    <?php require_once '../lib/components/head/twitter_meta.php' ?>

    <?php require_once '../lib/components/head/favicon.php' ?>
    <?php require_once '../lib/components/head/tailwind_css.php' ?>
</head>

<body class="flex flex-col min-h-screen">
    <?php HeaderComponent() ?>
    <main class="flex-grow px-8 flex flex-col justify-center items-center">
        <h1 class="text-3xl font-bold text-center">Welcome to the dashboard, <?php echo $loggedInSessionData->username; ?>!</h1>
        <h2 class="text-xl font-semibold text-center">Account Type: <?php echo $loggedInSessionData->accountType; ?></h2>
        <form method="POST">
            <button type="submit" name="logout" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded mt-4">Logout</button>
        </form>

        <?php if ($loggedInSessionData->accountType === AccountType::TEACHER) : ?>
            <?php if (!empty($classes)) : ?>
                <div class="m-4">
                    <?php LinkButton("/dashboard/class/create.php", "+ Create Class") ?>
                </div>
            <?php endif; ?>

            <div class="max-w-96 w-full mt-4">
                <?php if (empty($classes)) : ?>
                    <div class="bg-gray-100 p-4 rounded-lg mb-4">
                        <h2 class="text-xl font-semibold">No classes available</h2>
                        <p class="text-gray-700">You have not created any classes yet.</p>
                        <div class="m-4">
                            <?php LinkButton("/dashboard/class/create.php", "+ Create Class") ?>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="grid grid-cols-2 gap-4">
                        <?php foreach ($classes as $class) : ?>
                            <?php ClassCard($class) ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if ($loggedInSessionData->accountType === AccountType::STUDENT) : ?>
            <div class="m-4">
                <h1>This is only shown to the student!!!</h1>
            </div>

            <div class="max-w-96 w-full mt-4">
                <?php if (empty($classes)) : ?>
                    <div class="bg-gray-100 p-4 rounded-lg mb-4">
                        <h2 class="text-xl font-semibold">No classes available</h2>
                        <p class="text-gray-700">You have not joined any classes yet.</p>
                        <div class="m-4">
                            <?php LinkButton("/dashboard/class/join.php", "+ Join Class") ?>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="grid grid-cols-2 gap-4">
                        <?php foreach ($classes as $class) : ?>
                            <?php ClassCard($class) ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </main>
    <?php FooterComponent() ?>
</body>

</html>