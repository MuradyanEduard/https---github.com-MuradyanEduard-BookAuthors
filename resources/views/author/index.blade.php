@extends('layouts.app')

@section('content')
    <div class="m-5 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <!--main-->
        <div class="flex flex-wrap justify-start">
            @foreach ($authors as $author)
                @include('components.authorinfo')
            @endforeach
        </div>
    </div>
@endsection
