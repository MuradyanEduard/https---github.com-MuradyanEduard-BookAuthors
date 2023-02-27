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

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('check.book', ['except' => ['index']]); //only
    }

    public function index(): View
    {
        if (Auth::user()->role == User::ROLE_AUTHOR) {
            $books = Book::with('authors')
                ->whereHas('authors', function ($query) {
                    $query->where('authors.id', Auth::user()->id);
                })
                ->paginate(6);

            return view('book.index', ['books' => $books]);
        } else
            return view('book.index', ['books' => Book::with('authors')->paginate(6)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        if (Auth::user()->role == User::ROLE_AUTHOR) 
            return view('book.create');
        else
            return view('book.create', ['authors' => Author::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request): RedirectResponse
    {

        $book = Book::create($request->all());
        if (Auth::user()->role == User::ROLE_AUTHOR) {
            $book->authors()->sync(Auth::user()->id);
        }else{
            $book->authors()->sync($request->authors);
        }

        return redirect()->route('book.create')->with('message', 'Book successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book): View|RedirectResponse
    {
        if (Auth::user()->role == User::ROLE_AUTHOR) {

            foreach ($book->authors as $author) {
                if ($author->id == Auth::user()->id)
                    return view('book.show', ['book' => $book->load('authors')]);
            }

            return redirect()->route('book.index');
        } else
            return view('book.show', ['book' => $book->load('authors')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book): View|RedirectResponse
    {
        if (Auth::user()->role == User::ROLE_AUTHOR) {

            foreach ($book->authors as $author) {
                if ($author->id == Auth::user()->id)
                    return view('book.edit', ['book' => Book::where('id', '=', $book->id)->with('authors')->first(), 'authors' => []]);
            }

            return redirect()->route('book.index');
        } else
            return view('book.edit', ['book' => Book::where('id', '=', $book->id)->with('authors')->first(), 'authors' => Author::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, Book $book): RedirectResponse
    {
        $book->update($request->all());

        if (Auth::user()->role != User::ROLE_AUTHOR) {
            $book->authors()->sync($request->authors);
        }

        return redirect()->route('book.edit', ['book' => $book])->with('message', 'Book successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();
        return redirect()->route('book.index')->with('message', 'Book successfully removed!');
    }

}