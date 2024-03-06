<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.html");
    exit;
}

$name = $_REQUEST["name"];
$snumber = $_REQUEST["snumber"];
$gpa = $_REQUEST["gpa"];

$values = array(
    "Name" => $name,
    "Student Number" => $snumber,
    "GPA (out of 100)" => $gpa,
    "Letter Grade" => get_letter_grade($gpa),
);

function get_letter_grade(int $mark) : string {
    $mark_mapping = array(
        90 => "A",
        80 => "B",
        70 => "C",
        60 => "D",
        0 => "F",
    );

    foreach ($mark_mapping as $min_mark => $letter_grade) {
        if ($mark >= $min_mark) {
            return $letter_grade;
        }
    }

    return $mark_mapping[0];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q2: Student Information</title>

    <link rel="stylesheet" href="../shared.css">

    <style>
        .orange-bordered-box {
            border: 5px solid orange;
            padding: 1rem;
            max-width: fit-content;
        }
    </style>
</head>
<body>
    <h1 style="text-decoration-line: underline;">Student Information</h1>

    <div class="orange-bordered-box">
        <?php
        foreach ($values as $field_name => $value) {
            echo "<p>$field_name: $value</p>";
        }
        ?>
    </div>
</body>
</html>
