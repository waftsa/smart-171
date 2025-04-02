<x-app-layout>
    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6 text-gray-800">Detail Keluhan</h1>
                
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-700">Nama</h2>
                    <p class="text-gray-600">{{ $service->name }}</p>
                </div>
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-700">Email / No Telepon</h2>
                    <p class="text-gray-600">{{ $service->contact }}</p>
                </div>
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-700">Pesan</h2>
                    <p class="text-gray-600">{{ $service->message }}</p>
                </div>

                <div class="mt-6 flex items-center gap-4">
                    <!-- Tombol Hapus -->
                    <form action="{{ route('admin.services.delete', $service) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus service ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-5 py-2 rounded-md shadow-md hover:bg-red-700">
                            Hapus
                        </button>
                    </form>
                    
                    <!-- Tombol Kembali -->
                    <a href="{{ route('admin.services.index') }}" class="bg-blue-500 text-white px-5 py-2 rounded-md shadow-md hover:bg-blue-600">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
