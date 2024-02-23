<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q2: Hotel Room Booking</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="m-auto max-w-[48rem]">
    <h1 class="font-bold text-3xl my-8">Hotel Room Booking</h1>

    <form action="result.php" method="post" class="flex flex-col gap-2">
        <div class="flex flex-col gap-1">
            <label for="fname">First Name:</label>
            <input type="text" name="fname" id="fname" class="border-2 border-gray-500 rounded-md p-1" required>
        </div>

        <div class="flex flex-col gap-1">
            <label for="lname">Last Name:</label>
            <input type="text" name="lname" id="lname" class="border-2 border-gray-500 rounded-md p-1" required>
        </div>

        <div class="flex flex-col gap-1">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="border-2 border-gray-500 rounded-md p-1" required>
        </div>

        <div class="flex flex-col gap-1">
            <label for="check_in_date">Check-in Date:</label>
            <input type="date" name="check_in_date" id="check_in_date" class="border-2 border-gray-500 rounded-md p-1" required>
        </div>

        <div class="flex flex-col gap-1">
            <label for="check_out_date">Check-out Date:</label>
            <input type="date" name="check_out_date" id="check_out_date" class="border-2 border-gray-500 rounded-md p-1" required>
        </div>

        <div class="flex flex-col gap-1">
            <label for="room_type">Room Type:</label>
            <select id="room_type" name="room_type" class="border-2 border-gray-500 rounded-md p-1" required>
                <option value="default" selected disabled>Select Room Type</option>
                <option value="single">Single</option>
                <option value="double">Double</option>
                <option value="suite">Suite</option>
            </select>
        </div>

        <div class="flex flex-col gap-1">
            <label for="preferred_food_type">Preferred Food Type:</label>
            <input type="text" name="preferred_food_type" id="preferred_food_type" class="border-2 border-gray-500 rounded-md p-1" required>
        </div>

        <button type="submit" class="bg-green-500 text-white p-2 rounded-md mt-4">Submit</button>
    </form>
</body>

</html>