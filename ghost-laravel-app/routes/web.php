<?php

use Illuminate\Http\Response;
use Illuminate\Validation\Rules\In;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// class Task
// {
//     public function __construct(
//         public int $id,
//         public string $title,
//         public string $description,
//         public ?string $long_description,
//         public bool $completed,
//         public string $created_at,
//         public string $updated_at
//     ) {
//     }
// }

// $tasks = [
//   new Task(
//       1,
//       'Buy groceries',
//       'Task 1 description',
//       'Task 1 long description',
//       false,
//       '2023-03-01 12:00:00',
//       '2023-03-01 12:00:00'
//   ),
//   new Task(
//       2,
//       'Sell old stuff',
//       'Task 2 description',
//       null,
//       false,
//       '2023-03-02 12:00:00',
//       '2023-03-02 12:00:00'
//   ),
//   new Task(
//       3,
//       'Learn programming',
//       'Task 3 description',
//       'Task 3 long description',
//       true,
//       '2023-03-03 12:00:00',
//       '2023-03-03 12:00:00'
//   ),
//   new Task(
//       4,
//       'Take dogs for a walk',
//       'Task 4 description',
//       null,
//       false,
//       '2023-03-04 12:00:00',
//       '2023-03-04 12:00:00'
//   ),
// ];


//---you need to utilize use() function since return here is anonymous, and data will not be available otherwise
Route::get('/tasks', function () {
    //return 'Main Page'; //this is the lending page
    //return view('index', ['name' => 'John Doe']); // you can manually just dump data here
    //---the queries are structured in object oriented way that can be specified. 'tasks' => \App\Models\Task::latest()->where('completed',true)->get()
    return view('index', ['tasks' => \App\Models\Task::latest()->get()
]);

}) -> name('tasks.index');

Route::get('/', function () {
    return redirect() -> route('tasks.index');
});
Route::view('/tasks/create', 'create') -> name('tasks.create');

//---find does not take into consideration ids that do not exist.
//The order of routes matters, since the {id} would catch 'create' and assume it is aan id.

Route::get('/tasks/{id}', function ($id) {
    return view('show', ['task' => \App\Models\Task::findOrFail($id)]);
}) -> name('tasks.show');

Route::post('/tasks', function (Request $request) {
    dd($request->all());
}) -> name('tasks.store');

Route::fallback(function () {
    return 'This path does not exist!';
});
// ---fallback redirect all wrong path and shows this message


// Route::get('/tasks/{id}', function ($id) use ($tasks) {
//     // return 'this is is details of a task';
//     $task = collect($tasks)->firstWhere('id', $id);
//     if (!$task) {
//         abort(Response::HTTP_NOT_FOUND);
//     }
//     return view('show', ['task' => $task]);
// }) -> name('tasks.show');

// Route::get('/xxx', function () {
//     return 'Hello';
// })->name('route-name');
//---when you name a route you give it alias that can always be used to identify it

// Route::get('/wrong', function () {
//     return redirect()->route('hello');
// });
//---this helps to redirect different path somewhere

// Route::get('greet/{name}', function ($name) {
//     return 'Hello ' . $name . '!';
// });
//---this accepts the value directly and shows it
