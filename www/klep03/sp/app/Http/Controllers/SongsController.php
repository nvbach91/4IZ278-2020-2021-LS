<?php

namespace App\Http\Controllers;

use App\Models\PageItems;
use Illuminate\Http\Request;
use App\Models\Song;
use Illuminate\Support\Facades\DB;

class SongsController extends Controller
{
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

    private function searchByQueryWord($word)
    {
        return Song::query()
            ->where('artist', 'LIKE', "%{$word}%")
            ->orWhere('name', 'LIKE', "%{$word}%")
            ->get();
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
        return $results;
    }

    public function searchByUserId($id)
    {
        return DB::table('songs')->where('created_by', $id)->get();
    }

    public function createNew()
    {
        $pageItems = new PageItems();
        $urlPrefix = $pageItems->getUrlPrefix();

        $usersController = new UsersController;
        if ($usersController->isLoggedIn()) {
            DB::table('songs')->insert([
                'name'              => 'default Name',
                'lyrics_w_chords'   => 'default Lyrics',
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

            return redirect($urlPrefix . '/songs/' . $newRecord->id . '/edit');
        } else {
            return redirect($urlPrefix . '/signin');
        }
    }

    public function delete($song_id)
    {
        $pageItems = new PageItems();
        $urlPrefix = $pageItems->getUrlPrefix();

        $song = DB::table('songs')->find($song_id);

        // echo $song->created_by;
        // echo session('user_id');
        if ($song->created_by == session('user_id')) {
            DB::table('songs')->delete($song_id);
            return redirect($urlPrefix . '/createdByMe');
        } else {
            return redirect($urlPrefix . '/songs/' . $song_id);
        }
    }

    public function getSongDetail($song_id, Request $request)
    {

        $songsController        = new SongsController;
        $song                   = $songsController->show($song_id);

        $pageItems              = new PageItems;
        $pageItems              = $pageItems->fetch();

        if (!$pageItems['anonymous']) {
            $savedSongsController = new SavedSongsController;
            $addedToSaved       = $savedSongsController->isAlreadySaved(session('user_id'), $song_id);
        } else {
            $addedToSaved       = false;
        }

        $user_ratingsController = new User_ratingsController;
        $ratings = $user_ratingsController->ratingsForSong($song_id);

        $commentsController     = new CommentsController;
        $comments               = $commentsController->renderComments($song_id);

        $responding             = $request->input('responding');
        if ($responding) {
            $responseTo         = $request->input('responseTo');
            $previousComment    = $commentsController->getById($responseTo);
            $response           = [
                'responding'    => $responding,
                'responseTo'    => $responseTo,
                'authorName'    => $request->input('previousAuthor'),
                'previousContent' => $previousComment->content,
            ];
        } else {
            $response           = [
                'responding'    => $responding,
            ];
        }

        return view('song')->with('song', $song)
            ->with('pageItems', $pageItems)
            ->with('addedToSaved', $addedToSaved)
            ->with('ratings', $ratings)
            ->with('commentsFormatted', $comments)
            ->with('response', $response)
            ->with('title', 'Song – ' . $song->name);
    }

    public function editSong($song_id)
    {
        $pageItems = new PageItems();
        $urlPrefix = $pageItems->getUrlPrefix();

        $songsController        = new SongsController;
        $song                   = $songsController->show($song_id);

        if ($song->created_by !== session('user_id')) {
            return redirect($urlPrefix . '/songs/$song_id');
        }

        $pageItems    = new PageItems;
        $pageItems              = $pageItems->fetch();

        return view('songEdit')
            ->with('song', $song)
            ->with('pageItems', $pageItems)
            ->with('title', 'Edit – ' . $song->name);
    }

    public function editSongDataFromForm($song_id, Request $request)
    {
        $pageItems = new PageItems();
        $urlPrefix = $pageItems->getUrlPrefix();

        $songsController        = new SongsController;
        $song                   = $songsController->show($song_id);

        if ($song->created_by !== session('user_id')) {
            return redirect($urlPrefix . '/songs/$song_id');
        }

        DB::table('songs')
            ->where('id', '=', $song_id)
            ->update([
                'name'              => $request->input('name'),
                'artist'            => $request->input('artist'),
                'lyrics_w_chords'   => $request->input('lyrics_w_chords'),
                'updated_at'        => now(),
            ]);

        return redirect($urlPrefix . '/createdByMe');
    }
}
