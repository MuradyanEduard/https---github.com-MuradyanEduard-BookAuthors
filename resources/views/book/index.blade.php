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

<!--main-->
<div class="container">
    <div class="col-12 col-md-10 col-lg-9 col-xl-8" style="margin:auto">
        <div class="row" style="box-shadow: 2px 2px 4px 4px #888; min-height: 60vh;">
            <nav-bar-component></nav-bar-component>
            @foreach ($books as $book)
            <div class="books-content col-3 align-self-start" >
                <div  style="max-height: 100%;">
                    <div class="row" >
                        <div class="col-12">
                            <p >{{$book->title}}</p>
                            <img src={{asset('images/book.jpg')}} style="width:100%;" alt="">
                        </div>
                    </div>
                    <div class="row" style="margin-top:20px">
                        <select class="js-example-basic-multiple" name="authors[]" multiple="multiple" disabled>
                            @foreach ($book->authors as $author)
                                <option value="{{$author->id}}" selected>{{$author->name}}</option>
                            @endforeach
                        </select>     
                    </div>
                    <div class="row">
                        <div class="div-input">
                            <form action="{{route('book.show',$book)}}" method="GET">
                                @csrf
                                <input type="submit" class="btn-action btn-search" value=" ">
                            </form>
                        </div>
                            <div class="div-input">
                            <form action="{{route('book.edit',$book)}}" method="GET">
                                @csrf
                                <input type="submit" class="btn-action btn-edit" value=" ">
                            </form>
                        </div>
                        <div class="div-input">
                            <form action="{{route('book.destroy',$book)}}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn-action btn-remove" value=" ">
                            </form>
                        </div>    
                    </div>
                </div>
            </div>
            @endforeach
    </div>
</div>
<!--main-->
    

@endsection