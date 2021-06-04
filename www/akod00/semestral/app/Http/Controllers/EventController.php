<?php

    namespace App\Http\Controllers;

    use App\Models\Date;
    use App\Models\Event;
    use App\Models\EventParticipant;
    use App\Models\ParticipantAvailable;
    use DateTime;
    use Exception;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;

    class EventController extends Controller
    {
        public function create(): Response
        {
            return response()->view('events.create');
        }

        public function join(Request $request)
        {
            $id = $request->input('code');
            $userId = $this->getUser()->id;

            if (Event::where('id', $id)->first() === null) {
                return redirect("/dashboard");
            }

            if (EventParticipant::where("participant_id", $userId)->where("event_id", $id)->first() === null) {
                EventParticipant::create([
                    "participant_id" => $userId,
                    "event_id" => $id
                ]);
            }

            return redirect("/events/" . $id);
        }

        /**
         * @throws Exception
         */
        public function store(Request $request)
        {
            $eventId = $this->newGuid();
            $userId = $this->getUser()->id;
            $image = $request->input('image');

            if (isset($image) && $image !== '' && (!filter_var($image, FILTER_VALIDATE_URL) || !preg_match("/^(.*)\.(jpg|png|svg|bmp)$/i", $image))) {
                return redirect("/events/create");
            }

            Event::create([
                'id' => $eventId,
                'owner_id' => $userId,
                'length' => $request->input('length'),
                'title' => $request->input('title'),
                'image' => $image ?? "",
                'description' => $request->input('description') ?? ""
            ])->save();
            EventParticipant::create([
                "participant_id" => $userId,
                "event_id" => $eventId
            ])->save();

            $dates = json_decode($request->input('dates'));
            foreach ($dates as $date) {
                Date::create([
                    "event_id" => $eventId,
                    "datetime" => new DateTime($date->date . " " . $date->time)
                ])->save();
            }

            return redirect("/dashboard");
        }

        private function newGuid(): string
        {
            return vsprintf('%s%s-%s-4000-8%.3s-%s%s%s0', str_split(dechex(microtime(true) * 1000) . bin2hex(random_bytes(8)), 4));
        }

        public function edit(string $id)
        {
            $event = Event::where("id", $id)->first();
            if ($event === null) {
                abort(404);
            }
            if ($event->owner_id !== $this->getUser()->id) {
                abort(403);
            }

            $dates = Date::where("event_id", $id)->get();

            return view('events.edit')->with([
                'event' => $event,
                'dates' => $dates,
            ]);
        }

        /**
         * @throws Exception
         */
        public function update(Request $request, string $eventId)
        {
            $image = $request->input('image');

            if (isset($image) && $image !== '' && (!filter_var($image, FILTER_VALIDATE_URL) || !preg_match("/^(.*)\.(jpg|png|svg|bmp)$/i", $image))) {
                return redirect("/events/" . $eventId . "/edit");
            }

            Event::where('id', $eventId)
                ->update([
                    'title' => $request->input('title'),
                    'length' => $request->input('length'),
                    'image' => $image ?? "",
                    'description' => $request->input('description') ?? ""
                ]);

            $dates = json_decode($request->input('dates'));
            $existingDates = Date::where("event_id", $eventId)->pluck("id");
            $datesToDelete = from($existingDates)
                ->except(from($dates)
                    ->select(function ($x) {
                        return $x->dbId;
                    })
                    ->where(function (string $x) {
                        return $x !== "";
                    }))
                ->toArrayDeep();
            $datesToAdd = from($dates)
                ->where(function ($x) {
                    return $x->dbId === "";
                })
                ->toArrayDeep();

            foreach ($datesToDelete as $date) {
                Date::where("id", $date)->first()->delete();
            }

            foreach ($datesToAdd as $date) {
                Date::create([
                    "event_id" => $eventId,
                    "datetime" => new DateTime($date->date . " " . $date->time)
                ])->save();
            }

            return redirect('/dashboard');
        }

        public function destroy(string $id)
        {
            $event = Event::where("id", $id)->first();
            if ($event !== null && $event->owner_id === $this->getUser()->id) {
                $event->delete();
            }

            return redirect('/dashboard');
        }

        public function leave(string $id)
        {
            EventParticipant::where("event_id", $id)->where("participant_id", $this->getUser()->id)->first()->delete();
            $dates = Date::where("event_id", $id)->select("id")->get();
            ParticipantAvailable::whereIn("date_id", $dates)->where("participant_id", $this->getUser()->id)->delete();

            return redirect('/dashboard');
        }

        public function show(string $id)
        {
            if (!EventParticipant::where("event_id", $id)
                ->where("participant_id", $this->getUser()->id)
                ->exists()) {
                abort(403, 'Unauthorized action.');
            }

            $event = Event::where('id', $id)->first();
            $dates = Date::where("event_id", $id)->get();
            $participants = EventParticipant::where("event_id", $id)
                ->leftJoin("participant_availables", "participant_availables.participant_id", "=", "event_participants.participant_id")
                ->leftJoin("users", "users.id", "=", "event_participants.participant_id")
                ->orderBy("users.id")
                ->select("users.name AS name", "users.id AS user_id", "participant_availables.state AS state", "participant_availables.date_id AS date_id")
                ->get();

            return view('events.show')->with([
                "user" => $this->getUser()->id,
                "event" => $event,
                "dates" => $dates,
                "participants" => $participants
            ]);
        }

        public function participate(Request $request, string $eventId)
        {
            if ((int)$request->input("participant_id") !== $this->getUser()->id) {
                return redirect("/events/" . $eventId);
            }

            $existing = ParticipantAvailable::where("date_id", $request->input("date_id"))
                ->where("participant_id", $request->input("participant_id"))
                ->first();
            if (isset($existing)) {
                $existing->update([
                    "state" => $request->input("state")
                ]);
            } else {
                ParticipantAvailable::create([
                    "participant_id" => $request->input("participant_id"),
                    "date_id" => $request->input("date_id"),
                    "state" => $request->input("state")
                ])->save();
            }

            return redirect("/events/" . $eventId);
        }
    }
