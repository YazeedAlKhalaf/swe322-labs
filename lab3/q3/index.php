<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q3: Adma's Shopping Store</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>


<body class="m-auto max-w-[48rem]">
    <h1 class="font-bold text-3xl my-8">Adma's Shopping Store</h1>

    <form action="result.php" method="post" class="flex flex-col gap-2">
        <div class="flex flex-col gap-1">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="border-2 border-gray-500 rounded-md p-1" required>
        </div>

        <div class="flex flex-col gap-1">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="border-2 border-gray-500 rounded-md p-1" required>
        </div>

        <div class="flex flex-col gap-1">
            <label for="shipping_address">Shipping Address:</label>
            <textarea rows="5" name="shipping_address" id="shipping_address" class="border-2 border-gray-500 rounded-md p-1" required>
            </textarea>
        </div>

        <div class="flex flex-col gap-1">
            <label for="clothes_type">Select Clothes Type:</label>
            <select name="clothes_type" id="clothes_type" class="border-2 border-gray-500 rounded-md p-1" required>
                <option value="default" selected disabled>Select Clothes Type</option>
                <?php require 'clothes_price.php';
                foreach ($clothes_price as $clothes_price => $price) {
                    echo "<option value=\"$clothes\">$clothes \$$price</option>";
                }
                ?>
            </select>
        </div>

        <div class="flex flex-col gap-1">
            <label for="size">Select Size:</label>
            <select name="size" id="size" class="border-2 border-gray-500 rounded-md p-1" required>
                <option value="default" selected disabled>Select Size</option>
                <option value="small">Small</option>
                <option value="medium">Medium</option>
                <option value="large">Large</option>
                <option value="XL">XL</option>
            </select>
        </div>

        <div class="flex flex-col gap-1">
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" class="border-2 border-gray-500 rounded-md p-1" required>
        </div>

        <button type="submit" class="bg-green-500 text-white p-2 rounded-md mt-4">Purchase</button>
    </form>
</body>

</html>