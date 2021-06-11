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
    public function index(Request $request) {
        $sort_by = $request->get('by') ? $request->get('by') : 'event_id';
        $order = $request->get('order') ? $request->get('order') : 'asc';
        $filterValue = $request->get('filter') ? $request->get('filter') : 'all';

        $events = $filterValue == 'all'
            ? Event::query()->where('start_date', '>=', Carbon::today())->orderBy($sort_by, $order)->paginate(6)
            : Event::where('start_date', '>=', Carbon::today())->where('sport_id', $filterValue)->orderBy($sort_by, $order)->paginate(6);
        $events->appends(['filter' => $filterValue, 'by' => $sort_by, 'order' => $order]);
        $sports = Sport::all();
        return view('pages.events.events-offer', ['events' => $events, 'sports' => $sports, 'filter' => $filterValue]);
    }

    /**
     * Get data sorted and ordered by some criteria
     * @param Request $request
     * @return string
     */
    public function fetchData(Request $request) {
        $sort_by = $request->get('by');
        $order = $request->get('order');
        $filterValue = $request->get('filter');
        if ($filterValue == 'all') {
            $events = Event::query()->where('start_date', '>=', Carbon::today())->orderBy($sort_by, $order)->paginate(6);
        }
        else if ($filterValue == 'favorites') {
            $favoriteSports = auth()->user()->favoriteSports;
            $ids = [];
            foreach ($favoriteSports as $favorite) {
                array_push($ids, $favorite->sport_id);
            }

            $events = Event::query()
                ->where('start_date', '>=', Carbon::today())
                ->whereIn('sport_id', $ids)
                ->orderBy($sort_by, $order)
                ->paginate(6);
        }
        else {
            $events = Event::where('start_date', '>=', Carbon::today())
                ->where('sport_id', $filterValue)
                ->orderBy($sort_by, $order)->paginate(6);
        }

        $events->appends(['filter' => $filterValue, 'by' => $sort_by, 'order' => $order]);

        return view('components.events-group', ['events' => $events])->render();
    }

    /**
     * Shows event detail
     * @param $id - id of event
     * @return mixed
     */
    public function showDetail($id) {
        $event = Event::find($id);
        return !$event
            ? redirect()->route('home')->with('error', 'Wrong action! Event was not found!')
            : view('pages.events.event-detail', ['event' => $event]);
    }

    /**
     * Handles deleting event
     * @param $id - id of event to delete
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteEvent($id) {
        $event = Event::find($id);
        if (!$event) {
            return redirect()->route('home')->with('error', 'Wrong action! Event was not found!');
        }

        $event->delete();
        return redirect()->route('events');
    }

    /**
     * Show create event page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createEvent() {
        $sports = Sport::all();
        return view('pages.events.event-create', ['sports' => $sports]);
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
            'end' => 'date|nullable',
            'img' => 'required',
            'price' => 'required|numeric',
            'comp' => 'max:255',
            'cap' => 'required|integer|min:1|max:1000',
            'sport' => 'required_without:new_sport',
            'new_sport' => 'required_without:sport',
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
        $sport_name = $request->post('sport');
        $new_sport_name = $request->post('new_sport');
        $new_sport_img = $request->post('new_sport_img');
        $desc = $request->post('desc');

        if (isset($end) && strtotime($end) < strtotime($start)) {
            return redirect()->back()->with('error', 'The event was not created! End date must be later or same date as start date.')->withInput();
        }

        if (isset($sport_name)) {
            $sport = Sport::where('sport_name', $sport_name)->first();
        }
        else {
            $sport = isset($new_sport_img)
                ? Sport::create(['sport_name' => $new_sport_name, 'img' => $new_sport_img])
                : Sport::create(['sport_name' => $new_sport_name, 'img' => 'https://images.unsplash.com/photo-1543351611-58f69d7c1781?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mzl8fHNvY2NlcnxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60']);
        }

        $new = [
            'event_name' => $name,
            'start_date' => $start,
            'img' => $img,
            'price' => $price,
            'capacity' => $cap,
            'sport_id' => $sport->sport_id
        ];

        isset($end) && $new['end_date'] = $end;
        isset($comp) && $new['competition'] = $comp;
        isset($desc) && $new['description'] = $desc;

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
     * @return mixed
     */
    public function editEvent($id) {
        $event = Event::find($id);

        return !$event
            ? redirect()->route('home')->with('error', 'Wrong action! Event was not found!')
            : view('pages.events.event-edit', ['event' => $event]);
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

        isset($comp) && $updated['competition'] = $comp;
        isset($desc) && $updated['description'] = $desc;

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
