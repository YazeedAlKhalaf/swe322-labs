<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q3: Insurance Form</title>

    <link rel="stylesheet" href="../shared.css">
    <style>
        .flex-col {
            display: flex;
            flex-direction: column;
            max-width: fit-content;
        }
    </style>
</head>

<body>
    <h1 style="text-decoration-line: underline;">Insurance Form</h1>

    <form action="display.php" method="post" class="spaced-form">
        <div>
            <p>Insurance Options:</p>
            <?php require 'insurance_options.php';
            foreach ($insurance_options as $option => $price) {
                echo "<div>";
                echo "<input type=\"checkbox\" id=\"$option\" name=\"$option\" value=\"$option\" />";
                echo "<label for=\"$option\">$option ($price)</label>";
                echo "</div>";
            }
            ?>
        </div>

        <div class="flex-col">
            <label for="start_date">Start Date of Insurance:</label>
            <input type="date" id="start_date" name="start_date" required />
        </div>

        <div class="flex-col">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required />
        </div>

        <div class="flex-col">
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" required />
        </div>

        <div class="flex-col">
            <label for="address">Address:</label>
            <textarea name="address" id="address" cols="30" rows="10"></textarea>
        </div>

        <div>
            <button type="submit">PROCEED</button>
        </div>
    </form>
</body>

</html>