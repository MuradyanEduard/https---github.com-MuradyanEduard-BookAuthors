@extends('layouts.app')

@section('content')

    <div class="col-md-6" style="margin:auto;">
        @if(session()->has('message'))
        <div class="col-12">
            <div class="alert alert-success" role="alert">
                {{ session()->get('message') }}
            </div>
        </div>
        @endif
        @foreach ($errors->all() as $error)
        <div class="col-12">
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        </div>
        @endforeach
    </div>
    
    <book-main-component :books='{{json_encode($books)}}' >
    </book-main-component>


@endsection