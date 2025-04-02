<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dokumentasi Program') }}
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 bg-white p-10">
        <h2 class="text-indigo-950 text-3xl font-bold decoration-underline text-center mb-10">{{ $documentation->category->name }}</h2>
        
        <div class="bg-white rounded-lg border shadow-sm mb-8 p-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="col-span-1 lg:col-span-2">
            @php
                $youtubeLink = $documentation->youtube ?? null;
                if ($youtubeLink && preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/|.*v=))([\w-]+)/', $youtubeLink, $matches)) {
                    $videoId = $matches[1];
                    $thumbnailUrl = "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg";
                } else {
                    $thumbnailUrl = null;
                }
            @endphp

            @if ($thumbnailUrl)
                <iframe class="w-full aspect-video rounded-lg" src="https://www.youtube.com/embed/{{ $videoId }}?autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            @endif
            <h2 class="text-2xl font-bold mt-4 mb-4">{{ $documentation->title }}</h2>

            <p class="mt-2 text-gray-600">{{ $documentation->caption }}</p>
            <a href="{{ $documentation->youtube }}" class="mt-2 mb-2 text-blue-500">{{ $documentation->youtube }}</a>
            </div>

            <div class="col-span-1">
            <h4 class="text-xl font-semibold mt-1 mb-4">Dokumentasi Lainnya</h4>
            
            <div class="space-y-4 max-h-96 overflow-y-auto scrollbar-thin">
                @foreach ($documentations as $otherDocumentation)
                    @php
                        $youtubeLink = $otherDocumentation->youtube ?? null;
                        if ($youtubeLink && preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/|.*v=))([\w-]+)/', $youtubeLink, $matches)) {
                            $videoId = $matches[1];
                            $thumbnailUrl = "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg";
                        } else {
                            $thumbnailUrl = null;
                        }

                        // Tandai dokumentasi yang sedang ditonton
                        $isActive = $documentation->id === $otherDocumentation->id;
                    @endphp
                    <a href="{{ route('documentations.show', $otherDocumentation) }}">
                        <div class="flex items-center space-x-4 {{ $isActive ? 'bg-gray-200' : '' }} p-2 rounded-lg">
                            @if ($thumbnailUrl)
                                <div class="w-24 h-16">
                                    <img src="{{ $thumbnailUrl }}" alt="YouTube Thumbnail" class="rounded-lg w-full h-full object-cover">
                                </div>
                            @endif
                            <div>
                                <span class="font-semibold text-sm {{ $isActive ? 'text-[#1D4161]' : 'text-black' }}">
                                    {{ $otherDocumentation->title }}
                                </span>
                                <p class="text-sm text-gray-500">{{ $otherDocumentation->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            </div>
        </div>

        </div>


        <!-- Kategori Lainnya -->
        @foreach ($categories->where('id', '!=', $documentation->category->id) as $category)
        
        <h2 class="text-indigo-950 text-3xl font-bold decoration-underline text-center mb-10">{{ $category->name }}</h2>
                <div class="bg-white rounded-lg border shadow-sm mb-8 p-6">        
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
                                <h2 class="text-2xl font-bold mt-4 mb-4">{{ $latestDocumentation->title }}</h2>
                                <p class="mt-2 text-gray-600">{{ $latestDocumentation->caption }}</p>
                                <a href="{{ $latestDocumentation->youtube }}" class="mt-2 mb-2 text-blue-500">{{ $latestDocumentation->youtube }}</a>
                            @else
                                <p class="text-gray-600">Belum ada dokumentasi untuk kategori ini.</p>
                            @endif
                        </div>

                        <!-- Dokumentasi Lainnya -->
                        <div class="col-span-1">
                            <h4 class="text-xl font-semibold mb-4">Dokumentasi Lainnya</h4>
                            <div class="space-y-4 max-h-96 overflow-y-auto scrollbar-thin">
                                @foreach ($category->documentations as $documentation)
                                    @php
                                        $youtubeLink = $documentation->youtube ?? null;
                                        if ($youtubeLink && preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/|.*v=))([\w-]+)/', $youtubeLink, $matches)) {
                                            $videoId = $matches[1];
                                            $thumbnailUrl = "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg";
                                        } else {
                                            $thumbnailUrl = null;
                                        }
                                    @endphp

                                    <div class="flex items-center space-x-4">
                                        @if ($thumbnailUrl)
                                            <div class="w-24 h-16">
                                                <img src="{{ $thumbnailUrl }}" alt="YouTube Thumbnail" class="rounded-lg w-full h-full object-cover">
                                            </div>
                                        @endif
                                        <div>
                                            <a href="{{ route('documentations.show', $documentation) }}" class="font-semibold text-sm">{{ $documentation->title }}</a>
                                            <p class="text-sm text-gray-500">{{ $documentation->created_at->format('d M Y') }}</p>
                                        </div>
                                    </div>
                               
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>       
                @endforeach
            
        </div>


    </div>
</x-app-layout>
