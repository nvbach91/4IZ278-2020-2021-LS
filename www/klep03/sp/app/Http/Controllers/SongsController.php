<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use Illuminate\Support\Facades\DB;

class SongsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DB::table('songs')->find($id);;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function searchByQueryWord($word)
    {
        return Song::query()
            ->where('artist', 'LIKE', "%{$word}%")
            ->orWhere('name', 'LIKE', "%{$word}%")
            ->get();
        // return Song::query()->get();
    }

    private function transformNestedArrays($nestedArray)
    {
        foreach ($nestedArray as $array) {
        }
    }

    public function searchByQuery($query)
    {
        $queryWords = explode(' ', $query);
        $results = [];
        foreach ($queryWords as $queryWord) {
            $foundSongs = $this->searchByQueryWord($queryWord);
            foreach ($foundSongs as $song) {
                if (!in_array($song, $results)) {
                    array_push($results, $song);
                }
            }
        }
        // $results = array_uni
        return $results;
    }

    public function searchByUserId($id)
    {
        return DB::table('songs')->where('created_by', $id)->get();
    }

    public function createNew()
    {
        $usersController = new UsersController;
        if ($usersController->isLoggedIn()) {
            DB::table('songs')->insert([
                'name'              => 'default Name',
                'lyrics_w_chords'   => 'default Lyri',
                'artist'            => 'default Artist',
                'difficulty'        => 'easy',
                'created_by'        => session('user_id'),
                'style'             => 1,
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);

            $newRecord = DB::table('songs')
                ->where('created_by', '=', session('user_id'))
                ->where('name', '=', 'default Name')
                ->whereRaw('created_at = updated_at')
                ->first();

            return redirect('/songs/' . $newRecord->id . '/edit');
        } else {
            return redirect('/signin');
        }
    }

    public function delete($song_id)
    {
        $song = DB::table('songs')->find($song_id);

        // echo $song->created_by;
        // echo session('user_id');
        if ($song->created_by == session('user_id')) {
            DB::table('songs')->delete($song_id);
            return redirect('/createdByMe');
        } else {
            return redirect('/songs/' . $song_id);
        }
    }
}
