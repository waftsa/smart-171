<x-app-layout>
    <div class="py-12 bg-[#1D4161] min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-lg p-8 max-w-lg text-center">
            <!-- Icon Success -->
            <div class="flex justify-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-green-600 fill-current" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>
            </div>

            <!-- Pesan Sukses -->
            <h2 class="text-2xl font-bold text-green-600 mb-2">Pembayaran Berhasil!</h2>
            <p class="text-gray-600 mb-4">
                Terima kasih, <strong>{{ $donatur->name }}</strong>, atas donasi Anda untuk program <strong>{{ $donation->name }}</strong>.
            </p>

            <!-- Total Donasi -->
            <div class="bg-gray-100 p-4 rounded-md mb-6">
                <p class="text-gray-500 text-sm">Jumlah Donasi</p>
                <p class="text-xl font-bold text-gray-800">Rp {{ number_format($donatur->total_amount, 0, ',', '.') }}</p>
            </div>

            <!-- Opsi Tombol -->
            <div class="space-y-3">
                <a href="{{ route('home') }}" class="block w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700">
                    Kembali ke Halaman Utama
                </a>
                <a href="{{ route('donations.show', $donation) }}" class="block w-full bg-[#1D4161] text-white py-2 rounded-md hover:bg-[#1D4161]">
                    Lihat Detail Donasi
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
