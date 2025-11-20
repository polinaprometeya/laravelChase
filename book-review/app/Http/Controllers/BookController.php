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
        $page = $request->input('page', 1);

        $books = Book::when(
            $title,
            fn ($query, $title) => $query->title($title)
        );

        $books = match($filter) {
            'popular_last_month' => $books->popularLastMonth(),
            'popular_last_quarter' => $books->popularLastQuarter(),
            'highest_rated_last_month' => $books->highestRatedLastMonth(),
            'highest_rated_last_quarter' => $books->highestRatedLastQuarter(),
            default => $books->latest()->withAvgRating()->withReviewsCount()
        };

        //$books = $books->get();

        // $books = Cache::remember('books', 3600, function () {
        //     $books->get();
        // });  //this is a wrong way to cache since it saves filters and title data and displays it even though we did not choose filters, it can bridge privacy as well

        //$books = cache()->remember($cacheKey, 3600, fn () => $books->get());
        //$books = $books->paginate($pagination);
        // Include page number in cache key since pagination is request-specific

        $cacheKey = 'books:' . $filter . ':' . $title . ':page:' . $page;

        $books = cache()->remember(
            $cacheKey,
            3600,
            function () use ($books) {

                // dd('this is not from cache');
                return $books->paginate(20);
            }
        );

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
    public function show(Request $request, int $id)
    {
        //there is a way to clear cache when code is changed , if you use redis
        // Cache the book without reviews (reviews will be paginated separately)
        $cacheKey = 'book:' . $id;
        $book = cache()->remember(
            $cacheKey,
            3600,
            fn () =>
                Book::withAvgRating()->WithReviewsCount()->findOrFail($id)
        );
        //what is the difference between findOneOrFail or findOrFail, findOneOrFail is used to find a single record and if it is not found it will throw an exception, findOrFail is used to find a single record and if it is not found it will return null
        // Paginate reviews separately (can't paginate inside eager loading)
        // $reviewsPage = $request->input('reviews_page', 1);

        $reviews = $book->reviews()
            ->latest()
            ->paginate(5, ['*'], 'reviews_page')
            ->withPath(route('books.show', $id));

        // Load the paginated reviews into the book relationship for the view
        $book->setRelation('reviews', $reviews);

        return view(
            'books.show',
            ['book' => $book]
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

    //     public function show(int $id)
    // {
    //     $cacheKey = 'book:' . $id;
    //     //there is a way to clear cache when code is changed , if you use redis
    //     $book = cache()->remember(
    //         $cacheKey,
    //         3600,
    //         fn () =>
    //     Book::with(
    //         ['reviews' => fn ($query) => $query->latest()
    //         ]
    //     )->withAvgRating()->WithReviewsCount()->findOrFail($id)
    //     );
    //     //what is the difference between findOneOrFail or findOrFail
    //     return view(
    //         'books.show',
    //         ['book' => $book ]
    //     );

    // }
    //public function show(Book $book)
    // {
    //     // Book::with('reviews')->findOneOrFail();
    //     // Book::with('reviews')->get();
    //     // return view('books.show', ['book' => $book]);
    //     //the relationship is lazy loaded the first time it encounters relationship stated $book->reviews since models relationship is accessed here .
    //     //   return view('books.show', ['book' => $book->load(['reviews' => fn ($query) => $query->latest()  ]) ] );
    //     //So all relationships are loaded. Both in php files and in templates.
    //     //we do not cache the book itself because we are using route model binding --> "show(Book $book)"

    //     //this is caching the reviews
    //     $cacheKey = 'book:' . $book->id;
    //     $book = cache()->remember($cacheKey, 3600,
    //     fn () => $book->load(
    //         ['reviews' => fn ($query) => $query->latest()]
    //     ));
    //     return view(
    //         'books.show',
    //         ['book' => $book ]
    //     );

    // }

    //     public function index(Request $request)
    // {
    //     $title = $request->input('title');
    //     $filter = $request->input('filter', '');

    //     $books = Book::when(
    //         $title,
    //         fn ($query, $title) => $query->title($title)
    //     );

    //     $books = match($filter) {
    //         'popular_last_month' => $books->popularLastMonth(),
    //         'popular_last_quarter' => $books->popularLastQuarter(),
    //         'highest_rated_last_month' => $books->highestRatedLastMonth(),
    //         'highest_rated_last_quarter' => $books->highestRatedLastQuarter(),
    //         default => $books->latest()->withAvgRating()->withReviewsCount()
    //     };

    //     //$books = $books->get();

    //     // $books = Cache::remember('books', 3600, function () {
    //     //     $books->get();
    //     // });  //this is a wrong way to cache since it saves filters and title data and displays it even though we did not choose filters, it can bridge privacy as well

    //     $cacheKey = 'books:' . $filter . ':' . $title ;
    //     //$books = cache()->remember($cacheKey, 3600, fn () => $books->get());
    //     $books = cache()->remember(
    //         $cacheKey,
    //         3600,
    //         function () use ($books) {
    //             // dd('this is not from cache');
    //             return $books->get();
    //         }
    //     );
}
