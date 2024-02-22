<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q1: Student Registration Form</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="m-auto max-w-[48rem]">
    <h1 class="font-bold text-3xl my-8">Student Registration Form</h1>

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
            <label for="dob">Date of Birth:</label>
            <input type="date" name="dob" id="dob" class="border-2 border-gray-500 rounded-md p-1" required>
        </div>

        <div class="flex flex-col gap-1">
            <label for="grade_level">Grade Level:</label>
            <select name="grade_level" id="grade_level" class="border-2 border-gray-500 rounded-md p-1" required>
                <option value="default" selected disabled>Select Grade</option>
                <option value="1">Grade 1</option>
                <option value="2">Grade 2</option>
                <option value="3">Grade 3</option>
                <option value="4">Grade 4</option>
                <option value="5">Grade 5</option>
                <option value="6">Grade 6</option>
            </select>
        </div>

        <div class="flex flex-col gap-1">
            <label for="needs_transportation">Needs School Transportation:</label>
            <div class="flex gap-2">
                <label for="needs_transportation_yes">
                    <input type="radio" name="needs_transportation" id="yes" value="yes" required>
                    Yes
                </label>
                <label for="needs_transportation_no">
                    <input type="radio" name="needs_transportation" id="no" value="no" required>
                    No
                </label>
            </div>
        </div>

        <div class="flex flex-col gap-1">
            <label for="guardian_name">Guardian Name:</label>
            <input type="text" name="guardian_name" id="guardian_name" class="border-2 border-gray-500 rounded-md p-1" required>
        </div>

        <div class="flex flex-col gap-1">
            <label for="address">Address:</label>
            <input type="text" name="address" id="address" class="border-2 border-gray-500 rounded-md p-1" required>
        </div>

        <div class="flex flex-col gap-1">
            <label for="phone">Phone:</label>
            <input type="tel" name="phone" id="phone" class="border-2 border-gray-500 rounded-md p-1" required>
        </div>

        <button type="submit" class="bg-green-500 text-white p-2 rounded-md mt-4">SEND APPLICATION</button>
    </form>
</body>

</html>