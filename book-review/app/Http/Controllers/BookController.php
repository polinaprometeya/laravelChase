<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = $request->input('title');
        $filter = $request->input('filter', '');

        $books = Book::when(
            $title,
            fn ($query, $title) => $query->title($title)
        );

        $books = match($filter) {
            'popular_last_month' => $books->popularLastMonth(),
            'popular_last_quarter' => $books->popularLastQuarter(),
            'highest_rated_last_month' => $books->highestRatedLastMonth(),
            'highest_rated_last_quarter' => $books->highestRatedLastQuarter(),
            default => $books->latest()
        };

        $books = $books->get();

        // the way this query works is that if title is there the query is limited to search with title, else it does not limit the query
        //  $books = Book::when($title, function ($query, $title) {
        //  return  $query->title($title);
        // })->get();
        //this runs only when title is not null, it is a conditional statement helped by When
        // return view('books.index',  compact('books'));

        return view('books.index', ['books' => $books]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        // Book::with('reviews')->findOneOrFail();
        // Book::with('reviews')->get();
        // return view('books.show', ['book' => $book]);
        //the relationship is lazy loaded the first time it encounters relationship stated $book->reviews since models relationship is accessed here .
        //So all relationships are loaded. Both in php files and in templates.

        return view(
            'books.show',
            ['book' => $book->load(['reviews' => fn ($query) => $query->latest()])
        ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
