<?php

// This makes sure the user doesn't access the page directly, but only through the form.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$dob = $_REQUEST['dob'];
$grade_level = $_REQUEST['grade_level'];
$needs_transportation = $_REQUEST['needs_transportation'];
$guardian_name = $_REQUEST['guardian_name'];
$address = $_REQUEST['address'];
$phone = $_REQUEST['phone'];

$values = array(
    "Name" => $name,
    "Email" => $email,
    "Date of Birth" => $dob,
    "Grade Level" => $grade_level,
    "Needs Transportation" => $needs_transportation,
    "Guardian Name" => $guardian_name,
    "Address" => $address,
    "Phone" => $phone,
);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q1: Submitted Student Information</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="m-auto max-w-[48rem]">
    <h1 class="font-bold text-3xl my-8">Submitted Student Information</h1>

    <table class="border border-blue-500 border-collapse bg-gray-200 w-full">
        <thead>
            <th class="border border-blue-500 border-collapse p-2 text-start">Field</th>
            <th class="border border-blue-500 border-collapse p-2 text-start">Value</th>
        </thead>
        <tbody>
            <?php
            foreach ($values as $field => $value) {
                echo "
<tr class=\"border border-blue-500 border-collapse\">
    <td class=\"border border-blue-500 border-collapse p-2\">$field</td>
    <td class=\"border border-blue-500 border-collapse p-2\">$value</td>
</tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>