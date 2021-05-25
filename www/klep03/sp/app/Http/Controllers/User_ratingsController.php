<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class User_ratingsController extends Controller
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
        //
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

    public function averageRating($song_id)
    {
        if ($this->countRatings($song_id) > 0) {
            $ratings = DB::table('user_ratings')
                ->where('song', $song_id)
                ->avg('stars');
        } else {
            $ratings = 0;
        }

        $ratings = round($ratings, 1);

        return $ratings;
    }

    public function countRatings($song_id)
    {
        return DB::table('user_ratings')
            ->where('song', $song_id)
            ->count();
    }

    public function ratingsForSong($song_id)
    {
        return [
            'average'   => $this->averageRating($song_id),
            'count'     => $this->countRatings($song_id),
        ];
    }

    public function writeRating($song_id, $rating)
    {
        $user_id = session('user_id');
        $specificRatings = $this->findSpecificRating($song_id, $user_id);
        if(count($specificRatings) > 0) {
            $this->updateRating($specificRatings[0]->id, $rating);
        } else {
            $this->createRating($song_id, $user_id, $rating);
        }
    }

    public function findSpecificRating($song_id, $user_id)
    {
        return DB::table('user_ratings')
            ->where('song', $song_id)
            ->where('user', $user_id)
            ->get();
    }

    function getRatingById($id)
    {
        return DB::table('user_ratings')->find($id);
    }

    function updateRating($id, $rating) {
        DB::table('user_ratings')
            ->where('id', $id)
            ->update([
                'stars' => $rating,
            ]);
    }

    function createRating($song_id, $user_id, $rating) {
        DB::table('user_ratings')->insert([
            'stars'     => $rating,
            'user'      => $user_id,
            'song'      => $song_id,
        ]); 
    }
}
