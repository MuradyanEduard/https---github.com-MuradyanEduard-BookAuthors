<div class="m-5 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <a href="#">
        <img class="rounded-t-lg" src="{{ asset('images/author.jpeg') }}" alt="" />
    </a>
    <div class="p-5">
        <a href="#">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Author: {{ $author->name }}
            </h5>
        </a>
        <h2 class="mb-3 text-lg font-semibold text-gray-900 dark:text-white">Books:</h2>
        <ol class="mb-3 max-w-md space-y-1 text-gray-500 list-decimal list-inside dark:text-gray-400">
            @foreach ($author->books as $book)
                <li>
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $book->title }} </span>
                </li>
            @endforeach
        </ol>

        <a href="{{ route('author.show', $author) }}"
            class="m-1 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Show
            <i class="fa fa-eye w-4 h-4 ml-2 -mr-1" aria-hidden="true"></i>
        </a>

        <a href="{{ route('author.edit', $author) }}"
            class="m-1 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Edit
            <i class="fa fa-edit w-4 h-4 ml-2 -mr-1"></i>
        </a>

        <a href="#"
            onclick="if(confirm('Are you sure?')){event.preventDefault(); document.getElementById('form-remove{{ $author->id }}').submit();}"
            class="m-1 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Remove
            <i class="fa fa-trash w-4 h-4 ml-2 -mr-1" aria-hidden="true"></i>

            <form id="form-remove{{ $author->id }}" action="{{ route('author.destroy', $author) }}" method="POST"
                onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
            </form>
        </a>

    </div>
</div>
