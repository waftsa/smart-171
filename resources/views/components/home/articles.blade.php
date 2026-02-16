@props(['articles'])

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

