<?php
require_once './db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["delete_customer"])) {
        $customer_id = $_POST["customer_id"];

        $sql = "DELETE FROM customer WHERE id = $customer_id";

        if ($conn->query($sql) === TRUE) {
            echo "Customer deleted successfully";
        } else {
            echo "Error deleting customer: " . $conn->error;
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Customer Result</title>
</head>

<body>
</body>

</html>