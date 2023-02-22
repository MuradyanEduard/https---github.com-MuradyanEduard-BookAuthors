@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-12 col-md-10 col-lg-9 col-xl-8" style="margin:auto;">
        <div class="row" style="box-shadow: 2px 2px 4px 4px #888;min-height: 200px;">
            <nav-bar-component></nav-bar-component>
            <section class="content">
                <div class="container-fluid" style="padding:50px">
                    <form action="{{ route('book.store') }}" method="POST">
                        @csrf
                        @if(session()->has('message'))
                            <div class="col-md-12">
                                <div class="alert alert-success" role="alert">
                                    {{ session()->get('message') }}
                                </div>
                            </div>
                        @endif
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text"  name="title" class="form-control" placeholder="Book title">
                                    <book-author-component :buttons='{search:false,edit:false,remove:false,}' ></book-author-component>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6" style="margin-top: 15px;">
                                    <select class="js-example-basic-multiple" name="authors[]" multiple="multiple">
                                        @foreach ($authors as $author)
                                            <option value="{{$author->id}}">{{$author->name}}</option>
                                        @endforeach
                                    </select>            
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6" >
                                    <input type="submit" value="Create Book" style="background: #4bb1b1; color: white; height: 40px; margin-top: 15px; font-weight: 500; width: 250px; border-radius: 8px; outline: none!important; border: none; cursor:pointer;">
                                </div>
                            </div>
                        </div>
                    </div>    
                    </form>
                </div>
            </section>
            
        </div>
    </div>
</div>

@endsection