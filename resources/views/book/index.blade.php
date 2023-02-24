@extends('layouts.app')

@section('content')
    <div class="m-auto max-w-[80%] bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <!--main-->
        <div class="flex flex-wrap justify-start">
            @foreach ($books as $book)
                @include('components.bookinfo')
            @endforeach
        </div>
    </div>
@endsection
