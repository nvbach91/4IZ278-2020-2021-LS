<?php

/**
 * @var array $people
 */
require __DIR__ . "/people.php";

$contact = $people[array_rand($people)];

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>Vizitka</title>
</head>
<body class="bg-gradient-to-r from-green-100 to-blue-500">
<div class="container mx-auto">
    <div class="relative w-1/2">
        <div class="absolute inset-0 bg-gray-300 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
        <div class="absolute inset-0 bg-gray-100 shadow-lg transform skew-y-6 sm:skew-y-0 sm:rotate-6 sm:rounded-3xl"></div>
        <div class="relative shadow-xl rounded-3xl my-20 p-10 bg-white w-full">
            <div class="flex flex-row items-stretch">
                <div>
                    <div class="bg-blue-100 rounded-full">
                        <img src="<?= $contact->avatar ?>" alt="Avatar" class="w-64 rounded-full">
                    </div>
                </div>
                <div class="border-l px-10 ml-5">
                    <h1 class="text-4xl font-bold"><?= $contact->name ?> <?= $contact->surname ?></h1>
                    <p class="text-xl pt-3 text-gray-500"><?= $contact->birth->diff(new DateTime())->y ?> let</p>
                    <p class="text-2xl pt-7 text-gray-500 uppercase font-bold"><?= $contact->job ?></p>
                    <p class="text-lg text-gray-400 uppercase font-bold"><?= $contact->company ?></p>
                    <?php if ($contact->availableForHire):  ?>
                        <hr class="my-3">
                        <p class="font-bold text-green-700">
                            Available for hire
                        </p>
                    <?php endif; ?>
                    <hr class="my-3">
                    <div class="py-3">
                        <p class="text-lg"><?= $contact->address->street ?> <?= $contact->address->streetNumber ?></p>
                        <p class="text-xl font-bold"><?= $contact->address->city ?></p>
                    </div>
                    <hr class="my-3">
                    <div class="py-3">
                        <p class="text-xl font-bold"><?= $contact->phone ?></p>
                        <a class="text-xl text-blue-500 block"
                           href="mailto:<?= $contact->email ?>"><?= $contact->email ?></a>
                        <a class="text-xl text-blue-500 block"
                           href="<?= $contact->website ?>"><?= $contact->website ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>


