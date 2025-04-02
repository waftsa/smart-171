<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Donasi') }}
        </h2>     
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
            
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center gap-4">
                    <!-- Search Bar & Sort By -->
                    <form action="{{ route('admin.donations.index') }}" method="GET" class="flex flex-wrap gap-4 items-center">
                        <input type="text" name="search" value="{{ request()->query('search') }}" 
                            placeholder="Cari donasi..." 
                            class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-700" />
                        
                        <select name="sort_by" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-700">
                            <option value="newest" {{ request()->query('sort_by') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request()->query('sort_by') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="published" {{ request()->query('sort_by') == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ request()->query('sort_by') == 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>

                        <button type="submit" class="px-4 py-2 bg-indigo-700 text-white rounded-lg hover:bg-indigo-800">
                            Filter
                        </button>
                    </form>
                </div>
                <!-- Add New Button -->
                <a href="{{ route('admin.donations.create') }}" class="font-bold py-2 px-4 bg-white border-2 border-green-700 text-green-700 rounded-lg hover:bg-green-300 hover:border-green-300">
                    Add New
                </a>
            </div>
                <!-- Table -->
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="border-b">
                            <th class="px-4 py-2 text-left">Donasi</th>
                            <th class="px-4 py-2 text-left">Target Amount</th>
                            <th class="px-4 py-2 text-left">Total Donaturs</th>
                            <th class="px-4 py-2 text-left">Total Reached</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donations as $donation)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $donation->name }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($donation->target_amount, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">{{ $donation->donaturs->count() }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($donation->totalReachedAmount(), 0, ',', '.') }}</td>
                            <td class="px-4 py-2">
                                @if($donation->has_finished)
                                <span class="w-fit text-xs font-bold py-1 px-2 rounded-lg bg-red-200 text-red-700">
                                    FINISHED
                                </span>     
                                @elseif($donation->is_active)
                                <span class="w-fit text-xs font-bold py-1 px-2 rounded-lg bg-green-300 text-green-700">
                                    ACTIVE
                                </span>
                                 
                                @else
                                <span class="w-fit text-xs font-bold py-1 px-2 rounded-lg bg-yellow-200 text-yellow-700">
                                    DRAFT
                                </span>  
                                
                                @endif 
                            </td>
                            <td class="px-4 py-2 flex gap-3">                
                                <a href="{{ route('admin.donations.edit', $donation) }}" class="text-yellow-500 mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.donations.destroy', $donation) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus donasi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 mt-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                        </svg>
                                    </button>
                                </form>
                                <a href="{{ route('admin.donations.show', $donation) }}" class="px-4 py-2 bg-indigo-700 text-white rounded-lg">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-2 text-center">
                                Belum ada donasi saat ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</x-app-layout>
