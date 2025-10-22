<x-app-layout>
    <div class="bg-[#1D4161]">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm p-10 space-y-6">
                <div class="text-center">
                    <img src="{{ asset('smart171.png') }}" alt="Smart Logo" class="mx-auto mb-4 max-w-[75%] h-auto">
                    <p class="text-l text-slate-500">Terima kasih, <strong>{{ $donatur->name }}</strong>, atas donasi Anda!</p>
                    <h3 class="text-xl font-semibold text-indigo-950">Program: {{ $donation->name }}</h3>
                </div>

                <!-- Header Dinamis -->
                @if($donation->rekening === 'campaign')
                    <div class="text-center">
                        <p class="text-l font-semibold text-indigo-950 mb-2">Metode Pembayaran:</p>
                        
                            @if ($donatur->payment_method === 'Scan QRCode / Qris')
                                <img src="{{ asset('images/qris-logo.png') }}" class="mx-auto mb-4 w-16 h-auto">
                                <p>Scan QRcode di bawah ini!</p>
                                <img src="{{ asset('images/qris_campaign.png') }}" class="mx-auto mb-4 w-64 h-auto">
                            @endif
                        
                    </div>

                    <!-- Nomor Rekening BSI atau BCA Syariah (Responsive) -->
                    @if ($donatur->payment_method !== 'Scan QRCode / Qris')
                        <div class="mt-6">
                            <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6 py-4">
                                <!-- Logo Bank -->
                                <img 
                                    src="{{ $donatur->payment_method === 'Bank BSI (Transfer Bank)' ? asset('images/bsi-logo.png') : asset('images/bca-syariah.png') }}" 
                                    alt="Bank Logo" 
                                    class="w-28 h-auto">

                                <!-- Informasi Rekening -->
                                <div class="text-center sm:text-left">
                                    @if ($donatur->payment_method === 'Bank BSI (Transfer Bank)')
                                        <p class="text-lg font-bold text-indigo-950">7-666-171-661</p>
                                        <p class="text-sm text-gray-600">a.n Solidaritas Muslim Al Quds Resist</p>
                                    @endif
                                </div>

                                <!-- Tombol Copy -->
                                <button type="button" onclick="copyText('{{ $donatur->payment_method === 'Bank BSI (Transfer Bank)' ? '7666171661' : '0358171171' }}')" class="flex items-center space-x-1 p-2 text-indigo-600 hover:text-indigo-800">
                                    <!-- <img src="{{ asset('icons/copy.svg') }}" alt="Copy Icon" class="w-4 h-4"> -->
                                    <p class="text-xs">Salin No Rekening</p>
                                </button>
                            </div>
                        </div>
                    @endif

                @elseif($donation->rekening === 'kurban')
                    <div class="text-center">
                        <p class="text-l font-semibold text-indigo-950 mb-2">Metode Pembayaran:</p>
                        
                            @if ($donatur->payment_method === 'Scan QRCode / Qris')
                                <img src="{{ asset('images/qris-logo.png') }}" class="mx-auto mb-4 w-16 h-auto">
                                <p>Scan QRcode di bawah ini!</p>
                                <img src="{{ asset('images/qris_kurban.jpg') }}" class="mx-auto mb-4 w-64 h-auto">
                            @endif
                        
                    </div>

                    <!-- Nomor Rekening BSI atau BCA Syariah (Responsive) -->
                    @if ($donatur->payment_method !== 'Scan QRCode / Qris')
                        <div class="mt-6">
                            <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6 py-4">
                                <!-- Logo Bank -->
                                <img 
                                    src="{{ $donatur->payment_method === 'Bank BSI (Transfer Bank)' ? asset('images/bsi-logo.png') : asset('images/bca-syariah.png') }}" 
                                    alt="Bank Logo" 
                                    class="w-28 h-auto">

                                <!-- Informasi Rekening -->
                                <div class="text-center sm:text-left">
                                    @if ($donatur->payment_method === 'Bank BSI (Transfer Bank)')
                                        <p class="text-lg font-bold text-indigo-950">7-333-171-338</p>
                                        <p class="text-sm text-gray-600">a.n Solidaritas Muslim Al Quds Resist</p>
                                    @endif
                                </div>

                                <!-- Tombol Copy -->
                                <button type="button" onclick="copyText('{{ $donatur->payment_method === 'Bank BSI (Transfer Bank)' ? '7333171338' : '0358171171' }}')" class="flex items-center space-x-1 p-2 text-indigo-600 hover:text-indigo-800">
                                    <!-- <img src="{{ asset('icons/copy.svg') }}" alt="Copy Icon" class="w-4 h-4"> -->
                                    <p class="text-xs">Salin No Rekening</p>
                                </button>
                            </div>
                        </div>
                    @endif
                @endif

                <!-- Total Amount -->
                <div class="mt-6">
                    <label for="total_amount" class="block text-lg font-medium text-gray-700">Total Donasi:</label>
                    <div class="relative">
                        <div id="total_amount_display" class="block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md shadow-sm">
                            Rp <strong> {{ number_format($donatur->total_amount, 0, ',', '.') }} </strong>
                        </div>
                        <button type="button" onclick="copyText('{{ $donatur->total_amount }}')" class="absolute right-2 top-1/2 transform -translate-y-1/2">
                            <!-- <img src="{{ asset('icons/copy.svg') }}" alt="Copy Icon" class="w-4 h-4"> -->
                             <p class="text-xs text-indigo-600 hover:text-indigo-800">Salin</p>
                        </button>
                    </div>
                </div>

                <!-- Instruksi Pembayaran -->
                <div class="mt-6">
                    <details class="group">
                        <summary class="flex items-center justify-between px-4 py-2 border-2 border-[#1D4161] bg-white text-[#1D4161] rounded-md cursor-pointer">
                            <span>Tata Cara Pembayaran</span>
                            <svg class="w-5 h-5 group-open:rotate-180 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                            </svg>
                        </summary>
                        <ul class="mt-4 px-4 space-y-1 list-decimal list-inside text-gray-700">
                            @if ($donatur->payment_method === 'Scan QRCode / Qris')
                                <li>Scan QR code di atas menggunakan aplikasi pembayaran digital Anda.</li>
                                <li>Masukkan jumlah pembayaran sesuai donasi Anda.</li>
                                <li>Masukkan PIN untuk memproses pembayaran di aplikasi Anda.</li>
                                <li>Apabila pembayaran berhasil, Upload bukti transfer pada tombol dibawah.</li>
                            @elseif ($donatur->payment_method === 'Bank BSI (Transfer Bank)')
                                <li>Buka aplikasi BSI Mobile / Byond App atau ATM.</li>
                                <li>Pilih menu transfer dan masukkan nomor rekening berikut: <strong>7666171661</strong>.</li>
                                <li>Masukkan nominal sesuai jumlah donasi Anda.</li>
                                <li>Masukkan PIN untuk memproses pembayaran Anda.</li>
                                <li>Apabila pembayaran berhasil, Upload bukti transfer pada tombol dibawah.</li>
                            @endif
                        </ul>
                    </details>
                </div>

                

                <!-- Button Konfirmasi -->
                <form action="{{ route('donations.confirmation', ['donation' => $donation->slug, 'donatur' => $donatur->slug]) }}" method="POST" enctype="multipart/form-data" class="mt-6">
                    @csrf
                    <label for="proof" class="block text-lg font-medium text-gray-700">Upload Bukti Transaksi:</label>
                    <input type="file" name="proof" id="proof" accept=".png,.jpg,.jpeg" required class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-4">
                    <button type="submit" class="mt-4 w-full bg-green-700 text-white py-2 rounded-md hover:bg-green-500">Konfirmasi Pembayaran</button>
                </form>

                <!-- button hubungi admin  -->
                <div class="mt-12 space-y-2">
                    <label class="block text-red-500 text-m text-center">
                        Mengalami Kendala? Silahkan Hubungi Admin
                    </label>
                    @php
                        // Membuat teks otomatis untuk WhatsApp
                        $whatsappText = urlencode("Assalamu'alaikum Admin SMART171. saya {$donatur->name}, mengalami kendala pada proses konfirmasi donasi dalam program campaign {$donation->name}. Berikut detail kendalanya : (mohon diisi dengan kendala yang ingin disampaikan).");
                    @endphp
                    <a href="https://wa.me/6282115015048?text={{ $whatsappText }}" 
                    class="block w-full bg-red-600 text-white text-center py-2 rounded-md hover:bg-red-700">
                        Hubungi Admin SMART171 (WhatsApp)
                    </a>
                </div>
  
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        function copyText(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Teks berhasil disalin!');
            });
        }
    </script>
</x-app-layout>
