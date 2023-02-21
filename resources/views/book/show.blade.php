
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-12 col-md-10 col-lg-9 col-xl-8" style="margin:auto;">
        <div class="row" style="box-shadow: 2px 2px 4px 4px #888;min-height: 500px;">
            <book-nav-bar-component></book-nav-bar-component>
            <div class="col-6">
                <book-component :book='{{json_encode($book)}}' style="margin-left:30px">
                </book-component>    
            </div>

        </div>
    </div>
</div>

@endsection


