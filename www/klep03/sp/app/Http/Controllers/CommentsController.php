<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    public function renderComments($song_id)
    {
        $topLevelComments   = $this->getTopLevelComments($song_id);
        $usersController    = new UsersController;

        $result             = null;

        foreach ($topLevelComments as $topLevelComment) {
            $authorObject   = $usersController->getById($topLevelComment->author);
            $author         = $authorObject->name;
            if($author == null) {
                $author     = $authorObject->email;
            }

            $time           = $topLevelComment->date_posted;

            $result         = "$result<div class=\"commentDiv\">";
            $result         = "$result<h4>$author<span class=\"time\"> – $time</span></h4>";
            $result         = "$result<p>$topLevelComment->content <a href=\"/songs/$song_id?responding=true&responseTo=$topLevelComment->id&previousAuthor=$author#newComment\"><strong>&#x21a9; Reply</strong></a></p>";
            /** Start of the recursion */
            $result         = $result . $this->findResponses($topLevelComment->id, $song_id);
            $result         = "$result</div>";
        }
        return $result;
    }

    public function getTopLevelComments($song_id)
    {
        return DB::table('comments')
            ->where('song', '=', $song_id)
            ->where('response_to', '=', null)
            ->get();
    }

    public function findResponses($comment_id, $song_id)
    {
        $responses          = DB::table('comments')
            ->where('response_to', '=', $comment_id)
            ->get();

        $result             = null;

        /** if no more responses, recursion ends here  */
        if (count($responses) > 0) {
            $usersController    = new UsersController;
            foreach ($responses as $response) {
                $authorObject   = $usersController->getById($response->author);
                $author         = $authorObject->name;
                if($author == null) {
                    $author     = $authorObject->email;
                }
                $time       = $response->date_posted;

                $result     = "$result<div class=\"commentResponseDiv\">";
                $result     = "$result<h4>$author<span class=\"time\"> – $time</span></h4>";
                $result     = "$result<p>$response->content <a href=\"/songs/$song_id/?responding=true&responseTo=$response->id&previousAuthor=$author#newComment\"><strong>&#x21a9; Reply</strong></a></p>";
                /** Here goes the recursion loop */
                $result     = "$result" . $this->findResponses($response->id, $song_id);
                $result     = "$result</div>";
            }
        }
        return $result;
    }

    public function createNew($song_id, Request $request)
    {
        $request->validate([
            'content'           => 'min:1'
        ]);

        if (null !== $request->input('responseTo')) {
            DB::table('comments')->insert([
                'date_posted'   => now(),
                'song'          => $song_id,
                'response_to'   => $request->input('responseTo'),
                'content'       => $request->input('content'),
                'author'        => session('user_id'),
            ]);
        } else {
            DB::table('comments')->insert([
                'date_posted'   => now(),
                'song'          => $song_id,
                'content'       => $request->input('content'),
                'author'        => session('user_id'),
            ]);
        }

        return redirect('/songs/' . $song_id . '#newComment');
    }

    public function getById($comment_id) {
        return DB::table('comments')->find($comment_id);
    }
}
