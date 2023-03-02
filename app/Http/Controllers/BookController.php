<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\User;


use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

use Session;
use Inertia\Inertia;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('check.book', ['except' => ['index', 'show', 'search']]); //only
    }

    public function index()
    {

        if (Auth::user()->role == User::ROLE_AUTHOR) {
            $books = Book::with('authors')
                ->whereHas('authors', function ($query) {
                    $query->where('authors.id', Auth::user()->id);
                })
                ->paginate(6);

            return Inertia::render('book/Index', ['books' => $books, 'user' => Auth::user(), 'basket' => Session::get('basket')]);
        } else
            return Inertia::render('book/Index', ['books' => Book::with('authors')->paginate(6), 'user' => Auth::user(), 'basket' => Session::get('basket')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::with('users')
            ->whereHas('users', function ($query) {
                $query->where('users.role', '!=', User::ROLE_CUSTOMER);
            })
            ->get();

        if (Auth::user()->role == User::ROLE_AUTHOR)
            return Inertia::render('book/Create', ['user' => Auth::user()]);
        else
            return Inertia::render('book/Create', ['user' => Auth::user(), 'authors' => $authors]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
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

        return Inertia::render('book/Create', ['user' => Auth::user(), 'authors' => $authors, 'messages' => ['Book successfully created!']]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book) //: View|RedirectResponse

    {
        if (Auth::user()->role == User::ROLE_AUTHOR) {

            foreach ($book->authors as $author) {
                if ($author->id == Auth::user()->id)
                    return Inertia::render('book/Show', ['book' => $book->load('authors'), 'user' => Auth::user()]);
            }

            return redirect()->route('book.index');
        } else
            return Inertia::render('book/Show', ['book' => $book->load('authors'), 'user' => Auth::user()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        // dd('barev');
        $book = Book::where('id', '=', $book->id)->with('authors')->first();
        $authors = Author::with('users')
            ->whereHas('users', function ($query) {
                $query->where('users.role', '!=', User::ROLE_CUSTOMER);
            })
            ->get();

        if (Auth::user()->role == User::ROLE_AUTHOR) {

            foreach ($book->authors as $author) {
                if ($author->id == Auth::user()->id)
                    return Inertia::render('book/Edit', ['book' => $book, 'user' => Auth::user(), 'authors' => []]);
            }

        } else
            return Inertia::render('book/Edit', ['book' => $book, 'user' => Auth::user(), 'authors' => $authors]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, Book $book)
    {
        $book->update($request->all());
        $authors = Author::with('users')
            ->whereHas('users', function ($query) {
                $query->where('users.role', '!=', User::ROLE_CUSTOMER);
            })
            ->get();

        if (Auth::user()->role != User::ROLE_AUTHOR) {
            $book->authors()->sync($request->authors);
        }

        return Inertia::render('book/Edit', ['book' => $book->load('authors'), 'user' => Auth::user(), 'authors' => $authors, 'messages' => ['Book successfully updated!']]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();
        return redirect()->route('book.index')->with('messages', 'Book successfully removed!');
    }

    public function search(Request $request)
    {
        if (!$request->search)
            return redirect()->route('book.index');

        $book = Book::whereRaw("LOCATE('" . $request->search . "', title) <> 0")->with('authors')->paginate(6);

        return Inertia::render('book/Index', ['books' => $book, 'user' => Auth::user(), 'basket' => Session::get('basket')]);
    }

}