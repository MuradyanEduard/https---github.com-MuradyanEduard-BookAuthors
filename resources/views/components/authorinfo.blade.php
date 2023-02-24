<div class="w-full">
    <p>{{ $author->title }}</p>
    <img src={{ asset('images/author.jpeg') }} style="width:100%;" alt="">
</div>

<div class="w-full mt-[20px]">
    <select class="js-example-basic-multiple" name="books[]" multiple="multiple" disabled>
        @foreach ($author->books as $book)
            <option value="{{ $book->id }}" selected>{{ $book->title }}</option>
        @endforeach
    </select>
</div>

<div class="flex flex-row mt-[7px] ">
    <div class="basis-1/5">
        <a href="#"onclick="event.preventDefault(); document.getElementById('form-search{{ $author->id }}').submit();"
            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
            <img class="min-w-[25px] min-h-[25px]" src="{{ asset('images/search.png') }}" alt="">
        </a>
        <form id="form-search{{ $author->id }}" action="{{ route('author.show', $author) }}" method="GET">
            @csrf
            <input type="submit" class="btn-action btn-search" value=" ">
        </form>
    </div>
    <div class="basis-1/5">
        <a href="#"onclick="event.preventDefault(); document.getElementById('form-edit{{ $author->id }}').submit();"
            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
            <img class="min-w-[25px] min-h-[25px]" src="{{ asset('images/edit.png') }}" alt="">
        </a>
        <form id="form-edit{{ $author->id }}" action="{{ route('author.edit', $author) }}" method="GET">
            @csrf
            <input type="submit" class="btn-action btn-edit" value=" ">
        </form>
    </div>
    <div class="basis-1/5">
        <a href="#"onclick="if(confirm('Are you sure?')){event.preventDefault(); document.getElementById('form-remove{{ $author->id }}').submit();}"
            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
            <img class="min-w-[25px] min-h-[25px]" src="{{ asset('images/delete.png') }}" alt="">
        </a>
        <form id="form-remove{{ $author->id }}" action="{{ route('author.destroy', $author) }}" method="POST"
            onsubmit="return confirm('Are you sure?')">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>
