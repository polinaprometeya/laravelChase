@extends('layouts.app')


@section('title', isset($task) ? 'Edit Task' : 'Create Task')

@section('styles')
    <style>
        .error-message {
            color: red;
            size: 0.8rem;
        }

        .label {
            white-space: pre-wrap;
        }
    </style>
@endsection

@section('content')
    <form method="POST" action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}">
        {{-- {{ $errors }} --}}
        {{-- the action invokes endpoint called tasks.store --}}

        @csrf
        {{-- //this csrf directive middleware that protects you from scrip hack attacks. --}}

        @isset($task)
            @method('PUT')
        @endisset
        {{-- @method(isset($task) ? 'PUT' : 'POST') -> I am not sure you can do that --}}
        {{-- this put thing is method spoofing , since HTTP browser does not do PUT --}}

        <div>
            <label for="title">Title</label>
            <input id="id" name="title" type="text" required placeholder="Write title"
                value="{{ $task->title ?? old('title') }}"></input>

            @error('title')
                <p class="error-message">{{ $message }}</p>
            @enderror

        </div>
        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="5" required placeholder="Write short description">{{ $task->description ?? old('description') }}</textarea>
            @error('description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="long_description"> Long Description</label>
            <textarea id="long_description" name="long_description" rows="10" placeholder="Write long description">{{ $task->long_description ?? old('long_description') }}</textarea>
            @error('long_description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <button type="submit">
                @isset($task)
                    Save
                @else
                    Submit
                @endisset
            </button>
        </div>
    </form>
@endsection
