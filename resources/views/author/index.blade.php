@extends('layouts.app')

@section('content')
    <div class="box-border  w-5/6 p-4 border-4 m-auto mt-6 min-h-[80vh]">
        <!--main-->
        <div class="flex flex-wrap justify-start">
            @foreach ($authors as $author)
                @include('components.authorinfo')
            @endforeach
        </div>
    </div>
@endsection
