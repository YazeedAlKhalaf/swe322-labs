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
    <title>Array Manipulation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-4">
    <h1 class="text-2xl font-bold text-center mb-4">Array Manipulation</h1>

    <div class="flex flex-row flex-wrap gap-4 justify-center items-start">
        <?php
        $numbers = array(10, 40, 50, 100, 80, 90, 30, 60);

        $array_sum = 0;
        foreach ($numbers as $n) {
            $array_sum += $n;
        }

        $array_average = $array_sum / count($numbers);
        $sorted_array_asc = insertionSort($numbers, true);
        $sorted_array_desc = insertionSort($numbers, false);
        $reversed_array = array_reverse($numbers);

        $data = [
            'Original Array' => $numbers,
            'Array Sum' => $array_sum,
            'Array Average' => $array_average,
            'Sorted Array Asc' => $sorted_array_asc,
            'Sorted Array Desc' => $sorted_array_desc,
            'Reversed Array' => $reversed_array,
        ];

        foreach ($data as $title => $value) {
            echo "<div class='bg-gray-100 p-4 rounded shadow'>";
            echo "<h2 class='font-semibold'>$title:</h2>";
            echo "<pre>" . print_r($value, true) . "</pre>";
            echo "</div>";
        }
        ?>
    </div>
</body>

</html>