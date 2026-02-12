<x-app-layout>
    @section('meta')
        <meta property="og:title" content="{{ $donation->name }}">
        <meta property="og:description" content="{{ strip_tags(Str::limit($donation->about, 120)) }}">
        <meta property="og:image" content="{{ $donation->thumbnail }}">
        <meta property="og:image:secure_url" content="{{ $donation->thumbnail }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="article">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $donation->name }}">
        <meta name="twitter:description" content="{{ strip_tags(Str::limit($donation->about, 120)) }}">
        <meta name="twitter:image" content="{{ $donation->thumbnail }}">
    @endsection


    <div class="bg-[#1D4161]">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class=" absolute top-0 left-0 w-full h-56 bg-gradient-to-b from-[#1D4161] to-transparent pointer-events-none z-10"></div>  

            <div class="relative">                
                <!-- Thumbnail Image -->
                <img src="{{ $donation->thumbnail }}" alt="Donation Thumbnail" class="w-full h-auto sm:h-42 object-cover rounded-b-3xl mb-[-25px]">
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-lg p-4 sm:p-5 flex flex-col gap-y-5">
                
                <!-- Donation Name and Uploading User -->
                <h2 class="text-indigo-950 text-xl sm:text-3xl font-bold text-center mt-5">{{ $donation->name }}</h2>

                
                <hr class="my-2">

                <!-- Donation Progress -->
                @if($donation->has_finished)
                <div class="flex-1">

                    <p class="text-gray-600 text-sm sm:text-m mb-2">
                        <strong class="text-[#1D4161]">Campaign ini telah mencapai target </strong>
                    </p>
                    <div class="w-full bg-slate-300 h-2 rounded-full">
                        <div class="bg-[#e16976] h-2 rounded-full" style="width: {{ $percentage ?? 0 }}%"></div>
                    </div>
                    <p class="text-gray-600 text-xs sm:text-s m-2">
                        Tersisa <strong class="text-[#e16976]">Rp 0 </strong>
                    </p>
                    </div>

                @else
                <div class="flex-1">

                    <p class="text-gray-600 sm:text-m text-sm mb-1">
                        <strong class="text-gray-600">Rp {{ number_format($donation->donaturs->sum('total_amount'), 0, ',', '.') }} </strong>
                        Terkumpul dari <strong class="text-[#1D4161] sm:text-xl tex-m">Rp {{ number_format($donation->target_amount, 0, ',', '.') }} </strong>
                    </p>
                    <div class="w-full bg-slate-300 h-2 rounded-full">
                        <div class="bg-[#1D4161] h-2 rounded-full" style="width: {{ $percentage ?? 0 }}%"></div>
                    </div>
                    <p class="text-gray-600 sm:text-s text-xs m-2">
                        Tersisa <strong class="text-[#e16976]">Rp {{ number_format($donation->target_amount - $donation->donaturs->sum('total_amount'), 0, ',', '.') }}</strong>
                    </p>
                </div>

                @endif
            </div>

            <!-- profile  -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg p-4 sm:p-5 flex items-center gap-x-2 mt-2">
                <img src="{{ asset('logos/iconsmart171.png') }}" class="w-12 h-12 rounded-full" alt="Logo Lembaga">
                <div class="flex flex-col gap-y-1">
                    <p class="text-slate-500 text-sm">Diunggah oleh:</p>
                    <div class="flex items-center gap-x-2">
                        <p class="text-slate-900 text-m font-semibold">{{ $donation->user->name }}</p>
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill-rule="evenodd" clip-rule="evenodd" d="M21.007 8.27C22.194 9.125 23 10.45 23 12c0 1.55-.806 2.876-1.993 3.73.24 1.442-.134 2.958-1.227 4.05-1.095 1.095-2.61 1.459-4.046 1.225C14.883 22.196 13.546 23 12 23c-1.55 0-2.878-.807-3.731-1.996-1.438.235-2.954-.128-4.05-1.224-1.095-1.095-1.459-2.611-1.217-4.05C1.816 14.877 1 13.551 1 12s.816-2.878 2.002-3.73c-.242-1.439.122-2.955 1.218-4.05 1.093-1.094 2.61-1.467 4.057-1.227C9.125 1.804 10.453 1 12 1c1.545 0 2.88.803 3.732 1.993 1.442-.24 2.956.135 4.048 1.227 1.093 1.092 1.468 2.608 1.227 4.05Zm-4.426-.084a1 1 0 0 1 .233 1.395l-5 7a1 1 0 0 1-1.521.126l-3-3a1 1 0 0 1 1.414-1.414l2.165 2.165 4.314-6.04a1 1 0 0 1 1.395-.232Z" fill="#3b82f6"></path></g>
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- tentang program  -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg p-4 sm:p-5 flex flex-col gap-y-2 mt-2">
                <p class="text-slate-900 font-semibold">Tentang Program</p>
                <hr class="my-1 w-full">
                <p class="text-gray-600 text-m">{{ $donation->about }}</p>
            </div>

            <!-- donatur -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg p-4 sm:p-5 flex flex-col gap-y-2 sm:gap-y-1 mt-2">
                <p class="text-slate-900 font-semibold">Donatur</p>
                <hr class="my-2 w-full">

                @forelse ($donaturs as $donatur)
                    <div class="bg-gray-100 rounded-lg shadow-sm mb-3 overflow-hidden">
                        <div class="flex items-start justify-between p-3 sm:p-4">
                            
                            {{-- Avatar dan Nama --}}
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-700 font-semibold">
                                    {{ $donatur->anonim ? 'HA' : strtoupper(substr($donatur->name, 0, 2)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-sm">
                                        {{ $donatur->anonim ? 'Hamba Allah' : $donatur->name }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        {{ $donatur->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>

                            {{-- Nominal --}}
                            <p class="text-gray-900 font-semibold text-xs">
                                Rp {{ number_format($donatur->total_amount, 0, ',', '.') }}
                            </p>
                        </div>

                        {{-- Notes --}}
                        @if ($donatur->notes)
                            <div class="border-t border-gray-300 bg-white p-4">
                                <p class="text-gray-700 text-sm">{{ $donatur->notes }}</p>

                                <div class="mt-2 bg-gray-100 rounded-md p-2 text-sm text-gray-600 flex justify-between items-center">
                                    <span>Aminkan doa ini</span>
                                    <button 
                                        class="px-3 py-1 bg-gray-200 rounded-md text-gray-700 font-medium transition-all"
                                        onclick="toggleAamiin(this)" 
                                        data-liked="false"
                                    >
                                        🤍 Aamiin
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                @empty
                    {{-- Jika belum ada donatur --}}
                    <div class="text-center py-6 text-gray-500 text-sm">
                        Belum ada donasi pada program ini 🙏
                    </div>
                @endforelse
            </div>



            <!-- bagikan  -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg pt-3 pb-3 p-3 sm:pr-5 sm:pl-5 flex flex-col gap-y-2 mt-2">
                <div class="mt-6 mb-4 text-center">
                    <p class="text-slate-900 font-semibold">Bagikan</p>
                    <div class="mt-6 flex justify-center space-x-4">
                    @php
                        $shareMessage = "*{$donation->name}*\n\n" . strip_tags($donation->about) . "\n\n" . url()->current();
                    @endphp
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($shareMessage) }}" 
                        target="_blank" 
                        class="text-green-500 hover:text-green-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                            </svg>
                        </a>
                        <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode($shareMessage) }}" target="_blank" class="text-blue-500 hover:text-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-telegram" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.287 5.906q-1.168.486-4.666 2.01-.567.225-.595.442c-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294q.39.01.868-.32 3.269-2.206 3.374-2.23c.05-.012.12-.026.166.016s.042.12.037.141c-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8 8 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629q.14.092.27.187c.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.4 1.4 0 0 0-.013-.315.34.34 0 0 0-.114-.217.53.53 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09"/>
                            </svg>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}&quote={{ urlencode($shareMessage) }}" target="_blank" class="text-blue-700 hover:text-blue-900">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                            </svg>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($shareMessage) }}" target="_blank" class="text-blue-400 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                                <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Donation Button -->
            <div class="sticky bottom-0 left-0 right-0 shadow-sm bg-white pt-2 pb-2 pr-8 pl-8 flex flex-col gap-y-5 max-w-3xl mx-auto">
                <div class="flex justify-cente">
                    @if($donation->has_finished)
                    <a href="#" 
                    class="font-bold w-full py-2 px-4 bg-gray-400 text-gray-600 text-center rounded-lg">
                        Program Ini Sudah Selesai
                    </a>
                    @else
                    <a href="{{ route('donations.donate', $donation) }}" 
                    class="font-bold w-full py-2 px-4 bg-[#1D4161] text-white text-center rounded-lg">
                        Donasi Sekarang
                    </a>
                    @endif
                </div>
            </div>


        </div>
            
    </div>



<script>
    function toggleAamiin(button) {
        let liked = button.getAttribute("data-liked") === "true"; // Ambil status klik
        if (liked) {
            button.innerHTML = "🤍 Aamiin"; // Kembalikan ke putih
            button.classList.remove("bg-gray-200", "text-gray-700"); // Hapus warna merah
            button.classList.add("bg-gray-200", "text-gray-700"); // Tambahkan warna default
        } else {
            button.innerHTML = "❤️ Aamiin"; // Ganti ke hati merah
            button.classList.remove("bg-gray-200", "text-gray-700"); // Hapus warna default
            button.classList.add("bg-gray-200", "text-gray-700"); // Tambahkan warna merah
        }
        button.setAttribute("data-liked", !liked); // Toggle status klik
    }
</script>
</x-app-layout>
