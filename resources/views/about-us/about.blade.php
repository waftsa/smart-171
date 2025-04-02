<x-app-layout>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 mt-16">
    <div class="absolute top-0 left-0 w-full h-100 bg-gradient-to-b from-[#1D4161] to-transparent "></div>

    <!-- About Us Section -->
    <section id="compfrof" class="text-center flex justify-center relative z-10">
        <div class="flex justify-center h-full w-75">
            <iframe class="rounded-lg w-full aspect-video" 
                src="https://www.youtube.com/embed/8kYBML3hV6Q?autoplay=1&controls=1&showinfo=0&rel=0&modestbranding=1" 
                frameborder="0" allow="encrypted-media; fullscreen" allowfullscreen>
            </iframe>
        </div>
    </section>

    <section id="tentang kami" class="text-center mt-12 z-50">
        <h1 class="text-4xl font-semibold text-gray-800">{{ __('Tentang Kami') }}</h1>
        <p class="mt-4 text-lg text-gray-800 max-w-3xl mx-auto">
        SMART 171, Solidarity of Muslim for Al Quds Resist 171, ialah sebuah NGO yang fokus bergerak dalam isu kemanusiaan berlandaskan keadilan. Selain menyalurkan donasi, kami juga mengedukasi anak muda agar memahami dan peduli pada sesama.
        </p>
    </section>

    <!-- Dasar Bergerak Section (3 Kolom) -->
    <div class="text-center mt-12">
    <h1 class="text-4xl font-semibold text-gray-800">{{ __('Dasar Bergerak') }}</h1>
    <section class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="text-center p-6 bg-[#1D4161] rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-white mb-4 underline  decoration-[#e16976] underline-offset-4">{{ __('Islamic Value') }}</h3>
            <p class="mt-2 text-white text-m">"Maha Suci Allah, yang telah memperjalankan hamba-Nya pada suatu malam dari Al Masjidil Haram ke Al Masjidil Aqsha yang telah Kami berkahi sekelilingnya agar Kami
            perlihatkan kepadanya sebagian dari tanda-tanda (kebesaran) Kami. Sesungguhnya Dia adalah Maha Mendengar lagi Maha Mengetahui."</p>
        </div>
        <div class="text-center p-6 bg-[#1D4161] rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-white mb-4 underline  decoration-[#e16976] underline-offset-4">{{ __('National Value') }}</h3>
            <p class="mt-2 text-white text-m">"Bahwa sesungguhnya kemerdekaan itu ialah hak segala bangsa dan oleh sebab itu, maka penjajahan diatas dunia harus dihapuskan karena tidak sesuai dengan perikemanusiaan dan perikeadilan."</p>
        </div>
        <div class="text-center p-6 bg-[#1D4161] rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-white mb-4 underline  decoration-[#e16976] underline-offset-4">{{ __('International Law') }}</h3>
            <p class="mt-2 text-white text-m">"Para hakim di pengadilan tinggi PBB memerintahkan Israel untuk menghentikan serangannya di kota Rafah di Gaza selatan dan menarik diri dari daerah kantong tersebut, dalam kasus yang diajukan oleh Afrika Selatan yang menuduh Israel melakukan genosida, dengan alasan “risiko besar” terhadap penduduk Palestina."</p>
        </div>
    </section>
    </div>

    <!-- Visi dan Misi Section -->
    <section class="mt-12">
        <h2 class="text-4xl font-semibold text-gray-800 text-center">{{ __('Visi dan Misi') }}</h2>
        <div class="mt-6 text-lg text-gray-800 max-w-3xl mx-auto">
            <p class="mb-4">
                <strong class="text-3xl">Visi</strong><br><br>Menjadi lembaga pembebas Al-Quds yang profesional, cerdas, dan bergerak taktis serta sinergis secara internasional.
            </p>
            <p class="mb-4">
                <strong class="text-3xl">Misi</strong>
            </p>
            <ul class="list-disc list-inside space-y-2">
                <li>Mendistribusikan informasi untuk edukasi community mengenai Al-Aqsa dan Palestina secara umum.</li>
                <li>Membangun kepedulian dan semangat atas dasar cinta untuk membebaskan Al-Aqsa dan Palestina dari penjajahan.</li>
                <li>Mengajak masyarakat dengan menggerakkan pemuda untuk berkontribusi dalam pembebasan Al-Aqsa dan mendukung Palestina merdeka.</li>
            </ul>
        </div>
    </section>


    <!-- Project Smart Section -->
    <section class="mt-12">
        <h2 class="text-4xl font-semibold text-gray-800 text-center">{{ __('Smart Projects') }}</h2>
        <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-3 gap-8">
            <!-- Project Card -->
        <div class="relative group overflow-hidden rounded-lg shadow-lg">
            <!-- Image -->
            <img src="{{ asset('logos/baikberisik.jpg') }}" alt="Project Image" class="w-full h-full object-cover">

            <!-- Detail (Hidden by default, slides down on hover) -->
            <div class="h-full absolute inset-x-0 bottom-0 translate-y-full group-hover:translate-y-0 bg-black bg-opacity-50 shadow-lg transition-transform duration-300 flex flex-col items-center text-center text-white p-4">
                <p class="text-sm md:text-lg mb-2">BaikBerisik adalah gerakan sosial yang mengajak pemuda berkontribusi positif lewat aksi kreatif dan kolaboratif untuk masyarakat baik melalui sosial media maupun aksi langsung.</p>
                <a href="https://www.instagram.com/baikberisik/?hl=id" class="inline-block px-4 py-2 mt-2 rounded border-b border-white hover:bg-white transition-colors text-white hover:text-gray-800 text-sm md:text-base">
                    Lihat Detail
                </a>
            </div>
        </div>

        <div class="relative group overflow-hidden rounded-lg shadow-lg">
            <!-- Image -->
            <img src="{{ asset('logos/pals.jpg') }}" alt="Project Image" class="w-full h-full object-cover">

            <!-- Detail (Hidden by default, slides down on hover) -->
            <div class="h-full absolute inset-x-0 bottom-0 translate-y-full group-hover:translate-y-0 bg-black bg-opacity-50 shadow-lg transition-transform duration-300 flex flex-col items-center text-center text-white p-4">
                <p class="text-sm md:text-lg mb-2">PALS adalah platform pendidikan yang mendukung pembelajaran inovatif dengan pendekatan modern untuk membangun generasi yang cerdas, kritis, dan berdaya saing global.</p>
                <a href="https://pals.smart171.org/" class="inline-block px-4 py-2 mt-2 rounded border-b border-white hover:bg-white transition-colors text-white hover:text-gray-800 text-sm md:text-base">
                    Lihat Detail
                </a>
            </div>
        </div>

        <div class="relative group overflow-hidden rounded-lg shadow-lg">
            <!-- Image -->
            <img src="{{ asset('logos/smartcamp.jpeg') }}" alt="Project Image" class="w-full h-full object-cover">

            <!-- Detail (Hidden by default, slides down on hover) -->
            <div class="h-full absolute inset-x-0 bottom-0 translate-y-full group-hover:translate-y-0 bg-black bg-opacity-50 shadow-lg transition-transform duration-300 flex flex-col items-center text-center text-white p-4">
                <p class="text-sm md:text-lg mb-2">Smart Camp merupakan kegiatan yang melibatkan mahasiswa untuk membangun awareness terkait isu Palestina</p>
                <a href="https://www.instagram.com/smartcamp_171" class="inline-block px-4 py-2 mt-2 rounded border-b border-white hover:bg-white transition-colors text-white hover:text-gray-800 text-sm md:text-base">
                    Lihat Detail
                </a>
            </div>
        </div>

        </div>
    </section>


    <section class="mt-12">
        <h2 class="text-4xl font-semibold text-gray-800 text-center">{{ __('Smart Events') }}</h2>
        <div class="mt-8 grid grid-cols-1 sm:grid-cols-4 lg:grid-cols-4 gap-8">
            <!-- Project Card -->
        <div class="relative group overflow-hidden rounded-lg shadow-lg">
            <!-- Image -->
            <img src="{{ asset('logos/AAW.png') }}" alt="Project Image" class="w-full h-full object-cover">

            <!-- Detail (Hidden by default, slides down on hover) -->
            <!-- <div class="h-full absolute inset-x-0 bottom-0 translate-y-full group-hover:translate-y-0 bg-black bg-opacity-50 shadow-lg transition-transform duration-300 flex flex-col items-center text-center text-white p-4">
                <p class="text-sm md:text-lg mb-2">AAW adalah ...</p>
                <a href="https://www.instagram.com/stories/highlights/18050010058778446/?hl=id" class="inline-block px-4 py-2 mt-2 rounded border-b border-white hover:bg-white transition-colors text-white hover:text-gray-800 text-sm md:text-base">
                    Lihat Detail
                </a>
            </div> -->
        </div>

        <div class="relative group overflow-hidden rounded-lg shadow-lg">
            <!-- Image -->
            <img src="{{ asset('logos/run4palestine.png') }}" alt="Project Image" class="w-full h-full object-cover">

            <!-- Detail (Hidden by default, slides down on hover) -->
            <!-- <div class="h-full absolute inset-x-0 bottom-0 translate-y-full group-hover:translate-y-0 bg-black bg-opacity-50 shadow-lg transition-transform duration-300 flex flex-col items-center text-center text-white p-4">
                <p class="text-sm md:text-lg mb-2">AAW adalah ...</p>
                <a href="https://www.instagram.com/stories/highlights/18050010058778446/?hl=id" class="inline-block px-4 py-2 mt-2 rounded border-b border-white hover:bg-white transition-colors text-white hover:text-gray-800 text-sm md:text-base">
                    Lihat Detail
                </a>
            </div> -->
        </div>

        <div class="relative group overflow-hidden rounded-lg shadow-lg">
            <!-- Image -->
            <img src="{{ asset('logos/smartclass.png') }}" alt="Project Image" class="w-full h-full object-cover">

            <!-- Detail (Hidden by default, slides down on hover) -->
            <!-- <div class="h-full absolute inset-x-0 bottom-0 translate-y-full group-hover:translate-y-0 bg-black bg-opacity-50 shadow-lg transition-transform duration-300 flex flex-col items-center text-center text-white p-4">
                <p class="text-sm md:text-lg mb-2">AAW adalah ...</p>
                <a href="https://www.instagram.com/stories/highlights/18050010058778446/?hl=id" class="inline-block px-4 py-2 mt-2 rounded border-b border-white hover:bg-white transition-colors text-white hover:text-gray-800 text-sm md:text-base">
                    Lihat Detail
                </a>
            </div> -->
        </div>

        <div class="relative group overflow-hidden rounded-lg shadow-lg">
            <!-- Image -->
            <img src="{{ asset('logos/smarttalk.png') }}" alt="Project Image" class="w-full h-full object-cover">

            <!-- Detail (Hidden by default, slides down on hover) -->
            <!-- <div class="h-full absolute inset-x-0 bottom-0 translate-y-full group-hover:translate-y-0 bg-black bg-opacity-50 shadow-lg transition-transform duration-300 flex flex-col items-center text-center text-white p-4">
                <p class="text-sm md:text-lg mb-2">AAW adalah ...</p>
                <a href="https://www.instagram.com/stories/highlights/18050010058778446/?hl=id" class="inline-block px-4 py-2 mt-2 rounded border-b border-white hover:bg-white transition-colors text-white hover:text-gray-800 text-sm md:text-base">
                    Lihat Detail
                </a>
            </div> -->
        </div>

        </div>
    </section>

    <section class="mt-12">
        <h2 class="text-4xl font-semibold text-gray-800 text-center">{{ __('Smart Campaigns') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                @foreach($donations->take(3) as $donation)
                    <div class="bg-white p-4 shadow-md rounded-md transform transition duration-300 hover:scale-105">
                        <img src="{{ $donation->thumbnail }}" alt="{{ $donation->name }}" class="w-full h-36 object-cover rounded-t-md">
                        <br>
                        <h3 class="mt-2 font-bold text-xl text-center">{{ $donation->name }}</h3>
                        <hr class="my-4">
                        <!-- Terkumpul dan Target di baris atas -->
                        <div class="flex justify-between items-center mb-4">
                            <!-- Terkumpul Section - Left -->
                            <div class="flex flex-col items-start">
                                <p class="text-slate-500 text-sm">
                                     <strong class="text-[#1D4161] text-m">Rp {{ number_format($donation->donaturs->sum('total_amount'), 0, ',', '.') }}</strong> 
                                     terkumpul dari Rp {{ number_format($donation->target_amount, 0, ',', '.') }}
                                </p>
                                
                            </div>
                        </div>

                        <!-- Progress Bar di baris bawah -->
                        <div class="flex justify-between items-center">
                            <div class="w-full rounded-full h-2.5 bg-slate-300">
                                <div class="bg-[#1D4161] h-2.5 rounded-full" style="width: {{ ($donation->donaturs->sum('total_amount') / $donation->target_amount) * 100 }}%"></div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex flex-col items-start">
                                <p class="text-slate-500 text-sm">Tersisa 
                                     <strong class="text-[#e16976] text-m">Rp {{ number_format($donation->target_amount - $donation->donaturs->sum('total_amount'), 0, ',', '.') }}</strong> 
                                </p>   
                            </div>
                        </div>
                        
                        <div class="mt-4 text-center">
                            <a href="{{ route('donations.donate', $donation) }}" class="inline-block bg-[#1D4161] text-white py-2 px-6 rounded-lg hover:bg-[#163D51]">
                            Beri Donasi
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
    </section>

    <section class="mt-12">
        <h2 class="text-4xl font-semibold text-gray-800 text-center">{{ __('Smart News') }}</h2>
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 ">
                @foreach ($articles->skip(3) as $article)
                    <div class="m-2"><a href="{{ route('articles.show', $article)}}">
                        <img src="{{ $article->cover }}" alt="{{ $article->title }}" class="w-full h-50 object-cover rounded-md mb-3">
                        <h3 class="font-semibold text-lg text-gray-800">{{ $article->title }}</h3>
                        <p class="text-gray-800 text-sm">By
                            <span class="inline-block text-[#e16976]">{{ $article->user->name}}</span>
                            <span class="ml-2 text-gray-800">{{ $article->created_at->format('d M Y') }}</span>
                        </p>
                        </a>
                    </div>
                @endforeach
            </div>
    </section>

    <section class="mt-2">
        <h2 class="text-4xl font-semibold text-gray-800 text-center">{{ __('Kontak Kami') }}</h2>
            
        <!-- Social Media Icons -->
        <div class="mt-8 flex flex-col md:flex-row md:justify-center md:space-x-6">
            <div class="flex flex-col space-y-4 md:flex-row md:space-x-6 text-center">
            
                <!-- <div class="flex flex-row space-x-5"> -->
                    <a href="https://www.instagram.com/smart_171/" class="flex flex-col items-center text-[#e16976] mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                    </svg>
                    <h2 class="text-2xl font-semibold">@smart_171</h2>
                    </a>

                    <a href="https://wa.me/6282115015048" class="flex flex-col items-center text-[#e16976] mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                        <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                    </svg>
                    <h2 class="text-2xl font-semibold">(+62)82115015048</h2>
                    </a>

                    <a href="https://t.me/smartsatutujuan" class="flex flex-col items-center text-[#e16976] mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-telegram" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.287 5.906q-1.168.486-4.666 2.01-.567.225-.595.442c-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294q.39.01.868-.32 3.269-2.206 3.374-2.23c.05-.012.12-.026.166.016s.042.12.037.141c-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8 8 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629q.14.092.27.187c.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.4 1.4 0 0 0-.013-.315.34.34 0 0 0-.114-.217.53.53 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09"/>
                    </svg>
                    <h2 class="text-2xl font-semibold">smartsatutujuan</h2>
                    </a>

                    <a href="https://www.facebook.com/smartsatutujuan?mibextid=ZbWKwL" class="flex flex-col items-center text-[#e16976] mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                    </svg>
                    <h2 class="text-2xl font-semibold">@smartsatutujuan</h2>
                    </a>

                    <a href="https://www.youtube.com/@Smart171" class="flex flex-col items-center text-[#e16976] mr-2">             
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                        <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z"/>
                    </svg>
                    <h2 class="text-2xl font-semibold">@Smart171</h2>
                    </a>
    
                <!-- </div> -->
            </div>
        </div>
    </section>


</div

</x-app-layout>