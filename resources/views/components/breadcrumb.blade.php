@php
  $segments = Request::segments();
@endphp

<nav class="flex mb-4" aria-label="Breadcrumb">
  <ol class="inline-flex items-center space-x-1 md:space-x-3">
    {{-- Link Home --}}
    <li class="inline-flex items-center">
      <span href="{{ url('/') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-600">
        Home
      </span>
    </li>

    {{-- Loop segment URL --}}
    @foreach ($segments as $index => $segment)
      <li class="flex items-center">
        {{-- Icon panah --}}
        <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10
                    7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0
                    010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
        </svg>

        @php
          $label = ucwords(str_replace('-', ' ', $segment)); // ubah '-' jadi spasi + kapital tiap kata
        @endphp

        {{-- Link untuk segment kecuali terakhir --}}
        @if ($index + 1 < count($segments))
          <span href="{{ url(implode('/', array_slice($segments, 0, $index + 1))) }}"
            class="text-sm font-medium text-gray-700 hover:text-green-600">
            {{ $label }}
          </span>
        @else
          <span class="text-sm font-medium text-gray-500">{{ $label }}</span>
        @endif
      </li>
    @endforeach
  </ol>
</nav>
