@extends('layouts.app')

@section('title', 'List of tasks:')

@section('content')
    <div>
        <a href="{{ route('tasks.create') }}" role="button"> Create Task</a>
    </div>
    @if (session()->has('success'))
        <div>{{ session('success') }}</div>
    @endif
    {{-- directive -- this is everything that starts with @,
 this prevents errors and executes code conditionally --}}
    {{-- @isset($name) <p>Welcome back: {{ $name }}</p>@endisset() --}}

    {{-- @if (count($tasks))
    //this dumps all tasks as a list the same as foreach
    , but it have built in if else feature .  <div>Todays to-do's</div> @foreach ($tasks as $task)
    <li>{{ $task->title }}</li>  @endforeach @else <p> There are no tasks</p> @endif --}}


    @forelse ($tasks as $task)
        <div>
            <a href="{{ route('tasks.show', ['task' => $task->id]) }}">
                <li>{{ $task->title }}</li>
            </a>
        </div>
    @empty
        <p>There are no tasks</p>
    @endforelse


    @if ($task->count())
        <nav>{{ $tasks->links() }}</nav>
    @endif
@endsection
