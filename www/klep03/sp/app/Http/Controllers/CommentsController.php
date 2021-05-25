<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
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

    public function renderComments($song_id)
    {
        $topLevelComments = $this->getTopLevelComments($song_id);
        $usersController = new UsersController;

        $result = null;

        foreach ($topLevelComments as $topLevelComment) {
            $author = $usersController->getById($topLevelComment->author)->name;
            $time = $topLevelComment->date_posted;

            $result = "$result<div class=\"commentDiv\">";
            $result = "$result<h4>$author<span class=\"time\"> – $time</span></h4>";
            $result = "$result<p>$topLevelComment->content</p>";
            $result = $result . $this->findResponses($topLevelComment->id);
            $result = "$result</div>";
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

    public function findResponses($comment_id)
    {
        $responses = DB::table('comments')
            ->where('response_to', '=', $comment_id)
            ->get();

        $result = null;

        if (count($responses) > 0) {
            $usersController = new UsersController;
            foreach ($responses as $response) {
                $author = $usersController->getById($response->author)->name;
                $time   = $response->date_posted;

                $result = "$result<div class=\"commentResponseDiv\">";
                $result = "$result<h4>$author<span class=\"time\"> – $time</span></h4>";
                $result = "$result<p>$response->content</p>";
                $result = "$result" . $this->findResponses($response->id);
                $result = "$result</div>";
            }
        }
        return $result;
    }

    public function createNew($song)
    {
    }
}
