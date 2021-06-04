<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlashcardQuestion\CreateFlashcardQuestionRequest;
use App\Models\Flashcard;
use App\Models\FlashcardCollection;
use App\Models\FlashcardQuestion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class FlashcardQuestionController extends Controller
{
    public function create(FlashcardCollection $collection, Flashcard $flashcard): Response
    {
        $this->authorize("update", $collection);

        return response()->view("questions.create", [
            "collection" => $collection,
            "flashcard" => $flashcard
        ]);
    }

    public function store(FlashcardCollection $collection, Flashcard $flashcard, CreateFlashcardQuestionRequest $request): RedirectResponse
    {
        $this->authorize("update", $collection);

        $question = $flashcard->questions()->create([
            "question" => $request->input("question"),
            "answer" => $request->input("answer"),
            "link_to_external_resource" => $request->input("link_to_external_resource")
        ]);

        $question->save();

        if ($request->has("another")) {
            return redirect()->route("collections.flashcards.questions.create", [$collection, $flashcard]);
        }

        return redirect()->route("collections.flashcards.show", [$collection, $flashcard]);
    }

    public function edit(FlashcardCollection $collection, Flashcard $flashcard, FlashcardQuestion $question): Response
    {
        $this->authorize("update", $collection);

        return response()->view("questions.edit", [
            "collection" => $collection,
            "flashcard" => $flashcard,
            "question" => $question
        ]);
    }

    public function update(
        FlashcardCollection $collection,
        Flashcard $flashcard,
        FlashcardQuestion $question,
        CreateFlashcardQuestionRequest $request
    )
    {
        $this->authorize("update", $collection);

        $question->update($request->only("answer", "question", "link_to_external_resource"));

        return redirect()->route("collections.flashcards.show", [$collection, $flashcard]);
    }

    public function destroy(FlashcardCollection $collection, Flashcard $flashcard, FlashcardQuestion $question) {
        $this->authorize("delete", $collection);

        $question->delete();

        return redirect()->route("collections.flashcards.show", [$collection, $flashcard]);
    }
}
