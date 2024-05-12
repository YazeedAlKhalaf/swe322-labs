<?php
require_once './db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $phoneNumber = $_POST['phone_number'];
    $email = $_POST['email'];

    $sql = "INSERT INTO guest (first_name, last_name, dob, gender, address, phone_number, email)
            VALUES ('$firstName', '$lastName', '$dob', '$gender', '$address', '$phoneNumber', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "Guest information inserted successfully!<br><br>";
        echo "<a href='/'>Go Back to Home</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    header("Location: /");
    exit();
}

$conn->close();
