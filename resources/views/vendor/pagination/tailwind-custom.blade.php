@if ($paginator->hasPages())
<div id="pagination-anchor" class="mt-10 mb-2 flex flex-col items-center gap-2">

    {{-- Page info text --}}
    <p class="text-xs text-gray-500">
        Showing
        <span class="font-semibold text-gray-700">{{ $paginator->firstItem() }}</span>
        –
        <span class="font-semibold text-gray-700">{{ $paginator->lastItem() }}</span>
        of
        <span class="font-semibold text-gray-700">{{ $paginator->total() }}</span>
        results
    </p>

    <nav role="navigation" aria-label="Pagination Navigation">
        <ul class="flex items-center gap-1">

            {{-- Previous --}}
            <li>
                @if ($paginator->onFirstPage())
                    <span class="pagination-btn disabled" aria-disabled="true" aria-label="Previous">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}#pagination-anchor"
                       class="pagination-btn" aria-label="Previous">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                @endif
            </li>

            {{-- Page Numbers --}}
            @foreach ($elements as $element)

                {{-- Dots / ellipsis --}}
                @if (is_string($element))
                    <li>
                        <span class="pagination-dots">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li>
                            @if ($page == $paginator->currentPage())
                                <span class="pagination-btn active" aria-current="page">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}#pagination-anchor"
                                   class="pagination-btn" aria-label="Go to page {{ $page }}">
                                    {{ $page }}
                                </a>
                            @endif
                        </li>
                    @endforeach
                @endif

            @endforeach

            {{-- Next --}}
            <li>
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}#pagination-anchor"
                       class="pagination-btn" aria-label="Next">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @else
                    <span class="pagination-btn disabled" aria-disabled="true" aria-label="Next">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </span>
                @endif
            </li>

        </ul>
    </nav>
</div>

<style>
    .pagination-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 2.25rem;
        height: 2.25rem;
        padding: 0 .55rem;
        border-radius: 10px;
        font-size: .85rem;
        font-weight: 500;
        color: #374151;
        background: #fff;
        border: 1.5px solid #e5e7eb;
        cursor: pointer;
        text-decoration: none;
        transition: background .15s, border-color .15s, color .15s, box-shadow .15s, transform .1s;
        user-select: none;
        box-shadow: 0 1px 3px rgba(0,0,0,.06);
    }
    .pagination-btn:hover {
        background: #f3f4f6;
        border-color: #d1d5db;
        transform: translateY(-1px);
        box-shadow: 0 3px 8px rgba(0,0,0,.1);
    }
    .pagination-btn.active {
        background: #e16976;
        border-color: #e16976;
        color: #fff;
        box-shadow: 0 3px 10px rgba(225,105,118,.35);
        cursor: default;
        transform: none;
    }
    .pagination-btn.disabled {
        color: #d1d5db;
        background: #f9fafb;
        border-color: #f3f4f6;
        cursor: not-allowed;
        box-shadow: none;
    }
    .pagination-dots {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 2.25rem;
        height: 2.25rem;
        color: #9ca3af;
        font-size: .85rem;
        letter-spacing: .05em;
    }
</style>

{{-- Scroll to pagination section on page load if hash matches --}}
<script>
    (function () {
        if (window.location.hash === '#pagination-anchor') {
            var el = document.getElementById('pagination-anchor');
            if (el) {
                setTimeout(function () {
                    el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 80);
            }
        }
    })();
</script>
@endif