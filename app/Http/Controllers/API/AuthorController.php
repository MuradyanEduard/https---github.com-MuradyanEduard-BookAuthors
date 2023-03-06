<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\Author;
use App\Models\User;

use App\Http\Requests\API\AuthorRequest;
use Illuminate\Support\Facades\Auth;

use Session;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('check.api.author', ['except' => ['index', 'show', 'search']]);
    }

    public function index()
    {
        return response()->json(['authors' => Author::with('books')->paginate(6), 'user' => Auth::user()]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorRequest $request)
    {
        try {
            $author = Author::create($request->all());
            $author->books()->sync($request->books);

            return response()->json(['user' => Auth::user(), 'messages' => ['Author successfully created!']], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthorRequest $request, Author $author)
    {

        try {
            $author->books()->sync($request->books);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }

        return response()->json(['user' => Auth::user(), 'messages' => ['Author successfully updated!']], 202);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return response()->json(['user' => Auth::user(), 'messages' => ['Author successfully deleted!']], 202);
    }

    public function search(Request $request)
    {
        if (!$request->search)
            return redirect()->route('book.index');

        $book = Book::whereRaw("LOCATE('" . $request->search . "', title) <> 0")->with('authors')->paginate(6);

        return response()->json(['books' => $book, 'user' => Auth::user(), 'basket' => Session::get('basket')], 202);
    }
}