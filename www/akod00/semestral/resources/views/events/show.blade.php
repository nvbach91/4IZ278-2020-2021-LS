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
    @if (isset($event->image) && strlen($event->image) > 0)
        <img src="{{ $event->image }}" alt="Event image" width="180"/>
        <br>
    @endif
    <em>
        Duration: {{ $event->length }} min
    </em>
    <br>

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
    <style>
        table td, table th {
            background-color: white;
        }

        table thead th {
            position: sticky;
            top: 0;
            z-index: 1;
        }

        table thead th:first-child {
            white-space: nowrap;
            position: sticky;
            left: 0;
            z-index: 2;
        }

        table tbody td:first-child {
            white-space: nowrap;
            position: sticky;
            left: 0;
            z-index: 2;
        }

    </style>
    <?php

    function getParticipantsHeading($participants): string
    {
        $count = $participants->groupBy('name')->count();
        $result = $count . " participant";
        if ($count > 1) {
            return $result . "s";
        }

        return $result;
    }

    ?>
    <div class="col-sm pl-0">
        <div class="card">
            <div class="card-header">
                <h3>Select dates</h3>
            </div>
            <div class="card-body">
                <div style="overflow-x: auto;">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ getParticipantsHeading($participants) }}</th>
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
                                <td>{{ $key }}</td>
                                @foreach(from($dates)->groupJoin($participantGroup, function ($d) { return $d->id; }, function ($p) { return $p->date_id; })->toArrayDeep() as $date)
                                    <td class="text-center">
                                        <input type="checkbox"
                                               id="{{ $participantGroup[0]->user_id }}_{{ $date[0]->id }}"
                                               onclick="ts(this)" {{ $user !== $participantGroup[0]->user_id ? "disabled" : "" }} />
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
    </div>
@endsection
