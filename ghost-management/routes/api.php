<?php

use App\Http\Controllers\Api\AttendeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;

//Route::middleware('auth:sanctum')->get('/user', function(Request $request){return $request->user();}); <--- laravel 11 , this is no more
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('events', EventController::class);

Route::apiResource('events.attendees', AttendeeController::class)
->scoped()->except('update');
//-->attendee is always part of an event, if you use route model binding it will look for attendee in a parent event.
//In that case they both parameter are required and need to be present or the query fails.  GET|HEAD        api/event/{event}/attendees/{attendee}
//

// Route::apiResource('event.attendees', AttendeeController::class)
// ->scoped(['attendee' => 'event']);
