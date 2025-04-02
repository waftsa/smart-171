<x-app-layout>
    <div class="bg-[#1D4161]">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="absolute top-0 left-0 w-full h-50 bg-gradient-to-b from-[#1D4161] to-transparent z-10"></div>  
            <!-- Header Section -->
            <div class="relative z-0">
                <img src="{{ asset('images/ota.png') }}" alt="Donation Thumbnail" class="w-full h-auto sm:h-42 object-cover rounded-b-3xl shadow-lg mb-[-25px]">
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
            <h1 class="text-center text-3xl font-bold text-[#1D4161] mb-4 mt-10">Program Orang Tua Asuh untuk Yatim Gaza</h1>
                <p class="text-gray-700 leading-relaxed text-center">
                    Program Orang Tua Asuh untuk Yatim Gaza terdiri dari beberapa paket yang bertujuan mendukung anak-anak yatim dalam pendidikan, kesehatan, dan kebutuhan sehari-hari. Program ini dijalankan dengan komitmen minimal satu tahun dan donasi rutin tiap bulan.
                </p>
            
        <!-- Paket Utama Section -->
        <!-- Paket Utama Section -->
        <h2 class="text-2xl font-bold text-[#1D4161] mt-8 mb-4">Paket Utama</h2>
        <div class="flex flex-wrap md:flex-nowrap items-start gap-6">
            <!-- Gambar di Sebelah Kiri -->
            <div class="md:w-1/2 w-full">
                <img src="{{ asset('images/ota-general.jpg') }}" alt="Orang Tua Asuh" class="rounded-lg shadow-lg w-full object-cover">
            </div>

            <!-- Paket di Sebelah Kanan -->
            <div class="md:w-1/2 w-full">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach([
                        ['title' => 'Paket Health', 'price' => 'Rp 100.000/bulan', 'description' => 'Untuk kesehatan anak yatim.'],
                        ['title' => 'Paket Smart', 'price' => 'Rp 200.000/bulan', 'description' => 'Untuk pendidikan anak yatim.'],
                        ['title' => 'Paket Basic', 'price' => 'Rp 300.000/bulan', 'description' => 'Untuk keperluan sehari-hari anak yatim.'],
                        ['title' => 'Paket Full', 'price' => 'Rp 600.000/bulan', 'description' => 'Untuk satu anak yatim.'],
                    ] as $paket)
                        <div class="border rounded-lg p-4 shadow-sm text-center">
                            <h3 class="text-xl font-semibold text-[#1D4161]">{{ $paket['title'] }}</h3>
                            <p class="text-gray-600 mt-2"><strong>{{ $paket['price'] }}</strong></p>
                            <p class="text-gray-700 mt-2">{{ $paket['description'] }}</p>
                        </div>
                    @endforeach
                </div>

                <!-- Button Daftar di Bawah Paket -->
                <div class="mt-6 text-center w-full">
                    <a href="{{ route('ota.form.umum') }}" class="bg-[#1D4161] text-white py-2 px-6 rounded-lg hover:bg-indigo-900">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>

                
        <!-- Paket Patungan Section -->
        <h2 class="text-2xl font-bold text-[#1D4161] mt-8 mb-4">Paket Patungan</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach([
                [
                    'title' => 'Paket Patungan', 
                    'description' => 'Rp 50.000/bulan untuk memenuhi total Rp 600.000/bulan dalam satu kelompok maksimal 12 orang.', 
                    'image' => 'images/ota-general.jpg', // Gambar untuk card ini
                    'route' => route('ota.form.patungan') // Perbaiki bagian ini
                ],
                [
                    'title' => 'Paket Patungan Yatim Sebatang Kara', 
                    'description' => 'Rp 50.000/bulan untuk memenuhi total Rp 1.000.000/bulan dalam satu kelompok maksimal 20 orang.', 
                    'image' => 'images/ota-general.jpg', // Gambar untuk card ini
                    'route' => route('ota.form.patungan2') // Perbaiki bagian ini
                ],
            ] as $patungan)
                <div class="border rounded-lg p-4 shadow-sm">
                    <!-- Gambar -->
                    <img src="{{ asset($patungan['image']) }}" alt="{{ $patungan['title'] }}" class="rounded-lg mb-4 w-full object-cover h-48">
                    
                    <!-- Judul dan Deskripsi -->
                    <h3 class="text-lg font-semibold text-[#1D4161]">{{ $patungan['title'] }}</h3>
                    <p class="text-gray-700 mt-2">{{ $patungan['description'] }}</p>
                    
                    <!-- Tombol Daftar -->
                    <div class="mt-10 mb-4 text-center">
                        <a href="{{ $patungan['route'] }}" class="bg-[#1D4161] text-white py-2 px-4 rounded-lg hover:bg-indigo-900">
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
            @endforeach
        </div>



        <!-- Garis Pembatas -->
        <hr class="my-10 border-t border-gray-300">

        <!-- Milestone Section -->
        <div class="max-w-6xl mx-auto py-10">
            <h3 class="text-center text-2xl font-bold text-[#1D4161] mb-4">Alur Menjadi Orang Tua Asuh</h3>
            <p class="text-center text-gray-600 mb-8">
                Proses alur donasi kami memastikan transparansi dan kemudahan bagi donatur untuk membantu anak-anak yatim di Gaza.
            </p>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Langkah 1 -->
                <div class="text-center">
                    <div class="flex justify-center items-center w-20 h-20 mx-auto bg-[#EAF3FC] rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" stroke="#1D4161" class="bi bi-ui-checks-grid" viewBox="0 0 16 16">
                            <path d="M2 10h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1m9-9h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-3a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1m0 9a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zm0-10a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM2 9a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2zm7 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-3a2 2 0 0 1-2-2zM0 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm5.354.854a.5.5 0 1 0-.708-.708L3 3.793l-.646-.647a.5.5 0 1 0-.708.708l1 1a.5.5 0 0 0 .708 0z"/>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-[#1D4161] mt-4">Isi Formulir</h4>
                    <p class="text-gray-600 mt-2">
                        Donatur mengisi formulir untuk mendaftar sebagai orang tua asuh dan memilih paket bantuan yang sesuai.
                    </p>
                </div>

                
                <!-- Langkah 2 -->
                <div class="text-center">
                    <div class="flex justify-center items-center w-20 h-20 mx-auto bg-[#EAF3FC] rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#1D4161" class="bi bi-chat-right-text" viewBox="0 0 16 16">
                            <path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                            <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-[#1D4161] mt-4">Konfirmasi Admin</h4>
                    <p class="text-gray-600 mt-2">
                        Admin akan menghubungi donatur untuk konfirmasi detail transaksi, jadwal pembayaran, dan informasi tambahan.
                    </p>
                </div>

                
                <!-- Langkah 3 -->
                <div class="text-center">
                    <div class="flex justify-center items-center w-20 h-20 mx-auto bg-[#EAF3FC] rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#1D4161" class="bi bi-send-check" viewBox="0 0 16 16">
                            <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372zm-2.54 1.183L5.93 9.363 1.591 6.602z"/>
                            <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686"/>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-[#1D4161] mt-4">Pelaporan Program</h4>
                    <p class="text-gray-600 mt-2">
                        Donatur akan menerima laporan perkembangan anak asuh secara berkala untuk memastikan donasi tersalurkan dengan baik.
                    </p>
                </div>

            </div>
        </div>


        <!-- FAQ Section -->
        <div class="max-w-6xl mx-auto py-10">
            <h3 class="text-center text-2xl font-bold text-[#1D4161] mb-6">FAQ</h3>
            <div class="space-y-4">
                <details class="bg-gray-100 rounded-lg p-4">
                    <summary class="font-bold text-[#1D4161]">Apa itu Program Orang Tua Asuh?</summary>
                    <p class="mt-2 text-gray-600">Program ini adalah inisiatif untuk  mendukung anak-anak yatim dalam pendidikan, kesehatan, dan kebutuhan sehari-hari.</p>
                </details>
                <details class="bg-gray-100 rounded-lg p-4">
                    <summary class="font-bold text-[#1D4161]">Bagaimana cara mendaftar?</summary>
                    <p class="mt-2 text-gray-600">Klik tombol "Daftar Sekarang" di atas untuk memulai proses pendaftaran.</p>
                </details>
            </div>
        </div>
        </div>    
    </div>
</div>
</x-app-layout>
