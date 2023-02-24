@extends('layouts.app')

@section('content')
    <div class="box-border  w-4/6 p-4 border-4 m-auto mt-6 min-h-[80vh]">
        @include('components.navbar')

        <!--main-->
        <div class="flex flex-wrap justify-evenly">
            @foreach ($books as $book)
                <div class="box-border  max-w-[250px] p-4 border-4 m-6">
                    @include('components.bookinfo')
                </div>
            @endforeach
        </div>
    @endsection
