<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question 2</title>
</head>

<body>
    <p>Create a PHP code that uses a for loop to iterate over an array of numbers. Double each
        element in the array and store the result in a new array.</p>

    <?php
    $numbers = array(2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22, 24, 26, 28, 30);

    $doubleNumbers = array();
    for ($x = 0; $x < count($numbers); $x++) {
        array_push($doubleNumbers, $numbers[$x] * 2);
    }
    unset($x);

    for ($x = 0; $x < count($numbers); $x++) {
        echo "<p>$numbers[$x] => $doubleNumbers[$x]</p>";
    }
    ?>
</body>

</html>