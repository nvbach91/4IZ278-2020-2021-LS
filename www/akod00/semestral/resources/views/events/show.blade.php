@extends('layouts.eventLayout')

@section('title')
    {{ $event->title }}
@endsection

@section('eventName')
    <h3>
        @yield('title')
    </h3>
@endsection

@section('contentSub')
    <a href="/dashboard">Back</a>
@endsection

@section('contentDesc')
    {{ $event->description }}
@endsection

@section('contentEvent')
    <script>
        function ts(cb) {
            if (cb.readOnly)
                cb.checked = cb.readOnly = false;
            else if (!cb.checked)
                cb.readOnly = cb.indeterminate = true;

            const state = cb.checked
                ? 1
                : cb.indeterminate
                    ? 0
                    : -1;
            const ids = cb.id.split("_");


            $.ajax({
                url: '/events/{{ $event->id }}/participate',
                type: 'POST',
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "state": state,
                    "participant_id": ids[0],
                    "date_id": ids[1]
                },
            });
        }
    </script>
    <div class="col pl-0">
        <div class="card">
            <div class="card-header">
                <h3>Select dates</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Participant</th>
                        @foreach($dates as $date)
                            <th class="text-center">
                                {{ str_replace("-", "/", explode(" ", $date->datetime)[0]) }}
                                <br>
                                {{ explode(" ", $date->datetime)[1] }}
                            </th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($participants->groupBy('name') as $key => $participantGroup)
                        <tr>
                            <td class="row">{{ $key }}</td>
                            @foreach(from($dates)->groupJoin($participantGroup, function ($d) { return $d->id; }, function ($p) { return $p->date_id; })->toArrayDeep() as $date)
                                <td class="text-center">
                                    <input type="checkbox" id="{{ $participantGroup[0]->user_id }}_{{ $date[0]->id }}" onclick="ts(this)" {{ $user !== $participantGroup[0]->user_id ? "disabled" : "" }} />
                                    @if (isset($date[1][0]->state))
                                        <script>
                                            @if ($date[1][0]->state === 0)
                                            $("#{{ $participantGroup[0]->user_id }}_{{ $date[0]->id }}").prop("indeterminate", true).submit();
                                            @elseif ($date[1][0]->state === 1)
                                            $("#{{ $participantGroup[0]->user_id }}_{{ $date[0]->id }}").prop("checked", true).submit();
                                            @endif
                                        </script>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
