<x-app-layout>
    <div class="py-8 bg-white mt-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <h2 class="text-2xl font-semibold text-gray-800 mb-8 text-center">
                📰 Buletin Terbaru
            </h2>

            @if($buletins->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($buletins as $buletin)
                            <!-- Cover Buletin -->
                            <div class="relative group cursor-pointer">
                                <div x-data="{ open: false }" class="flex flex-col items-center">
                                    <!-- Cover Buletin -->
                                    <img  width="250px"
                                        src="https://res.cloudinary.com/dyotormgm/image/upload/pg_1/{{ $buletin->file_public_id }}.jpg"
                                        alt="Cover Buletin"
                                        class="rounded-xl shadow-md hover:shadow-xl transition cursor-pointer"
                                        @click="open = true"
                                    />

                                    <span class="mt-2 font-semibold text-indigo-800 text-center">{{ $buletin->title }}</span>

                                    <!-- Modal (Popup PDF) -->
                                    <div 
                                        x-show="open" 
                                        x-cloak
                                        class="fixed inset-0 bg-black/60 flex items-center justify-center z-50"
                                    >
                                        <div class="bg-white rounded-xl w-11/12 md:w-3/4 h-[90vh] pt-10 p-4 relative shadow-2xl">
                                            <button 
                                                @click="open = false"
                                                class="absolute top-3 right-3 bg-red-600 text-white px-3 py-1 rounded-full font-bold hover:bg-red-700 transition"
                                            >
                                                ✕
                                            </button>

                                            <!-- PDF Viewer -->
                                            <iframe 
                                                src="https://res.cloudinary.com/dyotormgm/image/upload/{{ $buletin->file_public_id }}.pdf" 
                                                width="100%" 
                                                height="100%" 
                                                style="border:none;"
                                            ></iframe>
                                        </div>
                                    </div>
                            </div>

                            <!-- Info Buletin -->
                            <div class="p-3 text-center">
                                <h3 class="text-gray-900 font-semibold text-sm truncate">{{ $buletin->title }}</h3>
                                <p class="text-xs text-gray-500">{{ $buletin->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-10">
                    {{ $buletins->links() }}
                </div>
            @else
                <p class="text-center text-gray-500">Belum ada buletin yang tersedia.</p>
            @endif
        </div>
    </div>
</x-app-layout>
