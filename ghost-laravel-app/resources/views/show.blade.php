@extends('layouts.app')

{{-- @section('title', $task->title) //if it does not contain htm it does not need to be closed --}}
@section('title')
    <h1>Selected Task: {{ $task->title }}</h1>
@endsection

@section('content')
    <div class="mb-4">
        <a href="{{ route('tasks.index') }}" class="link"> ← Go Back to view all tasks</a>
    </div>
    <p class="mb-4 text-slate-700">{{ $task->description }}</p>

    @if ($task->long_description)
        <p class="mb-4 text-slate-700">{{ $task->long_description }}</p>
    @endif

    @if ($task->completed)
        <p>Task is done !</p>
    @endif


    <p class="mb- text-sm text-slate-500">Created at: {{ $task->created_at->diffForHumans() }} •
        Updated at:
        {{ $task->updated_at->diffForHumans() }}</p>

    <p class="mb-4">
        Status:
        @if ($task->completed)
            <span class="font-medium text-green-500/50"> completed</span>
        @else
            <span class="font-medium text-red-500/50"> not completed</span>
        @endif
    </p>

    <div class="flex gap-2">
        <a href="{{ route('tasks.edit', ['task' => $task]) }}" role="button" class="btn">
            Edit</a>

        <form method="POST" action={{ route('tasks.toggle-complete', ['task' => $task]) }}>
            @csrf
            @method('PUT')
            <button type="submit" class="btn">Mark as {{ $task->completed ? 'not completed' : 'completed' }}</button>
        </form>

        <form method="POST" action={{ route('tasks.destroy', ['task' => $task->id]) }}>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn">Delete</button>
        </form>
    </div>
@endsection
