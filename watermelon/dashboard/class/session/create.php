<?php
ob_start(); // Start output buffering
require_once '../../../lib/helpers/auth_helper.php';
startSecureSession();

redirectToLoginIfNotAuthenticated();
redirectToDashboardIfNotTeacher();

$loggedInSessionData = getLoggedInSessionData();

require_once '../../../lib/store/db.php';
require_once '../../../lib/services/TeacherService.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: /dashboard");
    exit;
}

$teacherService = new TeacherService($classStore, $sessionStore, $userStore);

$class_id = trim($_POST["class_id"]);

// start time is now and end time is start time pllus 10 minutes
$start_time = new DateTime();
$end_time = new DateTime();
$end_time->add(new DateInterval('PT10M'));

try {
    $created_session = $teacherService->createSession($class_id, $start_time, $end_time, "the class itself");

    header("Location: /dashboard/class/session?id=" . $created_session->id);
} catch (TeacherServiceException $e) {
    if ($e->getCode() === TeacherServiceException::FAILED_TO_CREATE_SESSION) {
        $errorMessage .= ($errorMessage ? "<br />" : "") . "• Failed to create session.";
    }
} catch (Exception $e) {
    $errorMessage .= ($errorMessage ? "<br />" : "") . "• An error occurred while creating a session for you. Please try again later.";
    error_log("Error creating a session: " . $e->getMessage());
}
