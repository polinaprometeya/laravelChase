<h1>Hello</h1>
<p>This is just a text</p>
{{-- directive -- this is everything that starts with @,
 this prevents errors and executes code conditionally --}}

@isset($name)
    <p>Welcome back: {{ $name }}</p>
@endisset()
