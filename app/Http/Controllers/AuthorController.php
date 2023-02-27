<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\AuthorRequest;
use Illuminate\View\View;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('check.author');
    }

    public function index(): View
    {
        return view('author.index', ['authors' => Author::with('books')->paginate(6)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('author.create', ['books' => Book::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorRequest $request): RedirectResponse
    {
        $author = Author::create($request->all());
        $author->books()->sync($request->books);

        return redirect()->route('author.create')->with('message', 'Author successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author): View
    {
        return view('author.show', ['author' => $author->load('books')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author): View
    {
        return view('author.edit', ['author' => Author::where('id', '=', $author->id)->first(), 'books' => Book::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthorRequest $request, Author $author): RedirectResponse
    {
        $author->update($request->all());
        $author->books()->sync($request->books);
        return redirect()->route('author.edit', ['author' => $author])->with('message', 'Author successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author): RedirectResponse
    {
        $author->delete();
        return redirect()->route('author.index')->with('message', 'Author successfully removed!');
    }
}