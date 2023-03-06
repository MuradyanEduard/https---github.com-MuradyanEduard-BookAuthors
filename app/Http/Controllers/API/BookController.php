<?php

namespace App\Http\Controllers\API;

use App\Models\Book;
use App\Models\Author;
use App\Models\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\BookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Session;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('check.api.book', ['except' => ['index', 'show', 'search']]); //only
    }

    public function index()
    {

        if (Auth::user()->role == User::ROLE_AUTHOR) {
            $books = Book::with('authors')
                ->whereHas('authors', function ($query) {
                    $query->where('authors.id', Auth::user()->id);
                })
                ->paginate(6);

            return response()->json(['books' => $books, 'user' => Auth::user(), 'basket' => Session::get('basket')]);
        } else
            return response()->json(['books' => Book::with('authors')->paginate(6), 'user' => Auth::user(), 'basket' => Session::get('basket')]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        try {
            $book = Book::create($request->all());
            $authors = Author::with('users')
                ->whereHas('users', function ($query) {
                    $query->where('users.role', '!=', User::ROLE_CUSTOMER);
                })
                ->get();

            if (Auth::user()->role == User::ROLE_AUTHOR) {
                $book->authors()->sync(Auth::user()->id);
            } else {
                $book->authors()->sync($request->authors);
            }

            return response()->json(['user' => Auth::user(), 'messages' => ['Book successfully created!']], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, Book $book)
    {

        try {
            $cond = true;
            if (Auth::user()->role != User::ROLE_ADMIN) {
                $book->load('authors');

                foreach ($book->authors as $author) {
                    if (Auth::user()->id == $author->id) {
                        $cond = false;
                        break;
                    }
                }

                if ($cond) {
                    return response()->json(['messages' => ['Permission denied!']], 202);
                }
            }

            $book->update($request->all());
            $authors = Author::with('users')
                ->whereHas('users', function ($query) {
                    $query->where('users.id', '!=', User::ROLE_CUSTOMER);
                })
                ->get();

            if (Auth::user()->role != User::ROLE_AUTHOR) {
                $book->authors()->sync($request->authors);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }

        return response()->json(['user' => Auth::user(), 'messages' => ['Book successfully updated!']], 202);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $cond = true;
        if (Auth::user()->role != User::ROLE_ADMIN) {
            $book->load('authors');

            foreach ($book->authors as $author) {
                if (Auth::user()->id == $author->id) {
                    $cond = false;
                    break;
                }
            }

            if ($cond) {
                return response()->json(['messages' => ['Permission denied!']], 202);
            }
        }

        $book->delete();
        return response()->json(['user' => Auth::user(), 'messages' => ['Book successfully deleted!']], 202);
    }

    public function search(Request $request)
    {
        if (!$request->search)
            return redirect()->route('book.index');

        $book = Book::whereRaw("LOCATE('" . $request->search . "', title) <> 0")->with('authors')->paginate(6);

        return response()->json(['books' => $book, 'user' => Auth::user(), 'basket' => Session::get('basket')], 202);
    }
}