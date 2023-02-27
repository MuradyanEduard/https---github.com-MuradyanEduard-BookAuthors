@extends('layouts.app')

@section('content')
    <div class="m-auto max-w-[80%] bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <!--main-->
        <div class="p-10">

            @foreach ($orders as $order)
                <div class="m-auto mb-10 w-[50%]">
                    <h5 class="mb-2 text-xl font-bold dark:text-white">Author: <span class="ml-2">
                            {{ $order->author->name }}</span></h5>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Title
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Count
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->books as $book)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">
                                        {{ $book->title }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $order->orders_books->count }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $book->price }}
                                    </td>
                            @endforeach
                            </tr>
                        </tbody>
                    </table>

                    <h5 class="mt-2 text-right text-xl font-bold dark:text-white">Total Price: <span class="ml-2">
                            {{ $order->price }}</span></h5>

                </div>
            @endforeach
        </div>

        <div class="w-full h-[80px] m-auto flex justify-center">
            <div class="pagination-block">
                {{ $orders->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
@endsection
