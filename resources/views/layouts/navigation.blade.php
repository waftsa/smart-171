@auth
@else

<nav x-data="{ open: false, scrolled: false }"
    class="sticky top-0 z-30 transition-all duration-300"
    :class="scrolled ? 'bg-[#1D4161]/85 shadow-lg backdrop-blur-md' : 'bg-transparent'"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 0 })">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-3 text-white">
            <!-- Logo -->
            <div class="ml-4">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('logos/logosmartputih.png') }}" alt="Logo" class="h-8 w-auto">
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden sm:flex space-x-6 mx-auto ">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'font-bold' : '' }}">
                    {{ __('Beranda') }}
                </a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'font-bold' : '' }}">
                    {{ __('Tentang Kami') }}
                </a>

                <!-- Dropdown Programs -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" @click.away="open = false"
                        class="flex items-center hover:text-white focus:outline-none">
                        {{ __('Programs') }}
                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition 
                        class="absolute mt-2 bg-[#1D4161]/85 rounded shadow-lg text-white w-48">
                        <a href="{{ route('donations.list') }}" class="block px-4 py-2 hover:bg-gray-200">Smart Campaign</a>
                        <a href="{{ route('ota.list') }}" class="block px-4 py-2 hover:bg-gray-200">Orang Tua Asuh</a>
                    </div>
                </div>

                <!-- Dropdown Aktivitas -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" @click.away="open = false"
                        class="flex items-center hover:text-white focus:outline-none">
                        {{ __('Aktivitas') }}
                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition 
                        class="absolute mt-2 bg-[#1D4161]/85 rounded shadow-lg text-white w-48">
                        <a href="{{ route('articles.list') }}" class="block px-4 py-2 hover:bg-gray-200">Smart News</a>
                        <a href="{{ route('releases.list') }}" class="block px-4 py-2 hover:bg-gray-200">Smart Releases</a>
                        <a href="{{ route('documentations.list') }}" class="block px-4 py-2 hover:bg-gray-200">Dokumentasi</a>
                    </div>
                </div>
            </div>

            <!-- Donate Button -->
            <div class="hidden sm:flex">
                <a href="{{ route( 'donations.list' )}}" class="bg-[#e98b94] text-white py-2 px-4 rounded-lg hover:text-white hover:bg-[#e16976]  ">
                    {{ __('Donasi Sekarang!') }}
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="-mr-2 flex sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-white focus:outline-none ">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div x-show="open" class="sm:hidden bg-[#1D4161]/50 shadow-lg py-4">
            <a href="{{ route('home') }}" class="block px-4 py-2 text-white hover:bg-gray-200">Beranda</a>
            <a href="{{ route('about') }}" class="block px-4 py-2 text-white hover:bg-gray-200">Tentang Kami</a>

            <!-- Mobile Dropdown Programs -->
            <div x-data="{ open: false }">
                <button @click="open = !open" class="block w-full px-4 py-2 text-left text-white hover:bg-gray-200">Programs</button>
                <div x-show="open" class="pl-6">
                    <a href="{{ route('donations.list') }}" class="block px-4 py-2 text-white hover:bg-gray-200">Smart Campaign</a>
                    <a href="{{ route('ota.list') }}" class="block px-4 py-2 text-white hover:bg-gray-200">Orang Tua Asuh</a>
                </div>
            </div>

            <!-- Mobile Dropdown Aktivitas -->
            <div x-data="{ open: false }">
                <button @click="open = !open" class="block w-full px-4 py-2 text-left text-white hover:bg-gray-200">Aktivitas 
        
                    </button>
                <div x-show="open" class="pl-6">
                    <a href="{{ route('articles.list') }}" class="block px-4 py-2 text-white hover:bg-gray-200">Smart News</a>
                    <a href="{{ route('releases.list') }}" class="block px-4 py-2 text-white hover:bg-gray-200">Smart Releases</a>
                    <a href="{{ route('documentations.list') }}" class="block px-4 py-2 text-white hover:bg-gray-200">Dokumentasi</a>
                </div>
            </div>

            <a href="{{ route('contact-us') }}" class="block px-4 py-2 text-white hover:bg-gray-200">Kotak Saran</a>
        </div>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const navbar = document.querySelector("nav");

        window.addEventListener("scroll", function () {
            if (window.scrollY > 50) {
                navbar.classList.add("nav-scrolled");
            } else {
                navbar.classList.remove("nav-scrolled");
            }
        });
    });
</script> 

@endauth
