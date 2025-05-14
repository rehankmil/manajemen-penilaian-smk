@props([
    'href',
    'label',
    'icon' => 'fa-folder',
    'routeName' => null
])

@php
    $isActive = $routeName
        ? request()->routeIs($routeName)
        : request()->url() === url($href);
@endphp

<li class="nav-item {{ $isActive ? 'active' : '' }}">
    <a class="nav-link" href="{{ $href }}">
        <i class="fas fa-fw {{ $icon }}"></i>
        <span>{{ $label }}</span>
    </a>
</li>
