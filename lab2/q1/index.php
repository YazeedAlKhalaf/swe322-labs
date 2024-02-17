<?php
$response = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["temp"]) && !empty($_POST["temp"])) {
        $temp = $_POST["temp"];

        if ($temp >= 20 && $temp <= 30) {
            $response = "<p style=\"color: green;\">The temperature $temp is comfortable.</p>";
        } else {
            $response = "<p style=\"color: red;\">The temperature $temp is not comfortable.</p>";
        }
    } else {
        $response = "<p style=\"color: red;\">Please enter a temperature.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question 1</title>
</head>

<body>
    <form method="POST">
        <label for="temp">Temperature:</label>
        <input id="temp" type="number" name="temp">

        <input type="submit" value="Submit">
    </form>

    <?php
    if (!empty($response)) {
        echo $response;
    }
    ?>
</body>

</html>