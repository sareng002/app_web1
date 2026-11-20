<!-- Overlay Mobile -->
<div x-show="mobileOpen" @click="mobileOpen = false" x-transition.opacity class="fixed inset-0 bg-black/50 z-40 md:hidden">
</div>

<aside
    :class="[
        collapsed ? 'w-20' : 'w-64',
        mobileOpen ? 'translate-x-0' : '-translate-x-full',
        'md:translate-x-0'
    ]"
    class="sticky top-0 h-screen
               bg-slate-600 text-white
               transition-all duration-300">

    <!-- Header -->
    <div class="p-4 mt-2">

        <button @click="collapsed = !collapsed" :class="collapsed ? 'justify-center' : 'justify-between'"
            class="flex items-center w-full">

            <h2 x-show="!collapsed" x-transition.opacity.duration.300ms class="font-bold text-xl">
                Menu
            </h2>

            <span x-show="!collapsed" x-transition.opacity>
                <x-icon.tutup />
            </span>

            <span x-show="collapsed" x-transition.opacity>
                <x-icon.menu />
            </span>

        </button>

    </div>

    <!-- Menu -->
    <ul class="mt-6 space-y-2">

        <x-sidebar-link href="/" :active="request()->is('/')">
            <x-slot:icon>
                <x-icon.home class="w-6 h-6" />
            </x-slot:icon>

            Home
        </x-sidebar-link>
        <x-sidebar-link href="/products" :active="request()->is('products*')">
            <x-slot:icon>
                <x-icon.product class="w-6 h-6" />
            </x-slot:icon>

            Products
        </x-sidebar-link>
        <x-sidebar-link href="/about" :active="request()->is('about')">
            <x-slot:icon>
                <x-icon.tentang class="w-6 h-6" />
            </x-slot:icon>

            About
        </x-sidebar-link>

        <x-sidebar-link href="/login" :active="request()->is('login')">
            <x-slot:icon>
                <x-icon.user class="w-6 h-6" />
            </x-slot:icon>

            Login
        </x-sidebar-link>


    </ul>
</aside>
