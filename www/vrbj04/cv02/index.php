<?php

require __DIR__ . '/Person.php';

$people = [
    new Person(
        "http://placekitten.com/g/300/300",
        "John",
        "Doe",
        new DateTime("2001-12-12"),
        "Professional retard",
        "Some big and serious company",
        "Wall street",
        "420/69",
        "New York",
        "+420 666 888 999",
        "john@doe.cz",
        "https://johndoe.cz",
        true
    ),
    new Person(
        "http://placekitten.com/g/301/301",
        "Jane",
        "Hoe",
        new DateTime("1979-8-10"),
        "Full-time procrastinator",
        "Another top 500 fortune company",
        "Elm street",
        "666",
        "Springwood",
        "+420 666 666 666",
        "jane@hoe.xxx",
        "https://janehoe.xxx",
        false
    )
];

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>Vizitky</title>
</head>
<body class="bg-white">
<header class="m-10">
    <h1 class="text-4xl font-bold">Vizitky OOP</h1>
</header>
<main class="container mx-auto my-20">
    <div class="grid grid-cols-2 gap-3">
        <?php foreach ($people as $person): ?>
            <div class="bg-gray-100 p-20 rounded-xl shadow h-96 mb-10">
                <div class="flex items-start">
                    <img src="<?= $person->avatar ?>" alt="<?= $person->getFullName() ?>'s avatar" class="w-24 rounded-full">
                    <div class="ml-10">
                        <h1 class="text-4xl uppercase font-bold text-indigo-800"><?= $person->getFullName() ?></h1>
                        <h2 class="text-2xl text-indigo-500 uppercase font-bold"><?= $person->company ?></h2>
                        <h2 class="text-lg text-indigo-400 uppercase font-bold"><?= $person->job ?></h2>

                        <div class="my-10 border-b-2 border-indigo-300"></div>

                        <p class="text-indigo-500 uppercase font-bold"><?= $person->getAge() ?> let <span class="text-gray-400">&mdash; <?= $person->birth->format("d. m. Y") ?></span></p>
                    </div>
                </div>

            </div>
            <div class="bg-gray-100 p-20 rounded-xl shadow h-96">
                <h1 class="text-4xl uppercase font-bold text-gray-500"><?= $person->getFullName() ?></h1>

                <div class="my-5 border-b border-gray-300"></div>

                <h2 class="text-gray-400 font-bold uppercase"><?= $person->getAddress() ?></h2>
                <h2 class="text-gray-400 font-bold"><?= $person->phone ?></h2>
                <h2 class="text-gray-400 font-bold"><?= $person->email ?></h2>


                <?php if ($person->availableForHire): ?>
                    <div class="my-5 border-b border-gray-300"></div>
                    <h2 class="text-green-600 font-bold">Available for contracts</h2>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</main>
</body>
</html>
