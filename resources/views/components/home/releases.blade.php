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

