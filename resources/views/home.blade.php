<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.rawgit.com/inorganik/countUp.js/1.9.3/dist/countUp.min.js"></script> <!-- Load CountUp.js -->

</head>
<body>

<x-app-layout>
    
<section id="landing" class="relative w-full h-[550px] overflow-hidden z-0">
    @if($sliders->isNotEmpty())
    <div class="absolute inset-0 animate-fade-slide">
        @foreach ($sliders as $index => $slider)
        <div class="slide absolute inset-0 w-full h-full transition-opacity duration-1000 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"
            style="background: url('{{ $slider->thumbnail ?? $slider->cover }}') center/cover no-repeat;">
            <div class="absolute inset-0 flex justify-start items-start">
                <div class="md:w-full w-full h-full bg-gradient-to-r from-[#1D4161] to-transparent pt-32 md:pt-48 p-6 md:p-10 text-left z-10 transform">
                    <h1 class="text-3xl md:text-3xl font-bold text-gray-100">{{ $slider->title ?? $slider->name }}</h1>
                    <p class="mt-2 mb-10 max-w-md md:max-w-lg text-gray-100 text-sm md:text-lg">{{ $slider->caption ?? $slider->thumbnail_text ?? $slider->summary }}</p>
                    <a href="{{ url($slider->type . '/' . $slider->slug) }}" 
                        class="mt-16 md:mt-10 bg-gray-100 text-[#1D4161] py-2 px-4 rounded-lg hover:bg-[#1D4161] hover:text-gray-100">
                        Lihat Detail
                    </a>

                </div>
            </div>
            @if(isset($slider->youtube)) 
                @php
                    $youtubeLink = $slider->youtube;
                    if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/|.*v=))([\w-]+)/', $youtubeLink, $matches)) {
                        $videoId = $matches[1];
                    }
                @endphp
                @if (isset($videoId))
                    <div class="absolute inset-0">
                        <iframe width="100%" height="100%" 
                            src="https://www.youtube.com/embed/{{ $videoId }}?autoplay=1&mute=1&controls=0&showinfo=0&rel=0&autohide=0&modestbranding=1&loop=1&playlist={{ $videoId }}" 
                            frameborder="0" 
                            allow="autoplay; fullscreen;" 
                            allowfullscreen>
                        </iframe>
                    </div>
                @endif
            @else
                <div class="absolute inset-0">
                    <img src="{{ Storage::url($slider->thumbnail ?? $slider->cover) }}" 
                        
                        class="w-full h-full object-cover sm:object-center md:object-top max-h-screen">
                </div>
            @endif
        </div>
        @endforeach
    </div>

    <script>
            document.addEventListener("DOMContentLoaded", function () {
                const slides = document.querySelectorAll('#landing .slide');
                let currentSlide = 0;

                setInterval(() => {
                    slides[currentSlide].classList.remove('opacity-100');
                    slides[currentSlide].classList.add('opacity-0');

                    currentSlide = (currentSlide + 1) % slides.length;

                    slides[currentSlide].classList.remove('opacity-0');
                    slides[currentSlide].classList.add('opacity-100');
                }, 7500);
            });
        </script> 
    @endif
</section>

<section id="countUp" class="absolute top-[520px] left-0 right-0 z-10">
    <script type="module" src="https://cdn.jsdelivr.net/npm/countup.js@2.6.2/dist/countUp.min.js"></script>

    <div class="flex justify-center">
        <div class="bg-white rounded-lg shadow-lg w-max">
            <div class="grid grid-cols-3 sm:grid-cols-3 gap-2">

                <!-- Programs -->
                <div class="text-[#1D4161] p-4 text-center" id="programs">
                    <h3 class="text-xs sm:text-sm md:text-md font-semibold">Program Donasi</h3>
                    <p class="mt-2 text-sm sm:text-base md:text-xl">
                        <span id="programs-count">0</span><span class="text-xs align-top ml-1 text-gray-500">++</span>
                    </p>
                </div>

                <!-- Orang Tua Asuh -->
                <div class="text-[#1D4161] p-4 text-center" id="ortu-asuh">
                    <h3 class="text-xs sm:text-sm md:text-md font-semibold">Anak Asuh Yatim Gaza</h3>
                    <p class="mt-2 text-sm sm:text-base md:text-xl">
                        <span id="ortu-asuh-count">0</span><span class="text-xs align-top ml-1 text-gray-500">++</span>
                    </p>
                </div>

                <!-- Jumlah Donasi -->
                <div class="text-[#1D4161] p-4 text-center" id="donation">
                    <h3 class="text-xs sm:text-sm md:text-md font-semibold">Penerima Manfaat</h3>
                    <p class="mt-2 text-sm sm:text-base md:text-xl">
                        <span id="donation-count">0</span><span class="text-xs align-top ml-1 text-gray-500">++</span>
                    </p>
                </div>

            </div>
        </div>
    </div>

    <!-- Pakai script JS kamu di bawah ini -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function startCountUp(elementId, startVal, endVal, decimals, duration) {
                const countUp = new CountUp(elementId, startVal, endVal, decimals, duration);
                if (!countUp.error) {
                    countUp.start();
                } else {
                    console.error(countUp.error);
                }
            }

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        if (entry.target.id === "programs") {
                            startCountUp('programs-count', 0, 50, 0, 2.5);
                        } else if (entry.target.id === "ortu-asuh") {
                            startCountUp('ortu-asuh-count', 0, 3000, 0, 2.5);
                        } else if (entry.target.id === "donation") {
                            startCountUp('donation-count', 0, 10000, 0, 2.5);
                        }
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            observer.observe(document.getElementById('programs'));
            observer.observe(document.getElementById('ortu-asuh'));
            observer.observe(document.getElementById('donation'));
        });
    </script>
</section>

    <!-- About Us Section -->
<section id="about" class="py-12 mt-24 text-center opacity-0 translate-y-10 transition-all duration-1000">
    <h1 class="text-5xl font-extrabold mb-4 text-[#1D4161] underline  decoration-[#e16976] underline-offset-4">Tentang Kami</h1>
    <div class="max-w-7xl mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 mt-10">
        <!-- Video Section -->
        <div class="text-center rounded-lg">
            <div class="flex justify-center h-full w-auto">
            <iframe class="rounded-lg w-full aspect-video" 
                src="https://www.youtube.com/embed/oad-GGe5GZI?autoplay=1&controls=1&showinfo=0&rel=0&modestbranding=1" 
                frameborder="0" allow="autoplay; encrypted-media; fullscreen" allowfullscreen>
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

<!-- Donations Section -->
<section id="donations" class="py-12 relative bg-cover bg-center opacity-0 translate-y-10 transition-all duration-1000" style="background-image: url('{{ asset('images/default.jpg') }}'); background-size: cover;">
    <div class="absolute inset-0 bg-[#1D4161] opacity-75"></div> <!-- Blue overlay with 25% opacity -->
    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <h1 class="text-5xl font-extrabold text-center mb-4 text-gray-100 underline  decoration-[#e16976] underline-offset-4">Smart Campaign</h1>
        <br><br>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($donations->sortByDesc('created_at')->take(3) as $donation)

                <div class="bg-white p-4 shadow-md rounded-md transform transition duration-300 hover:scale-105">
                    <img src="{{ $donation->thumbnail }}" alt="{{ $donation->name }}" class="w-full h-36 object-cover rounded-t-md">
                    <br>
                    <h3 class="mt-2 font-bold text-xl text-center">{{ $donation->name }}</h3>
                    <hr class="my-4">
                    <!-- Terkumpul dan Target di baris atas -->
                    <div class="flex justify-between items-center mb-4">
                        <!-- Terkumpul Section - Left -->
                        <div class="flex flex-col items-start">
                            <p class="text-slate-500 text-sm">
                                 <strong class="text-[#1D4161] text-m">Rp {{ number_format($donation->donaturs->sum('total_amount'), 0, ',', '.') }}</strong> 
                                 terkumpul dari Rp {{ number_format($donation->target_amount, 0, ',', '.') }}
                            </p>
                            
                        </div>
                    </div>

                    <!-- Progress Bar di baris bawah -->
                    <div class="flex justify-between items-center">
                        <div class="w-full rounded-full h-2.5 bg-slate-300">
                            <div class="bg-[#1D4161] h-2.5 rounded-full" style="width: {{ ($donation->donaturs->sum('total_amount') / $donation->target_amount) * 100 }}%"></div>
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex flex-col items-start">
                            <p class="text-slate-500 text-sm">Tersisa 
                                 <strong class="text-[#e16976] text-m">Rp {{ number_format($donation->target_amount - $donation->donaturs->sum('total_amount'), 0, ',', '.') }}</strong> 
                            </p>   
                        </div>
                    </div>
                    
                    <div class="mt-4 text-center">
                        <a href="{{ route('donations.donate', $donation) }}" class="inline-block bg-[#1D4161] text-white py-2 px-6 rounded-lg hover:bg-[#163D51]">
                        Beri Donasi Sekarang
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-6 text-center">
            <a href="{{ route('donations.list') }}" class="text-white font-semibold">Lihat Donasi Lainnya</a>
        </div>
    </div>
</section>

<!-- Documentation Section -->
<section id="documentations" class="py-12 bg-[#ccddee]  opacity-0 translate-y-10 transition-all duration-1000">
    <div class="max-w-7xl mx-auto px-4">
    <h1 class="text-5xl font-extrabold text-center mb-4 text-[#1D4161] underline  decoration-[#e16976] underline-offset-4">Dokumentasi Penyaluran</h1>
        <br><br>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 bg-white rounded-lg p-4 ml-3 mr-3">
            <!-- Latest Documentation Video -->
            <div class="col-span-1 lg:col-span-2">
                @php
                    $latestDocumentation = $documentations->first(); // Get the latest documentation
                    // Extract YouTube video ID
                    $youtubeLink = $latestDocumentation->youtube;
                    if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/|.*v=))([\w-]+)/', $youtubeLink, $matches)) {
                        $videoId = $matches[1];
                        $thumbnailUrl = "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg";
                    } else {
                        $thumbnailUrl = null; // Handle non-YouTube URL case
                    }
                @endphp
                <h2 class="mt-2 mb-2 font-bold text-2xl text-center">{{ $latestDocumentation->title }}</h2>
                @if ($thumbnailUrl)
                        <!-- YouTube iframe -->
                        <iframe class="w-full aspect-video rounded-lg mt-2" src="https://www.youtube.com/embed/{{ $videoId }}?autoplay=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                @endif
                <p class="mt-4 text-slate-600 text-m ">{{ $latestDocumentation->caption }}</p>
                
            </div>

            <!-- List of Other Documentations -->
            <div class="col-span-1">
                <p class="text-lg font-semibold mb-5 mt-10">Dokumentasi Lainnya</p>
                <div class="space-y-4 max-h-96 overflow-y-auto scrollbar-thin">
                    @foreach($documentations->skip(1) as $documentation)
                        @php
                            $youtubeLink = $documentation->youtube;
                            if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/|.*v=))([\w-]+)/', $youtubeLink, $matches)) {
                                $videoId = $matches[1];
                                $thumbnailUrl = "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg";
                            } else {
                                $thumbnailUrl = null; // Handle non-YouTube URL case
                            }
                        @endphp
                        
                        <div class="flex items-center space-x-2">
                            @if ($thumbnailUrl)
                                <div class="w-24 h-16">
                                    <img src="{{ $thumbnailUrl }}" alt="YouTube Thumbnail" class="rounded-lg w-full h-full object-cover">
                                </div>
                            @endif
                            
                            <div class="flex-1"><a href="{{ route('documentations.show', $documentation) }}">
                                <p class="font-semibold text-ml">{{ $documentation->title }}</p>
                                <p class="text-sm text-gray-500">{{ $documentation->updated_at->format('d M Y') }}</p>
                                </a>
                            </div>
                        </div>
                        <hr class="my-3">
                    @endforeach
                    <div class="mt-6 text-center">
                        <a href="{{ route('documentations.list') }}" class="text-[#1D4161] font-semibold">Lihat Dokumentasi Lainnya</a>
                    </div>         

                </div>
            </div>
        </div>


    </div>
</section>

<!-- Articles Section -->
<section id="articles" class="py-12 bg-[#1D4161]  opacity-0 translate-y-10 transition-all duration-1000">
    <div class="max-w-7xl mx-auto px-4">
    <h1 class="text-5xl font-extrabold text-center mb-4 text-gray-100 underline  decoration-[#e16976] underline-offset-4">Smart News</h1>
        <br><br>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ml-3 mr-3">
            <div class="grid grid-cols-1 lg:grid-cols-3 ">
                
                <!-- Gambar Besar - Artikel Terbaru -->
                <div class="lg:col-span-2 relative bg-cover bg-center text-white" style="background-image: url('{{ $articles->first()->cover }}'); height: 400px;">
                    <a href="{{ route('articles.show', $articles->first())}}">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-end p-2">
                        <span class="bg-[#e16976] text-xs font-semibold px-2 py-1 mb-2 inline-block w-[70px]">TERBARU</span>
                        <h1 class="text-2xl font-bold">{{ $articles->first()->title }}</h1>
                        <p class="text-sm mt-1">
                            By {{ $articles->first()->user->name }} - {{ $articles->first()->updated_at->format('d M Y') }}
                        </p>
                    </div>
                    </a>
                </div>
                <!-- Grid 2x2 - 4 Artikel Lainnya -->
                <div class="md:grid md:grid-cols-2 flex overflow-x-auto">
                    @foreach ($articles->slice(1, 4) as $article)
                        <div class="flex-none md:flex-auto w-48 md:w-auto h-48 relative bg-cover bg-center text-white" style="background-image: url('{{ $article->cover }}'); height: 200px;">
                            <a href="{{ route('articles.show', $article) }}">
                            <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-end p-2">
                                <span class="bg-[#e16976] text-xs font-semibold px-2 py-1 mb-1 inline-block w-[70px]">TERBARU</span>
                                <h2 class="text-sm font-semibold">{{ $article->title }}</h2>
                                <p class="text-xs mt-1">
                                    {{ $article->updated_at->format('d M Y') }}
                                </p>
                            </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('articles.list') }}" class="text-white font-semibold">Lihat Berita Lainnya</a>
        </div>
    </div>
</section>

<!-- Releases Section -->
<section id="releases" class="py-12 bg-[#1D4161] opacity-0 translate-y-10 transition-all duration-1000">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-5xl font-extrabold text-center mb-4 text-gray-100 underline decoration-[#e16976] underline-offset-4">
            Smart Releases
        </h1>
        <br><br>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ml-3 mr-3">
        <div class="grid grid-cols-1 lg:grid-cols-3">
            @foreach ($releases as $release)
                <div class="relative bg-cover bg-center text-white" 
                     style="background-image: url('{{ $release->cover }}'); height: 300px;">
                    <a href="{{ route('releases.show', $release) }}">
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-end p-4">
                            <h3 class="font-bold text-lg">{{ $release->title }}</h3>
                            <p class="text-sm">
                                By <span class="text-[#e16976]">{{ $release->user->name }}</span>
                                <span class="ml-2">{{ $release->updated_at->format('d M Y') }}</span>
                            </p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        </div>
        <div class="mt-6 text-center">
            <a href="{{ route('releases.list') }}" class="text-white font-semibold">Lihat Release Lainnya</a>
        </div>
    </div>
</section>

</x-app-layout>

</body>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const sections = document.querySelectorAll("section");

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("opacity-100", "translate-y-0");
                    entry.target.classList.remove("opacity-0", "translate-y-10");
                    observer.unobserve(entry.target); // Hanya animasi 1x saat pertama terlihat
                }
            });
        }, { threshold: 0.2 });

        sections.forEach(section => {
            observer.observe(section);
        });
    });
</script>

