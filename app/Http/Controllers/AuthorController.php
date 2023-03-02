<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\AuthorRequest;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('check.author', ['except' => ['index', 'show', 'search']]);
    }

    public function index()
    {
        return Inertia::render('author/Index', ['authors' => Author::with('books')->paginate(6), 'user' => Auth::user()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('author/Create', ['books' => Book::all(), 'user' => Auth::user()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorRequest $request)
    {
        $author = Author::create($request->all());
        $author->books()->sync($request->books);

        return Inertia::render('author/Create', ['user' => Auth::user(), 'messages' => ['Author successfully created!']]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return Inertia::render('author/Show', ['user' => Auth::user(), 'author' => $author->load('books')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        return Inertia::render('author/Edit', ['user' => Auth::user(), 'author' => $author->load('books'), 'books' => Book::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthorRequest $request, Author $author)
    {
        $author->update($request->all());
        $author->books()->sync($request->books);
        return Inertia::render('author/Edit', ['user' => Auth::user(), 'author' => $author->load('books'), 'books' => Book::all(), 'messages' => ['Author successfully created!']]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author): RedirectResponse
    {
        $author->delete();
        return redirect()->route('author.index')->with('message', 'Author successfully removed!');
    }

    public function search(Request $request)
    {
        if (!$request->search)
            return redirect()->route('author.index');

        $author = Author::whereRaw("LOCATE('" . $request->search . "', name) <> 0")->with('books')->paginate(6);

        return Inertia::render('author/Index', ['authors' => $author, 'user' => Auth::user()]);
    }

}