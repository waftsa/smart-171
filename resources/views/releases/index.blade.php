<x-app-layout>
    <div class="py-8 bg-white mt-16">
    <div class="absolute top-0 left-0 w-full h-36 bg-gradient-to-b from-[#1D4161] to-transparent pointer-events-none"></div>  

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-indigo-950 text-3xl font-bold mb-8 mr-8">SMART RELEASES</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 mr-2 ml-2 ">
                @foreach ($releases as $index => $release)
                    <div class="relative bg-white shadow-md overflow-hidden">
                        <a href="{{ route('releases.show', $release) }}">
                            <!-- Cover Image -->
                            <div class="relative">
                            <img src="{{ $release->cover }}" alt="{{ $release->title }}" class="w-full h-52 object-cover">
                                <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-end p-2">
                                @if($index < 3)
                                    <span class="absolute top-2 left-2 bg-[#e16976] text-white text-xs font-semibold px-2 py-1 rounded-xl">TERBARU</span>
                                @endif
                                    <h2 class="text-lg font-semibold text-gray-100">{{ $release->title }}</h2>
                                    <p class="text-sm mt-1 text-gray-100">
                                        {{ $release->updated_at->format('d M Y') }} - {{ $release->category?->name ?? 'Tanpa Kategori' }}
                                    </p>
                                </div>
                            </div>
                        </a>                      
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
