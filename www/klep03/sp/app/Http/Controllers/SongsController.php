<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;

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
        return Song::query()->where("id", $id)->get();
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

    private function searchByQueryWord($word){
        return Song::query()
            ->where('artist', 'LIKE', "%{$word}%")
            ->orWhere('name', 'LIKE', "%{$word}%")
            ->get();
        // return Song::query()->get();
    }

    private function transformNestedArrays($nestedArray) {
        foreach ($nestedArray as $array) {}
    }

    public function searchByQuery($query)
    {
        $queryWords = explode(' ', $query);
        $results = [];
        foreach($queryWords as $queryWord) {
            $foundSongs = $this->searchByQueryWord($queryWord);
            foreach ($foundSongs as $song) {
                if(!in_array($song, $results)){
                    array_push($results, $song);
                }
            }
        }
        // $results = array_uni
        return $results;
    }

    
}
