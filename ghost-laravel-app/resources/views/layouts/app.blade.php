<!DOCTYPE html>
<html>

<head>
    <title>To-do list</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>


    {{-- blade-formatter-disable --}}
    <style type="text/tailwindcss">
        @layer utilities {
            .content-auto {
                content-visibility: auto;
            }

            .btn {
                @apply rounded-md px-2 py-1 text-center font-medium text-slate-700 shadow-sm ring-1 ring-slate-700/10 hover:bg-slate-100;
            }

            .link {
                @apply font-medium text-gray-700 underline decoration-pink-200;
            }
        }
    </style>
    {{-- blade-formatter-enable --}}

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
