<x-app-layout>

    <div class="py-20 bg-[#1D4161]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 max-w-5xl mx-auto">
  
                <div class="flex justify-center ">
                    <img src="{{ $release->cover }}" alt="{{ $release->title }}" class="w-full h-50 md:32 mb-4 rounded-md">
                </div>
                
                <h1 class="font-semibold text-4xl text-gray-800 leading-tight text-center">
                    {{ $release->title }}
                </h1>

                <div class="text-center mb-4 mt-8">
                    <p class="text-sm text-gray-600">{{ $release->updated_at->format('d M Y') }} - {{ $release->category->name}}</p>
                </div>

                <div class="text-lg text-gray-800">{!! $release->content !!}</div>

                <!-- Bagikan Button -->
                <div class="mt-6 text-center">
                    <p class="text-gray-700 mb-4">Bagikan</p>
                <div class="mt-6 flex justify-center space-x-4">
                <a href="https://api.whatsapp.com/send?text={{ urlencode($release->title) }}%0A{{ urlencode(url()->current()) }}" target="_blank" class="text-green-500 hover:text-green-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                            <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                        </svg>
                    </a>
                    <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode($release->title) }}%0A" target="_blank" class="text-blue-500 hover:text-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-telegram" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.287 5.906q-1.168.486-4.666 2.01-.567.225-.595.442c-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294q.39.01.868-.32 3.269-2.206 3.374-2.23c.05-.012.12-.026.166.016s.042.12.037.141c-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8 8 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629q.14.092.27.187c.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.4 1.4 0 0 0-.013-.315.34.34 0 0 0-.114-.217.53.53 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09"/>
                        </svg>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}&quote={{ urlencode($release->title) }}" target="_blank" class="text-blue-700 hover:text-blue-900">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                        </svg>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($release->title) }}%0A" target="_blank" class="text-blue-400 hover:text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                            <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                        </svg>
                    </a>
                </div>
                </div>

                <h1 class="font-semibold text-xl text-gray-800 leading-tight text-center mt-10">
                    Baca Berita Terbaru Lainnya
                </h1>
                <div class="m-10 bg-white">
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($latestReleases as $latestRelease)
                            <div class="mb-4">
                                <a href="{{ route('releases.show', $latestRelease) }}">
                                    <div class="relative">
                                        <!-- Gambar Cover Artikel -->
                                        <img src="{{ $latestRelease->cover }}" alt="{{ $latestRelease->title }}" class="w-full md:h-28 ms:h-24 lg:h-48 object-cover rounded-md mb-3">
                                        
                                        <!-- Kategori di pojok kiri atas -->
                                        <span class="absolute top-2 left-2 bg-white text-[#1D4161] text-xs font-semibold px-2 py-1 rounded-xl">
                                            {{ $latestRelease->category?->name ?? 'Tanpa Kategori' }}
                                        </span>
                                    </div>

                                    <h3 class="font-semibold text-xl text-semibold">{{ $latestRelease->title }}</h3>
                                    <p class="text-gray-500 text-sm">By
                                        <span class="inline-block text-[#e16976]">{{ $latestRelease->user->name }}</span>
                                        <span class="ml-2">{{ $latestRelease->updated_at->format('d M Y') }}</span>
                                    </p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-6 text-center items-center">
                    <a href="{{ route('releases.list') }}" class="text-center text-blue-600">
                        Kembali Ke Laman Utama
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>