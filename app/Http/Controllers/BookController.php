<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\BookRequest;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('book.index', ['books' => Book::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request): RedirectResponse
    {
        $book = Book::create($request->all());

        return redirect()->route('book.create')->with('message', 'Book successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book): View
    {
        return view('book.show',['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book): View
    {
        return view('book.edit',['book' => Book::where('id' , '=' , $book->id )->first()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, Book $book): RedirectResponse
    {
        $book->update($request->all());
        return redirect()->route('book.edit',['book' => $book])->with('message', 'Book successfully updated!');
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
