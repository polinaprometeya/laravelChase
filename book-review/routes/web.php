<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::resource('books', BookController::class)
->only(['index','show']);


Route::resource('books.reviews', ReviewController::class)
->scoped(['review' => 'book'])
->only(['create', 'store']);

Route::post('books/{book}/reviews', [ReviewController::class, 'store'])
->middleware('throttle:reviews')
->name('books.reviews.store');

//adding middleware  you need to specify that middleware applies only to store, or it will limit create too
// Route::resource('books.reviews', ReviewController::class)
// ->scoped(['review' => 'book'])
// ->only(['create', 'store'])
// ->middlewareFor(['store'], ['throttle:reviews']);

Route::fallback(function () {
    return 'route does not exist';
});
