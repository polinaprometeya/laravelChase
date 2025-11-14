<!DOCTYPE html>
<html>

<head>
    <title>To-do list</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @yield('style')
</head>

<body class="container mx-auto ml-10 mb-10 max-w-lg">
    <h1 class="mb-4 text-2xl">@yield('title')</h1>
    <div>
        @if (session()->has('success'))
            <alert>{{ session('success') }}</alert>
        @endif
        @yield('content')
    </div>
</body>

</html>
