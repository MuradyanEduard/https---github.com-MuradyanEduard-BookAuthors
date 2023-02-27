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


@if (auth('web')->user()->role == App\Models\User::ROLE_CUSTOMER)
    <div id="basket-container">
        <button id="basket-button" type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            <i class="fa fa-shopping-cart m-auto" aria-hidden="true"></i>
        </button>
        <div id="basket-window">
            <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Your Basket:</h2>

            @if (session('basket'))
                <ul>
                    @foreach (session('basket') as $book)
                        <li>
                            <span class="font-semibold text-gray-900 dark:text-white">Book: {{ $book['title'] }}</span>
                        </li>
                        <li>
                            <span class="font-semibold text-gray-900 dark:text-white">Count:{{ $book['count'] }}</span>
                        </li>
                        <li>
                            <span class="font-semibold text-gray-900 dark:text-white">Price:{{ $book['price'] }}</span>
                        </li>
                        <a href="#"
                            onclick="event.preventDefault(); document.getElementById('form-remove11{{ $book['id'] }}').submit()"
                            class="m-1 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Remove
                            <i class="fa fa-trash w-4 h-4 ml-2 -mr-1" aria-hidden="true"></i>

                            <form id="form-remove11{{ $book['id'] }}" action="{{ route('order.remove') }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="id" value={{ $book['id'] }}>
                            </form>
                        </a>
                    @endforeach
                </ul>
            @endif

            <div class="">
                <button type="button" onclick="event.preventDefault(); document.getElementById('form-buy').submit()"
                    class="buy-button text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Buy<i class="fa fa-shopping-cart ml-3 w-4 h-4 m-auto" aria-hidden="true"></i></button>
                <form id="form-buy" action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                </form>

            </div>
        </div>
    </div>
@endif
