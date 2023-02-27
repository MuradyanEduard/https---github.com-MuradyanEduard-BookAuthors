@extends('layouts.app')

@section('content')
    <div class="m-auto max-w-[80%] bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <!--main-->
        <div class="flex flex-wrap justify-start">
            @foreach ($books as $book)
                @include('components.bookinfo')
            @endforeach
        </div>
        <div class="w-full h-[80px] m-auto flex justify-center">
            <div class="pagination-block">
                {{ $books->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
@endsection


<div id="basket-container">
    <button id="basket-button" type="button"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
        <i class="fa fa-shopping-cart m-auto" aria-hidden="true"></i>
    </button>
    <div id="basket-window">
        <h2>Your Basket</h2>
        <ul>
            @foreach ($books as $book)
                @if (session('_book' . $book->id))
                    <li> {{ session('_book' . $book->id) }} </li>
                    <li> {{ $book->price }} </li>
                @endif
            @endforeach
        </ul>
        <button type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            <i class="fa fa-plus w-4 h-4 m-auto" aria-hidden="true"></i>

    </div>
</div>
