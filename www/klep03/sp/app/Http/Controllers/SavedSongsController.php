<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SongsController;
use Illuminate\Support\Facades\DB;

class SavedSongsController extends Controller
{
    public function saveSong($song_id)
    {
        $user_id = session('user_id');
        if (!$this->isAlreadySaved($user_id, $song_id)) {
            $this->addRecord($user_id, $song_id);
        }
    }

    public function removeSong($song_id)
    {
        $user_id = session('user_id');
        if ($this->isAlreadySaved($user_id, $song_id)) {
            $this->removeRecord($user_id, $song_id);
        }
    }

    public function isAlreadySaved($user_id, $song_id)
    {
        $results = DB::table('user_saved_songs')
            ->where('user_id', $user_id)
            ->where('song_id', $song_id)
            ->get();
        if(count($results) > 0) {
            return true;
        } else {
            return false;
        }
            
    }

    function addRecord($user_id, $song_id)
    {
        DB::table('user_saved_songs')->insert(
            [
                'user_id' => $user_id,
                'song_id' => $song_id,
            ]
        );
    }

    function removeRecord($user_id, $song_id)
    {
        DB::table('user_saved_songs')
            ->where('user_id', '=', $user_id)
            ->where('song_id', '=', $song_id)
            ->delete();

    }

    public function getSongsFromUser($user_id) {
        return DB::table('user_saved_songs')
            ->where('user_id', '=', $user_id)
            ->get();
    }
}
