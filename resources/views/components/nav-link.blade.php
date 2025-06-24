@props(['route', 'label'])

@php
  $isActive = request()->routeIs($route);
@endphp

<a href="{{ route($route) }}"
   class="block px-4 py-2 rounded text-sm transition
          {{ $isActive ? 'bg-moss text-white' : 'text-snow hover:bg-moss hover:text-white' }}">
    {{ $label }}
</a>
