
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-12 col-md-10 col-lg-9 col-xl-8" style="margin:auto;">
        <div class="row" style="box-shadow: 2px 2px 4px 4px #888;min-height: 200px;">
            <nav-bar-component></nav-bar-component>
            <section class="content">
                <div class="container-fluid" style="padding:50px">
                    @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                        
                        <div class="col-md-6">
                            <div class="row">                                
                                <div class="col-md-12">
                                    <p >{{$author->name}}</p>
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="col-md-12" style="margin:20px 0">
                                    <img src={{asset('images/author.jpeg')}} style="width:100%;" alt="">
                                </div>
                            </div>
                            <div class="row" style="margin:0 0 20px 0">
                                <select class="js-example-basic-multiple" name="authors[]" multiple="multiple" disabled="disabled">
                                    @foreach ($author->books as $book)
                                        <option value="{{$book->id}}" selected >{{$book->title}}</option>
                                    @endforeach
                                </select>      
                            </div>
                            <div class="row">                                
                                <div class="col-md-12">
                                    <a href="{{route('author.index')}}"  class="btn btn-xs btn-info pull-right" style="width: 100%;color:white;font-weight: bold;">Book List</a>
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


