<?php

use Illuminate\Support\Facades\Route;

class Task
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
        public ?string $long_description,
        public bool $completed,
        public string $created_at,
        public string $updated_at
    ) {
    }
}

$tasks = [
  new Task(
      1,
      'Buy groceries',
      'Task 1 description',
      'Task 1 long description',
      false,
      '2023-03-01 12:00:00',
      '2023-03-01 12:00:00'
  ),
  new Task(
      2,
      'Sell old stuff',
      'Task 2 description',
      null,
      false,
      '2023-03-02 12:00:00',
      '2023-03-02 12:00:00'
  ),
  new Task(
      3,
      'Learn programming',
      'Task 3 description',
      'Task 3 long description',
      true,
      '2023-03-03 12:00:00',
      '2023-03-03 12:00:00'
  ),
  new Task(
      4,
      'Take dogs for a walk',
      'Task 4 description',
      null,
      false,
      '2023-03-04 12:00:00',
      '2023-03-04 12:00:00'
  ),
];

//you need to utilize use() function since return here is anonymous, and data will not be available otherwise
Route::get('/', function () use ($tasks) {
    //return 'Main Page'; //this is the lending page
    //return view('index', ['name' => 'John Doe']); // you can manually just dump data here
    return view('index', [ 'tasks' => $tasks]);

}) -> name('tasks.index');

Route::get('/{id}', function ($id) {
    return 'this is is details of a task';
}) -> name('tasks.show');

// Route::get('/xxx', function () {
//     return 'Hello';
// })->name('route-name'); //when you name a route you give it alias that can always be used to identify it

// Route::get('/wrong', function () {
//     return redirect()->route('hello');
// }); //this helps to redirect different path somewhere

// Route::get('greet/{name}', function ($name) {
//     return 'Hello ' . $name . '!';
// }); //this accepts the value directly and shows it

// Route::fallback(function () {
//     return 'This path does not exist!';
// }); // fallback redirect all wrong path and shows this message
