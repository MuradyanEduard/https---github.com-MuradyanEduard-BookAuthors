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

    <div class="box-border  w-4/6 p-4 border-4 m-auto mt-6 min-h-[80vh]">
      @include('layouts.navbar')
      
    <!--main-->
    <div class="box-border  w-full p-4 border-4 mt-6">
      @foreach ($books as $book)
      <div class="box-border  w-[300px] p-4 border-4 mt-6">
        <div class="w-full">
            <p >{{$book->title}}</p>
            <img src={{asset('images/book.jpg')}} style="width:100%;" alt="">
        </div>

        <div class="w-full mt-[20px]">
          <select class="js-example-basic-multiple" name="authors[]" multiple="multiple" disabled>
              @foreach ($book->authors as $author)
                  <option value="{{$author->id}}" selected>{{$author->name}}</option>
              @endforeach
          </select>     
        </div>
                
        <div class="flex flex-row ">
          <div class="basis-1/4">
              <form action="{{route('book.show',$book)}}" method="GET">
                  @csrf
                  <input type="submit" class="btn-action btn-search" value=" ">
              </form>
          </div>
          <div class="basis-1/4">
            <form action="{{route('book.edit',$book)}}" method="GET">
                @csrf
                <input type="submit" class="btn-action btn-edit" value=" ">
            </form>
          </div>
          <div class="basis-1/4">
              <form action="{{route('book.destroy',$book)}}" method="POST" onsubmit="return confirm('Are you sure?')">
                  @csrf
                  @method('DELETE')
                  <input type="submit" class="btn-action btn-remove" value=" ">
              </form>
          </div>    
        </div>
      </div>
      @endforeach
    </div>
    

   
    

@endsection