@extends('layouts.app')

@section('content')
    <div class="box-border  w-4/6 p-4 border-4 m-auto mt-6 min-h-[80vh]">
        @include('components.navbar')

        <!--main-->
        <div class="flex flex-wrap justify-evenly">
            <div class="box-border  w-full p-4 border-4 m-6">
                <div class="w-full">
                    <p>{{ $book->title }}</p>
                    <img src={{ asset('images/book.jpg') }} style="width:100%;" alt="">
                </div>

                <div class="w-full mt-[20px]">
                    <select class="js-example-basic-multiple" name="authors[]" multiple="multiple" disabled="disabled">
                        @foreach ($book->authors as $author)
                            <option value="{{ $author->id }}" selected>{{ $author->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-row mt-[7px] ">
                    <div class="basis-1/6">
                        <a href="#"onclick="event.preventDefault(); document.getElementById('form-edit{{ $book->id }}').submit();"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                            <img class="min-w-[25px] min-h-[25px]" src="{{ asset('images/edit.png') }}" alt="">
                        </a>
                        <form id="form-edit{{ $book->id }}" action="{{ route('book.edit', $book) }}" method="GET">
                            @csrf
                            <input type="submit" class="btn-action btn-edit" value=" ">
                        </form>
                    </div>
                    <div class="basis-1/6">
                        <a href="#"onclick="if(confirm('Are you sure?')){event.preventDefault(); document.getElementById('form-remove{{ $book->id }}').submit();}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                            <img class="min-w-[25px] min-h-[25px]" src="{{ asset('images/delete.png') }}" alt="">
                        </a>
                        <form id="form-remove{{ $book->id }}" action="{{ route('book.destroy', $book) }}"
                            method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
