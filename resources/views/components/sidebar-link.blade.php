@props(['href', 'active' => false])

<li>
    <a href="{{ $href }}" :class="collapsed ? 'justify-center' : ''"
        class="flex items-center gap-3 p-4 hover:bg-slate-700 transition-all duration-300
        {{ $active ? 'bg-slate-800 border-l-4 border-yellow-400 text-yellow-300' : '' }}">

        {{ $icon }}

        <span x-show="!collapsed" x-transition.opacity.duration.200ms>
            {{ $slot }}
        </span>

    </a>
</li>
