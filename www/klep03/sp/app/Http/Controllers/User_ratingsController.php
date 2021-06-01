<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class User_ratingsController extends Controller
{
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

    public function rate($song_id, Request $request) {
        // $user_ratingsController = new User_ratingsController;
    
        if (null !== $request->input('rating')) {
            $rating = $request->input('rating');
            $this->writeRating($song_id, $rating);
        }
        return redirect('/songs/' . $song_id);
    }

}
