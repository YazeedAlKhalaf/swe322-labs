<?php

declare(strict_types=1);

function insertionSort(array $array, bool $isAsc = true): array
{
    for ($x = 1; $x < count($array); $x++) {
        $key = $array[$x];
        $j = $x - 1;
        while ($j >= 0 and ($isAsc ? $key < $array[$j] : $key > $array[$j])) {
            $array[$j + 1] = $array[$j];
            $j -= 1;
        }
        $array[$j + 1] = $key;
    }

    return $array;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question 4</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <h1 class="text-2xl font-bold">Array Manipulation</h1>
    <br />

    <?php
    $numbers = array(10, 40, 50, 100, 80, 90, 30, 60);

    $array_sum = 0;
    foreach ($numbers as $n) {
        $array_sum += $n;
    }

    $array_average = $array_sum / count($numbers);
    $sorted_array_asc = insertionSort($numbers, true);
    $sorted_array_desc = insertionSort($numbers, false);;
    $reversed_array = array_reverse($numbers);

    echo "<hr/>";

    echo "<h2>Original Array: <pre>";
    print_r($numbers);
    echo "</pre></h2>";

    echo "<hr/>";

    echo "<h2>Array Sum: <pre>";
    print_r($array_sum);
    echo "</pre></h2>";

    echo "<hr/>";

    echo "<h2>Array Average: <pre>";
    print_r($array_average);
    echo "</pre></h2>";

    echo "<hr/>";

    echo "<h2>Sorted Array Asc: <pre>";
    print_r($sorted_array_asc);
    echo "</pre></h2>";

    echo "<hr/>";

    echo "<h2>Sorted Array Desc: <pre>";
    print_r($sorted_array_desc);
    echo "</pre></h2>";

    echo "<hr/>";

    echo "<h2>Revered Array: <pre>";
    print_r($reversed_array);
    echo "</pre></h2>";

    echo "<hr/>";
    ?>
</body>

</html>