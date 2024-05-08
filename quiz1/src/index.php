<?php
require_once './db.php';

$display_guests_query = "SELECT first_name, phone_number FROM guest";
$delete_single_rooms_query = "DELETE FROM room WHERE room_type = 'SINGLE'";
$display_bookings_query = "SELECT id, check_in_date FROM booking;";

$result_1 = $conn->query($display_guests_query);
$result_2 = $conn->query($delete_single_rooms_query);
$result_3 = $conn->query($display_bookings_query);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz 1 Preview</title>
</head>

<body>
    <h1>Quiz 2 Preview</h1>

    <h2>Delete single rooms Query</h2>
    <ol>
        <li>Did delete single rooms? <?php echo $result_2; ?></li>
    </ol>

    <h2>Guests Query</h2>
    <?php
    if ($result_1->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>First Name</th><th>Phone Number</th></tr>";
        while ($row = $result_1->fetch_assoc()) {
            echo "<tr><td>" . $row["first_name"] . "</td><td>" . $row["phone_number"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No guests found";
    }
    ?>

    <h2>Bookings Query</h2>

    <?php
    if ($result_3->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Check-in Date</th></tr>";
        while ($row = $result_3->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["check_in_date"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No guests found";
    }
    ?>
</body>

</html>