@extends('layouts.app')

@section('title', 'Create Task')

@section('content')
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        {{-- //this csrf directive middleware that protects you from scrip hack attacks. --}}

        <div>
            <label for="title">Title</label>
            <input id="id" name="title" type="text" required placeholder="Write title"></input>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="5" required placeholder="Write short description"></textarea>
        </div>
        <div>
            <label></label>
            <textarea id="long_description" name="long_description" rows="10" placeholder="Write long description"></textarea>
        </div>
        <div> <button type="submit">Submit</button></div>
    </form>
@endsection
