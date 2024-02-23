<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$fname = $_REQUEST["fname"];
$lname = $_REQUEST["lname"];
$email = $_REQUEST["email"];
$check_in_date = $_REQUEST["check_in_date"];
$check_out_date = $_REQUEST["check_out_date"];
$room_type = $_REQUEST["room_type"];
$preferred_food_type = $_REQUEST["preferred_food_type"];

$confirmatin_number = rand(100000, 999999);

$values = array(
    "Name" => $fname . " " . $lname,
    "Email" => $email,
    "Check-in Date" => $check_in_date,
    "Check-out Date" => $check_out_date,
    "Room Type" => $room_type,
    "Preferred Food Type" => $preferred_food_type,
    "Confirmation Number" => $confirmatin_number,
);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q2: Reservation Information</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="m-auto max-w-[48rem]">
    <h1 class="font-bold text-3xl my-8">Reservation Information</h1>

    <div class="flex flex-col gap-3">
        <?php
        foreach ($values as $field => $value) {
            echo "<p><span class=\"text-red-500 font-bold\">$field:</span> $value</p>";
        }
        ?>
    </div>
</body>

</html>