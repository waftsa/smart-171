<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Dokumentasi') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">

                @if($documentation->status)
                    <span class="text-white font-bold bg-green-500 rounded-2xl w-fit p-5">
                        Dokumentasi telah dipublikasikan
                    </span>
                @else
                    <div class="flex flex-row justify-between">
                        <span class="text-white font-bold bg-yellow-500 rounded-2xl w-fit p-5">
                            Dokumentasi masih dalam status draft
                        </span>
                        <form action="{{ route('admin.documentations.publish', $documentation) }}" method="POST">
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
                        <h3 class="text-indigo-950 text-xl font-bold">{{ $documentation->title }}</h3>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-slate-500 text-sm">Dibuat oleh</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{ $documentation->user->name }}</h3>
                    </div>
                    <div class="flex flex-row items-center gap-x-3">
                        <a href="{{ route('admin.documentations.edit', $documentation) }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Edit
                        </a>
                        <form action="{{ route('admin.documentations.destroy', $documentation) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-bold py-4 px-6 bg-red-700 text-white rounded-full">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

                <hr class="my-5">
                <div class="flex flex-row justify-between items-center">
                    <div>
                        <p class="text-slate-500 text-sm">Tanggal Dibuat</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{ $documentation->created_at->format('d M Y') }}</h3>
                    </div>
                    <div>
                        <p class="text-slate-500 text-sm">Kategpri Dokumwntasi</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{ $documentation->category->name }}</h3>
                    </div>
                </div>

                <hr class="my-5">

                <div class="flex flex-col">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                        
                            <div>
                                @php
                                    // Link YouTube awal
                                    $youtubeLink = $documentation->youtube;

                                    // Ambil ID video YouTube menggunakan regex
                                    if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/|.*v=))([\w-]+)/', $youtubeLink, $matches)) {
                                        // Buat link embed dari ID video
                                        $embedLink = 'https://www.youtube.com/embed/' . $matches[1];
                                    } else {
                                        // Jika bukan link YouTube atau tidak sesuai format, kosongkan
                                        $embedLink = null;
                                    }
                                @endphp

                                @if ($embedLink)
                                    <div class="mt-4">
                                        <iframe width="100%" height="250px" src="{{ $embedLink }}" class="rounded-lg" 
                                            title="YouTube video player" frameborder="0" 
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin"
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                @endif
                            </div>

                        <div>
                            <h3 class="text-indigo-950 text-xl font-bold">Konten Dokumentasi</h3>
                            <p class="text-slate-500 text-sm">{{ $documentation->caption }}</p>
                            <br>
                            <h3 class="text-indigo-950 text-xl font-bold">Link Youtube</h3>
                            <a href="{{ $youtubeLink }}" class="text-blue-500 text-sm">{{ $documentation->youtube }}</a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
