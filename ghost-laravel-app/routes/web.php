<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //return 'Main Page'; //this is the lending page
    return view(
        'index',
        ['name' => 'John Doe']
    ); // you can manually just dump data here
});

Route::get('/xxx', function () {
    return 'Hello';
})->name('route-name'); //when you name a route you give it alias that can always be used to identify it

Route::get('/wrong', function () {
    return redirect()->route('hello');
}); //this helps to redirect different path somewhere

Route::get('greet/{name}', function ($name) {
    return 'Hello ' . $name . '!';
}); //this accepts the value directly and shows it

Route::fallback(function () {
    return 'This path does not exist!';
}); // fallback redirect all wrong path and shows this message
