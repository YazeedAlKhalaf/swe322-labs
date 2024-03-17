<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

function get_pizza_prize($size)
{
    if ($size == "small") {
        return 10;
    } else if ($size == "medium") {
        return 15;
    } else if ($size == "large") {
        return 20;
    }
}

$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];
$address = $_REQUEST['address'];
$food = $_REQUEST['food'];
$pizza_size = $_REQUEST['pizza-size'];
$toppings = $_REQUEST['toppings'];
$quantity = $_REQUEST['quantity'];
$delivery = $_REQUEST['delivery'];

$total = 0;

if ($food == "pizza") {
    $price = get_pizza_prize($pizza_size);
    $total = $price * $quantity;
} else if ($food == "burger" or $food == "pasta") {
    $total = 15 * $quantity;
}

if ($toppings == "cheese") {
    $toppings_price = 3 * $quantity;
    $total = $total + $toppings_price;
}

if ($toppings == "pepperoni") {
    $toppings_price = 2 * $quantity;
    $total = $total + $toppings_price;
}

if ($toppings == "mushrooms") {
    $toppings_price = 4 * $quantity;
    $total = $total + $toppings_price;
}

$values = array(
    "Name" => $name,
    "Email" => $email,
    "Phone" => $phone,
    "Address" => $address,
    "hr1" => "hr",
    "Food" => $food,
    "Pizza Size" => $pizza_size,
    "Extra Toppings" => $toppings,
    "Quantity" => $quantity,
    "hr2" => "hr",
    "Delivery" => $delivery == "on" ? "Yes" : "No",
    "Total" => "$" . $total,
);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q1: Order Food Online</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-row items-center justify-center min-h-screen">
    <div class="w-96 bg-orange-200 p-4">
        <h3 class="text-center text-2xl font-bold mb-4">Order Summary</h3>
        <div>
            <?php
            foreach ($values as $field_name => $value) {
                if ($value === "hr")
                    echo "<hr>";
                else if (gettype($value) === "array") {
                    $result = join(", ", $value);
                    echo "<p class=\"my-2\"><b>$field_name:</b> $result</p>";
                } else
                    echo "<p class=\"my-2\"><b>$field_name:</b> $value</p>";
            }
            ?>
        </div>
    </div>
</body>

</html>