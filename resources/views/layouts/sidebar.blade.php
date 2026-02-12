<div x-data="{ open: false }" class="flex h-screen">
    <!-- Sidebar -->
    <div :class="{ 'translate-x-0': open, '-translate-x-full': !open }" 
        class="fixed inset-y-0 left-0 w-56 bg-white border-r transform transition-transform duration-200 ease-in-out sm:translate-x-0">
        <!-- Logo -->
        <div class="h-16 flex items-center px-4 border-b">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('smart171.png') }}" alt="Logo" class="block h-9 w-auto">
            </a>
        </div>

        <!-- Navigation Links -->
        <nav class="mt-16">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-800">
                {{ __('Dashboard') }}
            </a>
            <a href="{{ route('admin.donations.index') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-800">
                {{ __('Kelola Donasi') }}
            </a>
            <a href="{{ route('admin.donaturs.index') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-800">
                {{ __('List Donaturs') }}
            </a>
            <a href="{{ route('admin.documentations.index') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-800">
                {{ __('Dokumentasi') }}
            </a>
            <a href="{{ route('admin.articles.index') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-800">
                {{ __('Smart News') }}
            </a>
            <a href="{{ route('admin.releases.index') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-800">
                {{ __('Smart Releases') }}
            </a>
            <a href="{{ route('admin.bulletins.index') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-800">
                {{ __('Smart Buletin') }}
            </a>
            <a href="{{ route('admin.categories.index') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-800">
                {{ __('Kelola Kategorisasi') }}
            </a>
            <a href="{{ route('admin.services.index') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-800">
                {{ __('Customer Service') }}
            </a>
            <a href="{{ route('admin.sliders.index') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-800">
                {{ __('Slider') }}
            </a>
        </nav>

        <!-- Logout -->
        <div class="absolute bottom-0 w-full px-4 py-4 border-t">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-800">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>

    <!-- Content Area -->
    <div class="flex-1 flex flex-col">
        <!-- Mobile Hamburger Button -->
        <div class="sm:hidden p-2 bg-gray-100 border-b">
            <button @click="open = !open" class="p-2 rounded-md text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

    </div>
</div>

