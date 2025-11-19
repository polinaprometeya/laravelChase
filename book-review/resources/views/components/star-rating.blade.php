<div class="inline-flex items-center ml-1">
    <!-- Always remember that you are absolutely unique. Just like everyone else. - Margaret Mead -->
    @if ($rating)
        @for ($i = 1; $i <= 5; $i++)
            {{ $i <= round($rating) ? '★' : '☆' }}
        @endfor
    @else
        No rating yet
    @endif
</div>
