<?php
require_once 'lib/store/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userStore->createUser("username", "password");
}
