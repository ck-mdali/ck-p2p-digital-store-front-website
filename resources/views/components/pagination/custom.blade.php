@if ($paginator->hasPages())
    <nav class="flex justify-center mt-4">
        <ul class="inline-flex items-center space-x-1">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="px-3 py-1 text-gray-400 border border-gray-300 rounded-md">Previous</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-100">
                        Previous
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li><span class="px-3 py-1 text-gray-400">{{ $element }}</span></li>
                @endif

                {{-- Page Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span class="px-3 py-1 bg-indigo-600 text-white border border-indigo-600 rounded-md">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="px-3 py-1 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-100">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-100">
                        Next
                    </a>
                </li>
            @else
                <li>
                    <span class="px-3 py-1 text-gray-400 border border-gray-300 rounded-md">Next</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
