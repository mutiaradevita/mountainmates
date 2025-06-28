@props(['route', 'label', 'icon'])

@php
  $active = request()->routeIs($route) ? 'bg-moss text-white' : 'hover:bg-forest';
@endphp

<a href="{{ route($route) }}" class="flex items-center gap-3 px-4 py-2 rounded-md transition {{ $active }}" title="{{ $label }}">
  {{-- Ikon --}}
  @switch($icon)
    @case('dashboard')
      <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path d="M3 3h7v7H3zM14 3h7v4h-7zM14 10h7v11h-7zM3 14h7v7H3z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      @break
    @case('newspaper')
      <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path d="M19 20H5a2 2 0 01-2-2V7a2 2 0 012-2h10l6 6v7a2 2 0 01-2 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M17 13H7v-2h10v2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      @break
    @case('users')
      <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path d="M17 21v-2a4 4 0 00-3-3.87M7 21v-2a4 4 0 013-3.87M12 7a4 4 0 110-8 4 4 0 010 8zM5.33 17A6.66 6.66 0 0112 15a6.66 6.66 0 016.67 2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
      @break
    @case('mountains')
      <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path d="M3 20h18l-9-16-9 16z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
      @break
    @case('wallet')
      <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path d="M4 7h16v10H4zM4 7V5a2 2 0 012-2h12a2 2 0 012 2v2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <circle cx="16" cy="12" r="1" fill="currentColor"/>
      </svg>
      @break
    @case('plus')
      <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      @break
  @endswitch

  {{-- Label teks --}}
  <template x-if="!sidebarCollapsed">
    <span class="whitespace-nowrap">{{ $label }}</span>
  </template>
</a>
