<?php
ob_start(); // Start output buffering
require_once '../../../lib/helpers/auth_helper.php';
startSecureSession();

redirectToLoginIfNotAuthenticated();
redirectToDashboardIfNotStudent();

$loggedInSessionData = getLoggedInSessionData();

require_once '../../../lib/store/db.php';
require_once '../../../lib/services/StudentService.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentService = new StudentService($classStore, $sessionStore);

    $session_id = $_POST['session_id'];
    $student_id = $loggedInSessionData->id;

    $isSuccessful = $studentService->attendMeInSession($session_id, $student_id);
} else {
    header('Location: /dashboard');
    exit;
}

?>

<?php require_once '../../../lib/components/button.php' ?>
<?php require_once '../../../lib/components/header_component.php' ?>
<?php require_once '../../../lib/components/footer_component.php' ?>
<?php require_once '../../../lib/components/class_card.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require_once '../../../lib/components/head/meta.php' ?>
    <?php require_once '../../../lib/components/head/facebook_meta.php' ?>
    <?php require_once '../../../lib/components/head/twitter_meta.php' ?>

    <?php require_once '../../../lib/components/head/favicon.php' ?>
    <?php require_once '../../../lib/components/head/tailwind_css.php' ?>
</head>

<body class="flex flex-col min-h-screen">
    <?php HeaderComponent() ?>
    <main class="flex-grow px-8 flex flex-col justify-center items-center">
        <div class="w-full max-w-md">
            <div class="mt-4">
                <?php if ($isSuccessful) { ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">You have successfully attended the session.</span>
                    </div>
                <?php } else { ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Failed!</strong>
                        <span class="block sm:inline">Failed to attend the session.</span>
                    </div>
                <?php } ?>

                <div class="mt-4">
                    <a href="/dashboard" class="text-blue-500 font-bold">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </main>
    <?php FooterComponent() ?>
</body>

</html>