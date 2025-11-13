<?php

// use Illuminate\Http\Response;
// use Illuminate\Validation\Rules\In;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Task;
use App\Http\Requests\TaskRequest;

///-------All tasks
Route::get('/tasks', function () {
    //return 'Main Page'; //this is the lending page
    //return view('index', ['name' => 'John Doe']); // you can manually just dump data here

    //---the queries are structured in object oriented way that can be specified. 'tasks' => \App\Models\Task::latest()->where('completed',true)->get()
    return view('index', ['tasks' => Task::latest()->get()
]);
}) -> name('tasks.index');

Route::get('/', function () {
    return redirect() -> route('tasks.index');
});

///-------Create task
Route::view('/tasks/create', 'create') -> name('tasks.create');

Route::post('/tasks', function (TaskRequest $request) {
    $data = $request->validated();

    // $task = new Task(); //creating new instance
    // //populating instance
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save(); //save populated data in the model, because of a new model it will know it needs to make insert query

    $task = Task::create($data);

    return redirect() -> route('tasks.show', [$task->id])->with('success', "Task is created successfully"); //flash message, toast

}) -> name('tasks.store');

///-------View task
Route::get('/tasks/{task}', function (Task $task) {
    return view('show', ['task' => $task]);
}) -> name('tasks.show');

///-------Edit task
Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', ['task' => $task]);
}) -> name('tasks.edit');


Route::put('/tasks/{task}', function (TaskRequest $request, Task $task) {
    $data = $request->validated();

    // //refill til instance
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save(); // this runs update query as well

    $task -> update($data);

    return redirect() -> route('tasks.show', [$task->id])->with('success', "Task is updated successfully"); //flash message, toast
}) -> name('tasks.update');

///-------Delete task

Route::delete('/tasks/{task}', function (Task $task) {
    $task -> delete();
    return redirect() -> route('tasks.index')-> with('success', "Task deleted successfully!");
})->name('task.destroy');

///-------Fallback
Route::fallback(function () {
    return 'This path does not exist!';
    // ---fallback redirect all wrong path and shows this message
});

///-------OLD

// Route::put('/tasks/{id}', function (Request $request, $id) {
//     $data = $request->validate([
//         'title' => 'required | max:50',
//         'description' => 'required | max:5009',
//         'long_description' => 'max:2000 ',
//     ]);
//     //---find does not take into consideration ids that do not exist, but findOrFail does.
//     $task = Task::findOrFail($id);
//     //find instance
//     //refill til instance
//     $task->title = $data['title'];
//     $task->description = $data['description'];
//     $task->long_description = $data['long_description'];
//     $task->save(); // this runs update query as well
//     return redirect() -> route('tasks.show', [$task->id])->with('success', "Task is updated successfully"); //flash message, toast
// }) -> name('tasks.update');

// Route::get('/tasks/{id}', function ($id) {
// //The order of routes matters, since the {id} would catch 'create' and assume it is aan id.
//     return view('show', ['task' => Task::findOrFail($id)]);
// }) -> name('tasks.show');

// Route::get('/tasks/{id}/edit', function ($id) {
//     return view('edit', ['task' => Task::findOrFail($id)]);
// }) -> name('tasks.edit');

// Route::get('/tasks/{id}', function ($id) use ($tasks) {
//     //---you need to utilize use() function since return here is anonymous, and data will not be available otherwise
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


//-----old data-----
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
