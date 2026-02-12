<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Artikel') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">

                @if($article->status)
                <span class="text-white font-bold bg-green-500 rounded-2xl w-fit p-5">
                    Berita telah dipublikasikan
                </span>
                @else
                <div class="flex flex-row justify-between">
                    <span class="text-white font-bold bg-yellow-500 rounded-2xl w-fit p-5">
                        Dokumentasi masih dalam status draft
                    </span>
                    <form action="{{ route('admin.articles.publish', $article) }}" method="POST">
                        @csrf
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Publish
                        </button>
                    </form>
                </div>
                @endif

                <hr>

                <div class="item-card flex flex-row gap-y-10 justify-between items-center">
                    <div class="flex flex-col">
                    <p class="text-slate-500 text-sm">Judul</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{ $article->title }}</h3>
                    </div>
                    <div class="flex flex-col">
                        @if($article->slider)
                        <div class="flex flex-row items-right gap-10">
                            <span class="w-fit text-sm font-bold py-2 px-3 rounded-full bg-blue-500 text-white">
                            Tampilkan pada slider
                            </span>                                                                                                                 
                        </div>
                        @else 
                        <div class="flex flex-row items-align-right gap-x-3">
                            <span class="w-fit text-sm font-bold py-2 px-3 rounded-full bg-orange-500 text-white">
                            Tidak ditampilkan pada slider
                            </span>
                        </div>
                        @endif
                    </div>
                    
                    
                </div>

                <hr class="my-3">
                <div class="flex flex-row justify-between items-center align-middle">
                    <div>
                        <p class="text-slate-500 text-sm">Dibuat oleh</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{ $article->user->name }}</h3>
                    </div>
                    <div>
                        <p class="text-slate-500 text-sm">Tanggal Dibuat</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{ $article->created_at->format('d M Y') }}</h3>
                    </div><div>
                        <p class="text-slate-500 text-sm">Cover</p>
                        <img src="{{ $article->cover }}" alt="{{ $article->title }}" class="rounded-2xl object-cover w-[120px] h-[90px]">
                    </div>
                </div>

                <hr class="my-5">
                <div class="flex flex-col">
                        <div>
                            <h3 class="text-indigo-950 text-xl font-bold">Summary Artikel</h3>
                            <p class="text-slate-500 text-m">{{ $article->summary }}</p>
                        </div> 
                </div>
                <div class="flex flex-col">
                        <div>
                            <h3 class="text-indigo-950 text-xl font-bold">Konten Artikel</h3>
                            <br>
                            <p class="text-slate-500 text-m">{!! $article->content !!}</p>
                        </div> 
                </div>

                <hr class="my-2">
                <div class="flex flex-row items-center gap-x-3">
                        <a href="{{ route('admin.articles.edit', $article) }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Edit
                        </a>
                        <form action="{{ route('admin.articles.destroy', $article) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-bold py-4 px-6 bg-red-700 text-white rounded-full">
                                Delete
                            </button>
                        </form>
                    </div>
            </div>
        </div>
    </div>


</x-app-layout>


