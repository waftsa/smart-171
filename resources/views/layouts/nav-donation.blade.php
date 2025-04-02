@auth
@else
<nav x-data="{ open: false, scrolled: false }"
    class="sticky top-0 z-50 transition-all duration-300 bg-[#1D4161]"
    :class="scrolled ? 'bg-[#1D4161]/85 shadow-lg backdrop-blur-md' : 'bg-transparent'"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 0 })">

    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-between px-3 py-2">
            <!-- Kembali ke Halaman Sebelumnya -->
            <div class="flex items-center">
                <button @click="window.history.back()" class="p-2 rounded-full hover:bg-[#1D4161]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" stroke="white" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                    </svg>
                </button>
            </div> 

            
            <!-- Search Bar di Tengah -->
            <form action="{{ route('donations.list') }}" method="GET" class="flex-1 mx-4">
                <input type="text" name="q" class="w-full px-4 py-2 rounded-full bg-transparent border text-white border-[#1D4161] focus:outline-none focus:ring-1 focus:ring-[#1D4161]"
                    placeholder="Cari Donasi..." required>
            </form>

            <!-- Logo di Pojok Kanan -->
            <div class="flex items-center">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('logos/iconsmart171putih.png') }}" alt="Logo" class="block h-10 w-auto">
                </a>
            </div>


            
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

    document.getElementById('searchInput').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault(); // Mencegah form submit default jika ada
        let query = this.value.trim();
        if (query) {
            window.location.href = `/donations/search?q=${encodeURIComponent(query)}`;
        }
    }
});
</script>
@endif
