@extends('layouts.app')

@section('content')
    <div class="m-auto max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        @if (session()->has('message'))
            <div class="p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <span class="font-medium"> {{ session()->get('message') }} </span>
            </div>
        @endif
        <a href="#">
            <img class="rounded-t-lg" src="{{ asset('images/author.jpeg') }}" alt="" />
        </a>
        <div class="p-5">
            <form id="form-create" action="{{ route('author.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Author
                        name</label>
                    <input type="text" id="title" name="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Author" required>
                </div>

                @error('name')
                    <div class="mb-3 bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative"
                        role="alert">
                        {{ $message }}
                    </div>
                @enderror

                <h2 class="mb-3 text-lg font-semibold text-gray-900 dark:text-white">Books:</h2>
                <select class="js-example-basic-multiple" name="books[]" multiple="multiple">
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}">{{ $book->name }}</option>
                    @endforeach
                </select>

                @error('books')
                    <div class="mb-3 bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative"
                        role="alert">
                        {{ $message }}
                    </div>
                @enderror

                <a href="#" onclick="event.preventDefault(); document.getElementById('form-create').submit();"
                    class="mt-3 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Create
                    <i class="fa fa-plus w-4 h-4 ml-2 -mr-1"></i>
                    <input type="submit" value=" ">
                </a>
            </form>

        </div>
    </div>
@endsection
