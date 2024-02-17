<?php
$response = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["sentence"]) && !empty(trim($_POST["sentence"]))) {
        $sentence = trim($_POST["sentence"]);

        $response = capitalize_sentence($sentence);
        if ($response == $sentence) {
            $response = $response . "<br /><br />" . "<p class=\"pl-4 border-l-4 border-gray-400 bg-gray-100 text-gray-700 italic\">We didn't do anything, your sentence is already capitalized. Please don't waste our resources :)</p>";
        }
    } else {
        $response = "<p class=\"text-red-500\">Please enter a sentence.</p>";
    }
}

function capitalize_sentence(string $sentence): string
{
    $capitalizedSentence = "";

    $words = explode(" ", $sentence);
    foreach ($words as $word) {
        $capitalizedSentence = $capitalizedSentence . ucfirst($word) . " ";
    }

    return trim($capitalizedSentence);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question 5</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-4">
    <h1 class="text-2xl font-bold text-center mb-4">Sentence Capitalizer</h1>
    <br />

    <div class="flex flex-col items-center max-w-96 m-auto">
        <form method="POST" class="w-full">
            <div>
                <label for="sentence" class="block text-gray-700 text-sm font-bold mb-2">Sentence:</label>
                <input type="text" name="sentence" id="sentence" class="shadow appearance-none border border-cyan-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="flex flex-row items-center justify-center">
                <input type="submit" value="Capitalize!" class="font-bold border border-cyan-500 rounded px-2 py-1 cursor-pointer hover:scale-105 transition-all" />
            </div>
        </form>

        <?php
        if (!empty($response)) {
            echo "
<div class=\"mt-4 p-4 w-full shadow appearance-none border border-cyan-500 rounded\">
    <p class=\"font-bold\">Result:</p>";
            echo "
    <p>$response</p>
</div>";
        }
        ?>
    </div>

</body>

</html>