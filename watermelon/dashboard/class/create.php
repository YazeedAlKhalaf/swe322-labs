<?php
ob_start(); // Start output buffering
require_once '../../lib/helpers/auth_helper.php';
startSecureSession();

redirectToLoginIfNotAuthenticated();
redirectToDashboardIfNotTeacher();
?>

<?php
require_once '../../lib/store/db.php';
require_once '../../lib/services/TeacherService.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teacherService = new TeacherService($classStore, $sessionStore);

    $name = trim($_POST["name"]);
    $description = trim($_POST["description"]);
    $invitationCode = $_POST["invitation_code"];

    $errorMessage = "";

    $nameError = validateName($name);
    if ($nameError) {
        $errorMessage .= ($errorMessage ? "<br />" : "") . $nameError;
    }

    $descriptionError = validateDescription($description);
    if ($descriptionError) {
        $errorMessage .= ($errorMessage ? "<br />" : "") . $descriptionError;
    }

    $invitationCodeError = validateInvitationCode($invitationCode);
    if ($descriptionError) {
        $errorMessage .= ($errorMessage ? "<br />" : "") . $invitationCodeError;
    }

    if (!$errorMessage) {
        try {
            $clazz = $teacherService->createClass($name, 1, $description, $invitationCode);

            header("Location: /dashboard/class/?id=" . $clazz->id);
            exit;
        } catch (TeacherServiceException $e) {
            if ($e->getCode() === TeacherServiceException::FAILED_TO_CREATE_CLASS) {
                $errorMessage .= ($errorMessage ? "<br />" : "") . "• Failed to create class.";
            }
        } catch (Exception $e) {
            $errorMessage .= ($errorMessage ? "<br />" : "") . "• An error occurred while a class for you. Please try again later.";
            error_log("Error creating a class: " . $e->getMessage());
        }
    }
}

?>

<?php require_once '../../lib/components/button.php' ?>
<?php require_once '../../lib/components/header_component.php' ?>
<?php require_once '../../lib/components/footer_component.php' ?>
<?php require_once '../../lib/components/input.php' ?>

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
    <main class="flex-grow px-8 flex flex-col justify-center items-start max-w-[40rem] m-auto w-full gap-6">
        <div>
            <h1 class="text-3xl font-bold text-start">Create a Class</h1>
            <h2 class="text-xl font-semibold text-start text-slate-600">Here you can create your own class :D</h2>
        </div>

        <?php if (isset($errorMessage)) : ?>
            <div class="bg-red-200 text-red-800 py-2 px-4 rounded-lg mb-4">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="flex flex-col justify-center items-center w-full gap-4">
            <?php Input("name", "name", "text", "Name") ?>
            <?php Input("description", "description", "text", "Description") ?>
            <?php Input("invitation_code", "invitation_code", "text", "Invitation Code") ?>

            <?php Button("Create Class", "submit", "w-full") ?>
        </form>
    </main>
    <?php FooterComponent() ?>
</body>

</html>

<?php
function validateName(string $name): ?string
{
    if ($name == "" || strlen($name) < 3 || strlen($name) > 15) {
        return "• Name must be between 2 and 15 characters.";
    }

    return null;
}

function validateDescription(string $description): ?string
{
    if (strlen($description) > 100) {
        return "• Description maximum length is 100 characters.";
    }

    return null;
}

function validateInvitationCode(string $invitation_code): ?string
{
    $trimmed = trim($invitation_code);

    if ($trimmed == "") {
        return "• Invitation Code can't be empty.";
    }

    if (strlen($trimmed) > 16) {
        return "• Invitation Code maximum length is 16 characters.";
    }

    return null;
}
?>