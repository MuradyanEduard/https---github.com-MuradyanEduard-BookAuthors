@extends('layouts.app')

@section('content')
    <div class="m-auto max-w-[80%] bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <!--main-->
        <div class="flex flex-wrap justify-start">
            @foreach ($authors as $author)
                @include('components.authorinfo')
            @endforeach
        </div>

        <div class="w-full h-[80px] m-auto flex justify-center">
            <div class="pagination-block">
                {{ $authors->links('pagination::tailwind') }}
            </div>
        </div>

    </div>
@endsection
