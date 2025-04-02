<x-app-layout>
    <div class="py-8 bg-white mt-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="absolute top-0 left-0 w-full h-36 bg-gradient-to-b from-[#1D4161] to-transparent pointer-events-none"></div>  

            <!-- Wrapper untuk SMART NEWS dan Search Bar -->
            <div class="flex justify-between items-center m-10">
                <a href="{{ route ('articles.list') }}">
                <h2 class="text-indigo-950 text-3xl font-bold">SMART NEWS</h2>
                </a>
                <div class="w-full sm:w-1/3 lg:w-1/4">
                    <!-- Search Bar -->
                    <form action="{{ route('articles.filter') }}" method="GET" class="flex items-center">
                        <input type="text" name="search" value="{{ request()->query('search') }}" 
                            placeholder="Cari Berita..." 
                            class="flex-grow px-4 py-2 rounded-lg rounded-tr-none rounded-br-none border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#e16976]" />
                        
                        <button type="submit" class="px-4 py-2 rounded-tl-none rounded-bl-none  bg-[#e16976] text-white rounded-lg hover:bg-[#d35866]">
                            Cari
                        </button>
                    </form>
                </div>
            </div>

            <!-- Filter Buttons -->
            <div class="flex justify-start gap-4 m-10">
                <a href="{{ route('articles.filter', ['sort_by' => 'newest']) }}" 
                   class="px-4 py-2 bg-white text-[#1D4161] border border-[#1D4161] rounded-xl hover:bg-[#1D4161] hover:text-white hover:border-[#1D4161]">
                    Terbaru
                </a>
                <a href="{{ route('articles.filter', ['sort_by' => 'oldest']) }}" 
                    class="px-4 py-2 bg-white text-[#1D4161] border border-[#1D4161] rounded-lg hover:bg-[#1D4161] hover:text-white hover:border-[#1D4161]">
                    Terlama
                </a>
                @foreach($categories as $category)
                <a href="{{ route('articles.filter', ['sort_by' => $sortBy, 'category' => $category->id]) }}" 
                    class="px-4 py-2 bg-white text-[#1D4161] border border-[#1D4161] rounded-lg hover:bg-[#1D4161] hover:text-white hover:border-[#1D4161]">
                    {{ $category->name }}
                </a>
                @endforeach
            </div>

            <!-- Artikel Listing -->
            <div class="m-10 bg-white">
                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($articles as $article)
                        <div class="mb-4">
                            <a href="{{ route('articles.show', $article) }}">
                                <div class="relative">
                                    <!-- Gambar Cover Artikel -->
                                    <img src="{{ $article->cover }}" alt="{{ $article->title }}" class="w-full md:h-28 ms:h-24 lg:h-48 object-cover rounded-md mb-3">
                                    
                                    <!-- Kategori di pojok kiri atas -->
                                    <span class="absolute top-2 left-2 bg-white text-[#1D4161] text-xs font-semibold px-2 py-1 rounded-xl">
                                        {{ $article->category?->name ?? 'Tanpa Kategori' }}
                                    </span>
                                </div>

                                <h3 class="font-semibold text-xl text-semibold">{{ $article->title }}</h3>
                                <p class="text-gray-500 text-sm">By
                                    <span class="inline-block text-[#e16976]">{{ $article->user->name }}</span>
                                    <span class="ml-2">{{ $article->updated_at->format('d M Y') }}</span>
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
