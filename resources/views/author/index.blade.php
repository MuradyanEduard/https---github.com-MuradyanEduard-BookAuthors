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
            @foreach ($authors as $author)
            <div class="books-content col-3 align-self-start" >
                <div  style="max-height: 100%;">
                    <div class="row" >
                        <div class="col-12">
                            <p >{{$author->name}}</p>
                            <img src={{asset('images/author.jpeg')}} style="width:100%;" alt="">
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <select class="js-example-basic-multiple" name="books[]" multiple="multiple" disabled >
                            @foreach ($author->books as $book)
                                <option value="{{$book->id}}" selected>{{$book->title}}</option>
                            @endforeach
                        </select>     
                    </div>
                    <div class="row">
                        <div class="div-input">
                            <form action="{{route('author.show',$author)}}" method="GET">
                                @csrf
                                <input type="submit" class="btn-action btn-search" value=" ">
                            </form>
                        </div>
                            <div class="div-input">
                            <form action="{{route('author.edit',$author)}}" method="GET">
                                @csrf
                                <input type="submit" class="btn-action btn-edit" value=" ">
                            </form>
                        </div>
                        <div class="div-input">
                            <form action="{{route('author.destroy',$author)}}" method="POST" onsubmit="return confirm('Are you sure?')">
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