<?php
ob_start(); // Start output buffering
require_once '../../lib/helpers/auth_helper.php';
startSecureSession();

redirectToLoginIfNotAuthenticated();

$loggedInSessionData = getLoggedInSessionData();
?>

<?php
require_once '../../lib/store/db.php';
require_once '../../lib/services/TeacherService.php';
require_once '../../lib/services/StudentService.php';
require_once '../../lib/services/SharedService.php';

$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);

if (!isset($queries['id'])) {
    header('Location: /dashboard');
    exit;
}

$class_id = $queries['id'];


$sharedService = new SharedService($classStore, $userStore, $sessionStore);

$class = $sharedService->getClassById($class_id);
$students = $sharedService->getClassStudentsById($class_id);

if ($loggedInSessionData->accountType === AccountType::TEACHER) {
    $teacherService = new TeacherService($classStore, $sessionStore, $userStore);
} else if ($loggedInSessionData->accountType === AccountType::STUDENT) {
    $studentService = new StudentService($classStore, $sessionStore);
}
?>

<?php require_once '../../lib/components/button.php' ?>
<?php require_once '../../lib/components/header_component.php' ?>
<?php require_once '../../lib/components/footer_component.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require_once '../../lib/components/head/meta.php' ?>
    <?php require_once '../../lib/components/head/facebook_meta.php' ?>
    <?php require_once '../../lib/components/head/twitter_meta.php' ?>

    <?php require_once '../../lib/components/head/favicon.php' ?>
    <?php require_once '../../lib/components/head/tailwind_css.php' ?>
</head>

<body class="flex flex-col min-h-screen">
    <?php HeaderComponent() ?>

    <main class="flex-grow px-8 flex flex-col justify-center items-center">
        <h1 class="text-3xl font-bold text-center">Class ID: <?php echo $class->id; ?></h1>
        <h1 class="text-3xl font-bold text-center">Class Name: <?php echo $class->name; ?></h1>
        <h2 class="text-xl font-semibold text-center">Teacher: <?php echo $class->teacher_id; ?></h2>
        <h3 class="text-lg font-medium text-center">Description: <?php echo $class->description; ?></h3>
        <?php if ($loggedInSessionData->accountType === AccountType::TEACHER) : ?>
            <h4 class="font-bold">Invitation Code: <?php echo $class->password; ?></h4>
        <?php endif; ?>


        <?php if ($loggedInSessionData->accountType === AccountType::TEACHER) : ?>
            <hr class="my-4 w-full" />
            <form method="POST" action="/dashboard/class/session/create.php">
                <input type="hidden" name="class_id" value="<?php echo $class_id; ?>" />
                <?php Button("Create Session", "submit") ?>
            </form>
        <?php endif; ?>

        <hr class="my-4 w-full" />

        <h3 class="text-lg font-medium text-center">Students:</h3>
        <ul>
            <?php foreach ($students as $student) : ?>
                <li><?php echo $student->username; ?></li>
            <?php endforeach; ?>
        </ul>
    </main>

    <?php FooterComponent() ?>
</body>

</html>