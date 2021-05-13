<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neo-Nasa</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900">
    <header class="text-center pb-10 pt-20 bg-gradient-to-b from-green-900 via-gray-900 to-gray-900">
        <h1 class="text-white font-bold text-6xl">Neo NASA</h1>

        <div class="mt-10">
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank"
             class="w-1/3 flex flex-col items-start mx-auto rounded text-left px-5 py-2 bg-white hover:bg-gray-400">
                <div class="flex flex-row items-center">
                    <div class="w-2 h-2 bg-red-500 rounded-full inline-block mr-2"></div>
                    <span class="text-xs uppercase text-red-500 font-bold">Watch live</span><br>
                </div>
                <div class="text-black mt-1 text-xl">
                    Landing of Rover 6 on Uranus
                </div>
            </a>
        </div>

        <div class="flex flex-row align-center justify-center my-10 py-8 bg-gray-800 text-xl uppercase font-bold text-green-500 transition">
            <a href="{{ route('galaxies.index') }}" class="hover:text-white focus:text-white">Galaxies</a>
            <div class="mx-10"></div>
            <a href="{{ route('space-stations.index') }}" class="hover:text-white focus:text-white">Space stations</a>
        </div>
    </header>
    @yield("content") 
</body>
</html>