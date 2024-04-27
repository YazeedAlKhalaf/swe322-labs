<?php
require_once './lib/store/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userStore->createUser("username", "password");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <h1>Register</h1>
</body>

</html>