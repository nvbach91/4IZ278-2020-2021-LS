@extends("layout.master")
@section("content")
  <div class="mx-20">
    <div class="grid grid-cols-4 grid-flow-row gap-4">
        @foreach($stations as $station)
        <div class="bg-gray-800 rounded-xl hover:bg-green-900">
          <a href="{{ route('space-stations.show', $station) }}" class="flex flex-col w-full h-64 rounded-xl">

            <div style="background-image: url('{{ $station->img }}'); background-size: cover; background-position: center center;" class="h-64 rounded-xl m-3"></div>

            <div class="ml-5 mb-5 font-bold text-white text-lg">{{ $station->name }}</div>
          </a>
        </div>
        @endforeach
    </div>
  </div>
@endsection