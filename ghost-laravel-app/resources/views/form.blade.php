@extends('layouts.app')


@section('title', isset($task) ? 'Edit Task' : 'Create Task')

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

        <div class="mb-4">
            <label for="title">Title</label>
            {{-- <input id="id" name="title" type="text" placeholder="Write title"
                value="{{ $task->title ?? old('title') }}"></input> --}}
            {{-- the other way to use conditional class  here is @class(['border-red-500' => $errors->has('title')]) --}}

            <input id="title" name="title" text="text" placeholder="Write title" @class(['border-red-500' => $errors->has('title')])
                value="{{ $task->title ?? old('title') }}"></input>
            @error('title')
                <p class="error">{{ $message }}</p>
            @enderror

        </div>
        <div class="mb-4">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="5" placeholder="Write short description"
                @class(['border-red-500' => $errors->has('description')])>{{ $task->description ?? old('description') }}</textarea>
            @error('description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="long_description"> Long Description</label>
            <textarea id="long_description" name="long_description" rows="10" placeholder="Write long description"
                @class(['border-red-500' => $errors->has('long_description')])>{{ $task->long_description ?? old('long_description') }}</textarea>
            @error('long_description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4 flex items-center gap-2">
            <button type="submit" class="btn">
                @isset($task)
                    Save
                @else
                    Submit
                @endisset
            </button>
            <a href="{{ route('tasks.index') }}" class="link"> Cancel</a>
        </div>
    </form>
@endsection
