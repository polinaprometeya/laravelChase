@extends('layouts.app')

@section('content')
    <h1 class="mb-10 text-2xl">Book Reviews</h1>

    <Form method="GET" action="{{ route('books.index') }}" class="mb-4 flex items-center space-x-2">
        @csrf
        <input type="text" name="title" placeholder="Search book by title " class="input"
            value="{{ request('title') }}"></input>
        <input type="hidden" name="filter" value="{{ request('filter') }}"></input>
        <button type="submit" class="btn h-10">Search</button>
        <a href="{{ route('books.index') }}" class="btn h-10">Clear</a>
    </Form>

    <div class="filter-container mb-4 flex">
        @php
            $filters = [
                '' => 'Latest',
                'popular_last_month' => 'Popular Last Month',
                'popular_last_quarter' => 'Popular Last Quarter',
                'highest_rated_last_month' => 'Highest Rated Last Month',
                'highest_rated_last_quarter' => 'Highest Rated Last Quarter',
            ];
        @endphp

        @foreach ($filters as $key => $label)
            <a href="{{ route('books.index', [...request()->query(), 'filter' => $key]) }}"
                class="{{ request('filter') === $key || (request('filter') === null && $key === '') ? 'filter-item-active' : 'filter-item' }}">
                {{ $label }}
            </a>
        @endforeach

    </div>

    <ul>
        @forelse ($books as $book)
            <li class="mb-4">
                <div class="book-item">
                    <div class="flex flex-wrap items-center justify-between">
                        <div class="w-full grow sm:w-auto">
                            <a href="{{ route('books.show', $book) }}" class="book-title">{{ $book->title }}</a>
                            <span class="book-author">{{ $book->author }}</span>
                        </div>
                        <div>
                            <div class="book-rating">
                                {{ number_format($book->reviews_avg_rating, 1) }}
                                <x-star-rating :rating="$book->reviews_avg_rating"></x-star-rating>
                            </div>
                            <div class="book-review-count">
                                out of {{ $book->reviews_count }}
                                {{ Str::plural('review', $book->reviews_count) }}
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @empty
            <li class="mb-4">
                <div class="empty-book-item">
                    <p class="empty-text">No books found</p>
                    <a href="{{ route('books.index') }}" class="reset-link">Reset criteria</a>
                </div>
            </li>
        @endforelse
    </ul>

    @if ($books->count())
        <nav class="mt-4">{{ $books->links() }}</nav>
    @endif
    {{-- <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-slate-800">Books</h1>
        <a href="{{ route('books.index') }}" class="reset-link text-sm">Reset filters</a>
    </div>

    <form method="GET" action="{{ route('books.index') }}" class="filter-container mb-8">
        <label class="flex-1">
            <span class="sr-only">Title filter</span>
            <input
                type="text"
                name="title"
                value="{{ request('title') }}"
                placeholder="Filter by title..."
                class="input"
            />
        </label>
        <button type="submit" class="btn h-auto">Search</button>
    </form>

    <div class="space-y-4">
        @forelse ($books as $book)
            <article class="book-item">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="book-title">{{ $book->title }}</p>
                        <span class="book-author">by {{ $book->author }}</span>
                    </div>
                    <span class="text-xs text-slate-500">{{ $book->created_at->format('M j, Y') }}</span>
                </div>
            </article>
        @empty
            <div class="empty-book-item">
                <p class="empty-text">No books found.</p>
                @if (request('title'))
                    <p class="text-xs text-slate-500 mt-2">Try shortening or clearing your search.</p>
                @endif
            </div>
        @endforelse
    </div> --}}
@endsection
