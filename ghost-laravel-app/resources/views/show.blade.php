@extends('layouts.app')

{{-- @section('title', $task->title) //if it does not contain htm it does not need to be closed --}}
@section('title')
    <h1>Selected Task: {{ $task->title }}</h1>
@endsection

@section('content')
    <p>{{ $task->description }}</p>

    @if ($task->long_description)
        <p>{{ $task->long_description }}</p>
    @endif

    @if ($task->completed)
        <p>Task is done !</p>
    @endif

    @if ($task->created_at)
        <p>Created at: {{ $task->created_at }}</p>
    @endif

    @if ($task->updated_at)
        <p>Updated at: {{ $task->updated_at }}</p>
    @endif
@endsection
