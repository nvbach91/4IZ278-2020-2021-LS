<div class="d-flex justify-content-center mb-3">
    {{ $events->links() }}
</div>

<div class="d-flex flex-wrap justify-content-center mb-3 mt-2">
    @foreach($events as $event)
        @include('components.event')
    @endforeach
</div>

<div class="d-flex justify-content-center mb-3">
    {{ $events->links() }}
</div>
