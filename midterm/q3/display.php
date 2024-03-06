<?php require 'insurance_options.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$selected_insurance_options = array();
$total_cost = 0;
foreach ($insurance_options as $option => $price) {
    if (isset($_REQUEST["$option"])) {
        $selected_insurance_options["$option"] = $price;
        $total_cost = $total_cost + $price;
    }
}
$start_date = $_REQUEST["start_date"];
$email = $_REQUEST["email"];
$phone = $_REQUEST["phone"];
$address = $_REQUEST["address"];

$values = array(
    "Start Date of Insurance" => $start_date,
    "Email" => $email,
    "Phone" => $phone,
    "Address" => $address,
    "Total Cost" => $total_cost,
);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q3: Insurance Information</title>

    <link rel="stylesheet" href="../shared.css">
</head>
<body>
    <h3 style="color: red;">Insurance Information</h3>

    <div>
        
    <p>Insurance Options:</p>
        <ul>
            <?php
            foreach ($selected_insurance_options as $option => $price) {
                echo "<li>$option</li>";
            }
            ?>
        </ul>

        <?php
        foreach ($values as $field_name => $value) {
            echo "<p>$field_name: $value</p>";
        }
        ?>
    </div>

    <h3 style="color: red;">Thank you for shopping with us.</h3>
</body>
</html>
