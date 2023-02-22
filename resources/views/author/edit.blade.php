@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-12 col-md-10 col-lg-9 col-xl-8" style="margin:auto;">
        <div class="row" style="box-shadow: 2px 2px 4px 4px #888;min-height: 200px;">
            <nav-bar-component></nav-bar-component>
            <section class="content">
                <div class="container-fluid" style="padding:50px">
                    <form action="{{ route('author.update',$author->id) }}" method="POST">
                        @csrf
                        @method('PUT')

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
                                    <input type="text" name="name" class="form-control" placeholder="Author name" value='{{$author->name}}'>
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="col-md-6" style="margin:20px 0">
                                    <img src={{asset('images/author.jpeg')}} style="width:100%;" alt="">
                                </div>
                            </div>
                            <div class="row" style="margin:0 0 20px 0">
                                <select class="js-example-basic-multiple" name="books[]" multiple="multiple">
                                    @foreach ($author->books as $book)
                                        <option value="{{$book->id}}" selected >{{$book->title}}</option>
                                    @endforeach
                                    @foreach ($books as $book)
                                        <option value="{{$book->id}}" >{{$book->title}}</option>
                                    @endforeach
                                </select>      
                            </div>
                            <div class="row">                                
                                <div class="col-md-6">
                                    <input type="submit" value="Change Author" style="background: #4bb1b1; color: white; height: 40px; font-weight: 500; width: 100%; border-radius: 8px; outline: none!important; border: none; cursor:pointer;">
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

<script>
    addEventListener("load", (event) => {
        $(".js-example-basic-multiple option").each(function() {
        $(this).siblings('[value="'+ this.value +'"]').remove();
        });
    });
</script>