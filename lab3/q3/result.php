<?php require "clothes_price.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$name = $_REQUEST["name"];
$email = $_REQUEST["email"];
$shipping_address = $_REQUEST["shipping_address"];
$clothes_type = $_REQUEST["clothes_type"];
$size = $_REQUEST["size"];
$quantity = $_REQUEST["quantity"];

$total_price = $clothes_price[$clothes_type] * $quantity;
$confirmation_number = rand(100000, 999999);
$date_and_time = date("Y-M-d h:i:sa");

$values = array(
    "Name" => $name,
    "Email" => $email,
    "Shipping Address" => $shipping_address,
    "Clothes Type" => $clothes_type,
    "Size" => $size,
    "Quantity" => $quantity,
    "Total Price" => "\$" . $total_price,
    "Confirmation Number" => $confirmation_number,
    "Date and Time" => $date_and_time,
);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q3: Purchase Details</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="m-auto max-w-[48rem]">
    <div class="bg-green-200 p-4 mt-4 rounded-xl shadow-lg shadow-red-500">
        <h1 class="font-bold text-3xl mb-8 mt-4">Purchase Details</h1>

        <div class="flex flex-col gap-3">
            <?php
            foreach ($values as $field => $value) {
                echo "<p><span class=\"text-red-500 font-bold\">$field:</span> $value</p>";
            }
            ?>

            <p>Thank you for shopping with us!</p>
        </div>
    </div>
</body>

</html>