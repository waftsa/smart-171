<x-app-layout>
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 bg-white p-10">
            <div class="absolute top-0 left-0 w-full h-36 bg-gradient-to-b from-[#1D4161] to-transparent pointer-events-none"></div>  

            <h2 class="text-indigo-950 text-3xl font-bold decoration-underline mt-20 text-center mb-10">DOKUMENTASI</h2>
            @foreach ($categories as $category)
                <div class="bg-white rounded-lg border shadow-sm mb-8 p-6">
                    <h2 class="text-2xl font-bold mb-4">{{ $category->name }}</h2>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Dokumentasi Terbaru -->
                        <div class="col-span-1 lg:col-span-2">
                            @php
                                $latestDocumentation = $category->documentations->first();
                                $youtubeLink = $latestDocumentation->youtube ?? null;
                                if ($youtubeLink && preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/|.*v=))([\w-]+)/', $youtubeLink, $matches)) {
                                    $videoId = $matches[1];
                                    $thumbnailUrl = "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg";
                                } else {
                                    $thumbnailUrl = null;
                                }
                            @endphp

                            @if ($latestDocumentation)
                                @if ($thumbnailUrl)
                                    <iframe class="w-full aspect-video rounded-lg" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allowfullscreen></iframe>
                                @endif
                                <h3 class="mt-2 text-lg font-bold">{{ $latestDocumentation->title }}</h3>
                                <p class="mt-2 text-gray-600">{{ $latestDocumentation->caption }}</p>
                                <a href="{{ $latestDocumentation->youtube }}" class="mt-2 mb-2 text-blue-500 text-m">{{ $latestDocumentation->youtube }}</p></a>
                            @else
                                <p class="text-gray-600">Belum ada dokumentasi untuk kategori ini.</p>
                            @endif
                        </div>

                        <!-- Dokumentasi Lainnya -->
                        <div class="col-span-1">
                        <p class="text-lg font-semibold mb-2 mt-2">Dokumentasi Lainnya</p>
                            <div class="space-y-4 max-h-96 overflow-y-auto scrollbar-thin">
                                @foreach ($category->documentations->skip(1) as $documentation)
                                    @php
                                        $youtubeLink = $documentation->youtube ?? null;
                                        if ($youtubeLink && preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/|.*v=))([\w-]+)/', $youtubeLink, $matches)) {
                                            $videoId = $matches[1];
                                            $thumbnailUrl = "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg";
                                        } else {
                                            $thumbnailUrl = null;
                                        }
                                    @endphp

                                    <div class="flex items-center space-x-2">
                                        @if ($thumbnailUrl)
                                            <div class="w-24 h-16">
                                                <img src="{{ $thumbnailUrl }}" alt="YouTube Thumbnail" class="rounded-lg w-full h-full object-cover">
                                            </div>
                                        @endif
                                        <div class="flex-1"><a href="{{ route('documentations.show', $documentation) }}">
                                            <p class="font-semibold text-sm">{{ $documentation->title }}</p>
                                            <p class="text-sm text-gray-500">{{ $documentation->updated_at->format('d M Y') }}</p>
                                            </a>
                                        </div>
                                    </div>
                                    <hr class="my-3">
                               
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    
</x-app-layout>
