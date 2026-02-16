@props(['documentations'])

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
