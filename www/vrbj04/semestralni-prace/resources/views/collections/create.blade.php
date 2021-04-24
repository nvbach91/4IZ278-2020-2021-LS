@extends("layout.app")

@section("content")
    <h1 class="title">Create a new collection</h1>

    <div class="mt-10">
        <form action="{{ route("collections.store") }}" method="post" class="form w-1/2">
            @csrf
            <div class="mb-5 flex flex-col">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="{{ old("title") }}" required class="input">
            </div>

            <div class="mb-5 flex flex-col">
                <label for="description">Description <span class="label__meta">(optional)</span></label>
                <textarea type="text" id="description" name="description" class="input">{{ old("description") }}</textarea>
            </div>

            <div class="mb-5 flex flex-col">
                <label for="is_public">Visibility</label>
                <select name="is_public" id="is_public" class="input">
                    <option value="1">Public</option>
                    <option value="0">Private</option>
                </select>
            </div>

            <div>
                <button class="button">Create collection</button>
            </div>
        </form>
    </div>
@endsection
