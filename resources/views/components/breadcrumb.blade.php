<nav class="text-sm text-gray-500 mb-4" aria-label="Breadcrumb">
    <ol class="list-reset flex space-x-2">
        @foreach ($items as $item)
            @if (!$loop->last)
                <li>
                    <a href="{{ $item['url'] }}" class="hover:text-indigo-600">{{ $item['label'] }}</a>
                    <span class="mx-2">/</span>
                </li>
            @else
                <li class="text-gray-700 font-semibold" aria-current="page">{{ $item['label'] }}</li>
            @endif
        @endforeach
    </ol>
</nav>
