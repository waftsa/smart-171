<section id="about" class="py-12 mt-24 text-center opacity-0 translate-y-10 transition-all duration-1000">
    <h1 class="text-5xl font-extrabold mb-4 text-[#1D4161] underline  decoration-[#e16976] underline-offset-4">Tentang Kami</h1>
    <div class="max-w-7xl mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 mt-10">
        <!-- Video Section -->
        <div class="text-center rounded-lg">
            <div class="flex justify-center h-full w-auto">
            <iframe class="rounded-lg w-full aspect-video" 
                src="https://www.youtube.com/embed/oad-GGe5GZI?autoplay=1&controls=1&showinfo=0&rel=0&modestbranding=1" 
                frameborder="0" allow="encrypted-media; fullscreen" allowfullscreen>
            </iframe>

            </div>
        </div>

        <!-- Text Section -->
        <div class="text-center p-6 rounded-lg md:rounded-l-none">
            <h3 class="mt-4 text-xl text-[#1D4161] max-w-3xl mx-auto">
                <span class="text-[#e16976] text-xl">"</span>
                SMART 171, Solidarity of Muslim for Al Quds Resist 171, ialah sebuah NGO yang fokus bergerak dalam isu kemanusiaan berlandaskan keadilan. Selain menyalurkan donasi, kami juga mengedukasi anak muda agar memahami dan peduli pada sesama.
                <span class="text-[#e16976] text-xl">"</span>
            </h3>
            <a href="{{ route('about') }}">
                <button class="border-2 border-[#1D4161] text-[#1D4161] p-2 w-max rounded-lg mt-4 flex items-center space-x-2 bg-transparent hover:bg-[#1D4161] hover:text-white transition mx-auto">
                    <span>Lihat Selengkapnya</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/>
                    </svg>
                </button>
            </a>
        </div>

    </div>


    <div class="text-center py-12">
        <h1 class="text-5xl font-extrabold mb-4 underline decoration-[#e16976] underline-offset-4 text-[#1D4161]">{{ __('Organisasi di bawah Kami') }}</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 justify-center items-center mt-8">
            <!-- Logo 1 -->
            <img src="{{ asset('logos/baikberisik-non-bg.png') }}" alt="baik-berisik" class="h-24 w-auto mx-auto">

            <!-- Logo 2 -->
            <img src="{{ asset('logos/pals-non-bg.png') }}" alt="pals" class="h-24 w-auto mx-auto">

            <!-- Logo 3 -->
            <img src="{{ asset('logos/ruqu-non-bg.png') }}" alt="ruqu" class="h-24 w-auto mx-auto">
        </div>
    </div>
    </div>
</section>
