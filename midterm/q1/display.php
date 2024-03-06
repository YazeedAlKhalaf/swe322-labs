<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.html");
    exit;
}

$name = $_REQUEST["name"];
$age = $_REQUEST["age"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q1: User Information</title>

    <link rel="stylesheet" href="../shared.css">
</head>
<body>
    <h1 style="text-decoration-line: underline;">User Information</h1>

    <?php
    echo "<p>Dear <b>$name</b>, you are <b>$age</b> years old.</p>";
    ?>
</body>
</html>