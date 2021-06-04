<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Http\Requests\FlashcardCollection\CreateFlashcardCollectionRequest;
use App\Models\FlashcardCollection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class FlashcardCollectionController extends Controller
{
    private const COLLECTIONS_PER_PAGE = 3;

    public function __construct()
    {
        $this->middleware(Authenticate::class);
    }

    public function index(): Response
    {
        $owned = $this->user()
            ->collections()
            ->with(["user", "flashcards"])
            ->paginate(self::COLLECTIONS_PER_PAGE, ['*'], 'owned')
            ->withQueryString();

        $public = FlashcardCollection::public($this->user()->id)
            ->with(["user", "flashcards"])
            ->paginate(self::COLLECTIONS_PER_PAGE, ['*'], 'public')
            ->withQueryString();

        return response()->view("collections.index", [
            "owned" => $owned,
            "public" => $public
        ]);
    }

    public function show(FlashcardCollection $collection): Response
    {
        $this->authorize("view", $collection);

        $flashcards = $collection->flashcards;

        return response()->view("collections.show", [
            "collection" => $collection,
            "flashcard" => $flashcards
        ]);
    }

    public function create(): Response
    {
        return response()->view("collections.create");
    }

    public function store(CreateFlashcardCollectionRequest $request): RedirectResponse
    {
        $collection = $this->user()->collections()->create([
            "title" => $request->input("title"),
            "description" => $request->input("description"),
            "is_public" => $request->input("is_public")
        ]);

        $collection->save();

        return redirect()->route("collections.show", $collection->id);
    }

    public function edit(FlashcardCollection $collection): Response
    {
        $this->authorize("update", $collection);

        return response()->view("collections.edit", ["collection" => $collection]);
    }

    public function update(FlashcardCollection $collection, CreateFlashcardCollectionRequest $request): RedirectResponse
    {
        $this->authorize("update", $collection);

        $collection->update($request->only(["title", "description", "is_public"]));

        return redirect()->route("collections.show", $collection);
    }

    public function destroy(FlashcardCollection $collection): RedirectResponse
    {
        $this->authorize("delete", $collection);

        $collection->flashcards()->delete();
        $collection->delete();

        return redirect()->route("collections.index");
    }
}
