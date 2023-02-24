@extends('layouts.app')

@section('content')
    <div class="box-border  w-4/6 p-4 border-4 m-auto mt-6 min-h-[80vh]">
        @include('components.navbar')
        <!--main-->
        <div class="flex flex-wrap justify-evenly" class="w-[50%]">
            <div class="box-border  w-full p-4 border-4 m-6">
                <form action="{{ route('author.update', $author) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @if (session()->has('message'))
                        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                            role="alert">
                            <span class="font-medium"> {{ session()->get('message') }} </span>
                        </div>
                    @endif
                    <div class="w-full">
                        <label for="name" class="block m-5 text-sm font-medium text-gray-900 dark:text-white">Author
                            name</label>
                        <input type="text" name="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-5 mb-5"
                            placeholder="title" value='{{ $author->name }}'>
                        @error('name')
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative"
                                role="alert">
                                {{ $message }}
                            </div>
                        @enderror

                        <img src={{ asset('images/author.jpeg') }} class="w-full mt-3" alt="">
                    </div>

                    <div class="w-full mt-[20px]">
                        <select class="js-example-basic-multiple" name="books[]" multiple="multiple">
                            @foreach ($author->books as $book)
                                <option value="{{ $book->id }}" selected>{{ $book->title }}</option>
                            @endforeach
                            @foreach ($author as $author)
                                <option value="{{ $book->id }}">{{ $book->title }}</option>
                            @endforeach
                        </select>
                        @error('books')
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-3 rounded relative"
                                role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="w-[50%] m-auto mt-[20px]">
                        <input type="submit"
                            class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                            value="Updaate Author">

                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    addEventListener("load", (event) => {
        $(".js-example-basic-multiple option").each(function() {
            $(this).siblings('[value="' + this.value + '"]').remove();
        });
    });
</script>
