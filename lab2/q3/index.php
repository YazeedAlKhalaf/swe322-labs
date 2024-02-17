<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question 3</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <main class="max-w-[30rem] m-auto">
        <h1 class="text-2xl font-bold">Student Details</h1>
        <table class="border border-slate-500 border-collapse table-auto w-full">
            <thead>
                <tr>
                    <th class="border border-slate-500 px-2 py-1 text-start w-2/5">Field</th>
                    <th class="border border-slate-500 px-2 py-1 text-start">Value</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $student = array("Name" => "John Doe", "Age" => 20, "Address" => "USA", "Major" => "Computer Science", "Phone Number" => "(613) 799-4328", "Email" => "jdoe@sun.edu", "GPA" => "A");

                foreach ($student as $field => $value) {
                    echo "
<tr>
    <td class=\"border border-slate-500 border-collapse px-2 py-1\">$field</td>            
    <td class=\"border border-slate-500 border-collapse px-2 py-1\">$value</td>            
</tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
</body>

</html>