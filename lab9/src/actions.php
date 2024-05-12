<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actions of Hotel Management</title>

    <style>
        table,
        tr,
        td,
        th {
            border: 1px solid black;
            background-color: lightgreen;
            color: blue;
        }
    </style>
</head>

<body>
    <?php
    require_once './db.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['display_guests'])) {
            $sql = "SELECT * FROM guest";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Date of Birth</th><th>Gender</th><th>Address</th><th>Phone Number</th><th>Email</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["first_name"] . "</td>";
                    echo "<td>" . $row["last_name"] . "</td>";
                    echo "<td>" . $row["dob"] . "</td>";
                    echo "<td>" . $row["gender"] . "</td>";
                    echo "<td>" . $row["address"] . "</td>";
                    echo "<td>" . $row["phone_number"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No guests found.";
            }
        } elseif (isset($_POST['delete_booking'])) {
            $bookingId = $_POST['booking_id'];

            $sql = "DELETE FROM booking WHERE id = $bookingId";

            if ($conn->query($sql) === TRUE) {
                echo "Booking deleted successfully.";
            } else {
                echo "Error deleting booking: " . $conn->error;
            }
        }
    } else {
        header("Location: /");
        exit();
    }

    $conn->close();
    ?>


</body>

</html>