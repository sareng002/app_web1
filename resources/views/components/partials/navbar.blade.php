<nav class="bg-slate-800 text-white shadow-lg sticky top-0 z-50">
    <div class="flex items-center justify-between h-18 px-8">

        <!-- Logo -->
        <div class="flex items-center justify-between px-6 py-4">

            <div class="flex items-center gap-4">

                <button @click="mobileOpen = true" class="md:hidden">
                    <x-icon.menu />
                </button>

                <span class="text-2xl font-bold">
                    AppWeb
                </span>

            </div>

        </div>

        <!-- Menu -->
        <div class="flex items-center gap-10 text-lg">

            <a href="/" class="hover:text-yellow-400 transition flex items-center gap-2">
                <x-icon.home class="flex items-center" />
                Home
            </a>

            <a href="/products" class="hover:text-yellow-400 transition flex items-center gap-2">
                <x-icon.product class="flex items-center" />
                products
            </a>

            <a href="/about" class="hover:text-yellow-400 transition flex items-center gap-2">
                <x-icon.tentang class="flex items-center" />
                About
            </a>

            <a href="/login" class="hover:text-yellow-400 transition flex items-center gap-2">
                <x-icon.user class="flex items-center" />
                Login
            </a>

        </div>

    </div>
</nav>
