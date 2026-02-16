@props(['sliders'])

<section id="landing" class="relative w-full h-[550px] overflow-hidden z-0">
    @if($sliders->isNotEmpty())
    <div class="absolute inset-0 animate-fade-slide">
        @foreach ($sliders as $index => $slider)
        <div class="slide absolute inset-0 w-full h-full transition-opacity duration-1000 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"
            style="background: url('{{ $slider->thumbnail ?? $slider->cover }}') center/cover no-repeat;" 
            loading="lazy"
            decoding="async">
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
