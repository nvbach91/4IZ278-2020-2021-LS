@extends("layout.app")

@section("content")
    <h1 class="title">Edit a collection</h1>

    <div class="mt-10">
        <form action="{{ route("collections.update", $collection) }}" method="post" class="form w-1/2">
            @csrf
            @method("put")
            <div class="mb-5 flex flex-col">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="{{ old("title", $collection->title) }}" required class="input">
            </div>

            <div class="mb-5 flex flex-col">
                <label for="description">Description <span class="label__meta">(optional)</span></label>
                <textarea type="text" id="description" name="description" class="input">{{ old("description", $collection->description) }}</textarea>
            </div>

            <div class="mb-5 flex flex-col">
                <label for="is_public">Visibility</label>
                <select name="is_public" id="is_public" class="input">
                    <option value="1" @if($collection->is_public) selected @endif>Public</option>
                    <option value="0" @unless($collection->is_public) selected @endif>Private</option>
                </select>
            </div>

            <div>
                <button class="button">Update collection</button>
            </div>
        </form>
    </div>
@endsection
