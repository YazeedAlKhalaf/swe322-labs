<?php
require_once '../../../lib/helpers/auth_helper.php';
startSecureSession();

redirectToLoginIfNotAuthenticated();

$loggedInSessionData = getLoggedInSessionData();
?>

<?php
require_once '../../../lib/store/db.php';
require_once '../../../lib/services/TeacherService.php';
require_once '../../../lib/services/SharedService.php';

$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);

if (!isset($queries['id'])) {
    header('Location: /dashboard');
    exit;
}

$session_id = $queries['id'];

$sharedService = new SharedService($classStore, $userStore, $sessionStore);

$session = $sharedService->getSessionById($session_id);
if (!$session) {
    header('Location: /dashboard');
    exit;
}

if ($loggedInSessionData->accountType === AccountType::TEACHER) {
    $teacherService = new TeacherService($classStore, $sessionStore, $userStore);

    $students = $teacherService->getStudentsBySessionId($session_id);
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Enable/disable button based on checkbox state
            var attendMeCheckbox = document.getElementById('attend-me');
            var attendButton = document.getElementById('attend-button');

            attendMeCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    attendButton.disabled = false;
                } else {
                    attendButton.disabled = true;
                }
            });

            // Countdown timer
            var endDatetime = '<?php echo $session->end_datetime->format('Y-m-d\TH:i:s'); ?>'; // Ensure correct format
            var countDownDate = new Date(endDatetime + 'Z').getTime(); // Append 'Z' to indicate UTC timezone

            var x = setInterval(function() {
                var now = new Date().getTime();
                var distance = countDownDate - now;

                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                var countdownString = '';
                if (days > 0) {
                    countdownString += days + "d ";
                }
                if (hours > 0 || days > 0) {
                    countdownString += hours + "h ";
                }
                if (minutes > 0 || hours > 0 || days > 0) {
                    countdownString += minutes + "m ";
                }
                countdownString += seconds + "s ";

                document.getElementById("countdown").innerHTML = countdownString.trim();

                if (distance <= 0) { // Changed condition to include zero
                    clearInterval(x);
                    document.getElementById("countdown").innerHTML = "EXPIRED";
                    attendButton.disabled = true; // Disable attend button when time expires
                }
            }, 1000);
        });
    </script>
</head>

<body class="flex flex-col min-h-screen">
    <?php HeaderComponent() ?>
    <main class="flex-grow px-8 flex flex-col justify-center items-center">
        <?php if ($loggedInSessionData->accountType === AccountType::TEACHER) : ?>
            <h1 class="text-3xl font-bold mb-4">Scan the QR Code</h1>
            <?php
            $currentHost = $_SERVER['HTTP_HOST'];
            $currentScheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
            $url = "{$currentScheme}://{$currentHost}/dashboard/class/session?id=" . $session_id;
            ?>
            <img class="w-32 h-32 md:w-96 md:h-96" src="https://api.qrserver.com/v1/create-qr-code/?size=320x320&data=<?php echo urlencode($url); ?>" alt="QR Code" class="w-32 h-32" />

            <hr class="my-4 w-full" />

            <h3 class="text-lg font-medium text-center">Students:</h3>
            <ul>
                <?php foreach ($students as $student) : ?>
                    <li><?php echo $student->username; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if ($loggedInSessionData->accountType === AccountType::STUDENT) : ?>
            <h1 class="text-3xl font-bold mb-4">Session: <?php echo $session_id; ?></h1>
            <p id="countdown" class="text-xl font-semibold mb-4"></p>

            <form id="attend-form" action="/dashboard/class/session/attend.php" method="POST">
                <input type="hidden" name="session_id" value="<?php echo $session_id; ?>" />

                <input type="checkbox" id="attend-me" name="attend-me" class="mb-4">
                <label for="attend-me">I swear to Allah I am not cheating the system in any way</label>

                <div>
                    <button type="submit" id="attend-button" class="bg-green-500 hover:bg-green-600 disabled:bg-gray-500 text-white font-bold py-2 px-4 rounded w-full" disabled>Attend</button>
                </div>
            </form>
        <?php endif; ?>

    </main>
    <?php FooterComponent() ?>
</body>

</html>