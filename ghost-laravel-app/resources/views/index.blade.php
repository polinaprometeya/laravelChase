<h1>Welcome</h1>

{{-- directive -- this is everything that starts with @,
 this prevents errors and executes code conditionally --}}
{{-- @isset($name) <p>Welcome back: {{ $name }}</p>@endisset() --}}

<div>
    {{-- @if (count($tasks))
    //this dumps all tasks as a list the same as foreach
    , but it have built in if else feature .  <div>Todays to-do's</div> @foreach ($tasks as $task)
    <li>{{ $task->title }}</li>  @endforeach @else <p> There are no tasks</p> @endif --}}


    <h3>Todays to-do's: </h3>

    @forelse ($tasks as $task)
        <div>
            <a href="{{ route('tasks.show', ['id' => $task->id]) }}">
                <li>{{ $task->title }}</li>
            </a>
        </div>
    @empty
        <p>There are no tasks</p>
    @endforelse
</div>
