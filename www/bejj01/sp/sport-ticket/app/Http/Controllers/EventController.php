<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Sport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isNull;

/**
 * Class EventController - handles event related actions
 * @package App\Http\Controllers
 */
class EventController extends Controller {
    /**
     * Show events
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        $events = Event::where('start_date', '>=', Carbon::today())->paginate(6);
        $sports = Sport::all();
        return view('pages.events.events-offer', ['events' => $events, 'sports' => $sports]);
    }

    /**
     * Get data sorted and ordered by some criteria
     * @param Request $request
     * @return string
     */
    public function fetchData(Request $request) {
//        $sort_by = $request->get('by');
//        $order = $request->get('order');
//        $events = Event::query()->orderBy($sort_by, $order)->paginate(6);
//        return view('components.events-group', ['events' => $events])->render();

        $sort_by = $request->get('by');
        $order = $request->get('order');
        $filterValue = strtolower($request->get('filter'));
        if ($filterValue == 'all') {
            $events = Event::query()->orderBy($sort_by, $order)->paginate(6);
        }
        else if ($filterValue == 'favorites') {
            $user = User::find(auth()->user()->user_id);
            $favoriteSports = $user->favoriteSports();
            $ids = [];
            foreach ($favoriteSports as $favorite) {
                array_push($ids, $favorite->sport_id);
            }

            $events = Event::query()->whereIn('sport_id', $ids)->orderBy($sort_by, $order)->get();
        }
        else {
            $events = Event::where('sport_id', $filterValue)->orderBy($sort_by, $order)->get();
        }

        return view('components.events-group', ['events' => $events])->render();
    }

    /**
     * Shows event detail
     * @param $id - id of event
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showDetail($id) {
        $event = Event::find($id);
        return view('pages.events.event-detail', ['event' => $event]);
    }

    /**
     * Handles deleting event
     * @param $id - id of event to delete
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteEvent($id) {
        $event = Event::find($id);
        $event->delete();
        return redirect()->route('events');
    }

    /**
     * Show create event page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createEvent() {
        return view('pages.events.event-create');
    }

    /**
     * Handles creating new event
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doCreate(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'start' => 'required|date',
            'end' => 'date',
            'img' => 'required',
            'price' => 'required|numeric',
            'comp' => 'max:255',
            'cap' => 'required|integer|min:1|max:1000',
            'sport' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $name = $request->post('name');
        $start = $request->post('start');
        $end = $request->post('end');
        $img = $request->post('img');
        $price = $request->post('price');
        $comp = $request->post('comp');
        $cap = $request->post('cap');
        $sport_name = strtolower($request->post('sport'));
        $desc = $request->post('desc');

        $sport = Sport::where('sport_name', $sport_name)->first();
        if (isNull($sport)) {
            $sport = Sport::create(['sport_name' => $sport_name, 'img' => 'https://images.unsplash.com/photo-1543351611-58f69d7c1781?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mzl8fHNvY2NlcnxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60']);
        }

        $new = [
            'event_name' => $name,
            'start_date' => $start,
            'img' => $img,
            'price' => $price,
            'capacity' => $cap,
            'sport_id' => $sport->sport_id
        ];

        if (!isNull($end) && strtotime($end) > strtotime($start)) {
            $new['end_date'] = $end;
        }

        !isNull($comp) && $new['competition'] = $comp;
        !isNull($desc) && $new['description'] = $desc;

        try {
            Event::create($new);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'The event was not created! Try it again.')->withInput();
        }

        return redirect()->back()->with('success', 'The event was successfully created')->withInput();
    }

    /**
     * Show edit page
     * @param $id - id of event
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editEvent($id) {
        $event = Event::find($id);
        return view('pages.events.event-edit', ['event' => $event]);
    }

    /**
     * Handles editing values of event
     * @param $id - id of event
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doEdit($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'img' => 'required',
            'price' => 'required|numeric',
            'comp' => 'max:255',
            'cap' => 'required|integer|min:1|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $name = $request->post('name');
        $img = $request->post('img');
        $price = $request->post('price');
        $comp = $request->post('comp');
        $cap = $request->post('cap');
        $desc = $request->post('desc');

        $updated = [
            'name' => $name,
            'img' => $img,
            'price' => $price,
            'capacity' => $cap,
        ];

        !isNull($comp) && $updated['competition'] = $comp;
        !isNull($desc) && $updated['description'] = $desc;

        try {
            $event = Event::find($id);
            $event->update($updated);
            $event->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'The update has failed! Try it again.')->withInput();
        }

        return redirect()->back()->with('success', 'The record was successfully updated')->withInput();
    }
}
