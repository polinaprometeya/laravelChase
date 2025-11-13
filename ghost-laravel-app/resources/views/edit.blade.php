@extends('layouts.app')


@section('title', 'Edit Task')

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
    <form method="POST" action="{{ route('tasks.update', ['id' => $task->id]) }}">
        @csrf
        @method('PUT')
        {{-- this put thing is method spoofing , since HTTP browser does not do PUT --}}

        <div>
            <label for="title" class="label">Title</label>
            <input id="id" name="title" type="text" required value={{ $task->title }}></input>

            @error('title')
                <p class="error-message">{{ $message }}</p>
            @enderror

        </div>
        <div>
            <label for="description" class="label">Description</label>
            <textarea id="description" name="description" rows="5" required> {{ $task->description }} </textarea>
            @error('description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="long_description" class="label"> Long Description</label>
            <textarea id="long_description" name="long_description" rows="10"> {{ $task->long_description }} </textarea>
            @error('long_description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div> <button type="submit">Save</button></div>
    </form>
@endsection
