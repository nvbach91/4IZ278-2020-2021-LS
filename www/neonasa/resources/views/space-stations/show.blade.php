@extends("layout.master")
@section("content")

<div class="flex flex-row justify-start align-start w-1/2 mx-auto">

  <div class="flex flex-col">
    <h1 class="text-4xl text-white font-bold">{{ $station->name }}</h1>
    <img src="<?= $station->img ?>" class="w-96 h-96 rounded-xl mt-5 border-2 border-white">
  </div>

  <div class="flex flex-col align-end flex-grow ml-10 mt-16">
    <h1 class="text-1xl text-gray-500 font-bold uppercase tracking-wide mb-3">Galaxy</h1>
    <div class="mb-5 text-gray-400 font-mono">{{ $station->galaxy->name }}</div>

    <h1 class="text-1xl text-gray-500 font-bold uppercase tracking-wide mb-3">GPS</h1>
    <div class="mb-5 text-gray-400 font-mono">{{ $station->gps }}</div>
  </ul>

</div>
@endsection