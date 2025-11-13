@extends('layouts.app')


@endsection

@section('title', 'Create Task')

@section('styles')
<style>
    .error-message {
        color: red;
        size: 0, 8rem;
    }

    .label {
        white-space: pre-wrap;
    }
</style>

@section('content')
    <form method="POST" action="{{ route('tasks.store') }}">
        {{-- {{ $errors }} --}}

        @csrf
        {{-- //this csrf directive middleware that protects you from scrip hack attacks. --}}

        <div>
            <label for="title" class="label">Title</label>
            <input id="id" name="title" type="text" required placeholder="Write title"></input>

            @error('title')
                <p class="error-message">{{ $message }}</p>
            @enderror

        </div>
        <div>
            <label for="description" class="label">Description</label>
            <textarea id="description" name="description" rows="5" required placeholder="Write short description"></textarea>
            @error('description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="long_description" class="label"> Long Description</label>
            <textarea id="long_description" name="long_description" rows="10" placeholder="Write long description"></textarea>
            @error('long_description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div> <button type="submit">Submit</button></div>
    </form>
@endsection
