<?php
require_once './db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add_customer"])) {
        $customer_name = $_POST["customer_name"];
        $address = $_POST["address"];
        $salary = $_POST["salary"];

        $sql = "INSERT INTO customer (name, address, salary) VALUES ('$customer_name', '$address', '$salary')";

        if ($conn->query($sql) === TRUE) {
            echo "New customer added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST["display_customers"])) {
        $sql = "SELECT * FROM customer";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>Address</th><th>Salary</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["address"] . "</td><td>" . $row["salary"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No customers found";
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
    <title>Add/Display Customers</title>
</head>

<body>
</body>

</html>