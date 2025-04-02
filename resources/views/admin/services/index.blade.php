<x-app-layout>
<x-slot name="header">
    <div class="flex flex-row justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Customer Service') }}
        </h2>
        
    </div>
</x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
            <div class="flex justify-between items-center mb-6">
                    <div class="flex items-center gap-4">
                        <form action="#" method="GET" class="flex flex-wrap gap-4 items-center">
                            <input type="text" name="search" value="{{ request()->query('search') }}" 
                                placeholder="Cari user..." 
                                class="px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-700" />
                            
                            <select name="sort_by" class="px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-700">
                                <option value="newest" {{ request()->query('sort_by') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                                <option value="oldest" {{ request()->query('sort_by') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            </select>

                            <button type="submit" class="px-4 py-2 bg-indigo-700 text-white rounded-lg hover:bg-indigo-800">
                                Filter
                            </button>
                        </form>
                    </div>
                    
                </div>

                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="border-b">
                                <th class="px-4 py-2 text-left">Nama</th>
                                <th class="px-4 py-2 text-left">Contact</th>
                                <th class="px-4 py-2 text-left">Tanggal Dibuat</th>
                                <th class="px-4 py-2 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($services as $service)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $service->name }}</td>
                                    <td class="px-4 py-2">{{ $service->contact }}</td>
                                    <td class="px-4 py-2">{{ $service->created_at->format('d M Y') }}</td>
                                    <td class="px-4 py-2 flex gap-2">
                                        <a href="{{ route('admin.services.show', $service) }}" class="px-3 py-1 bg-indigo-600 text-white rounded-lg text-m font-semibold hover:bg-indigo-700">
                                            Detail
                                        </a>
                                        <form action="{{ route('admin.services.delete', $service) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded-lg text-m font-semibold hover:bg-red-700">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                        Belum ada data layanan tersedia.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

            
            </div>
        </div>
    </div>
</x-app-layout>
