<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Donatur') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                <!-- Search Bar & Filter -->
                <div class="flex justify-between items-center mb-6">
                    <form action="{{ route('admin.donaturs.filter') }}" method="GET" class="flex flex-wrap gap-4 items-center">
                        <input type="text" name="search" value="{{ request()->query('search') }}" 
                            placeholder="Cari donatur..." 
                            class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-700" />
                        
                        <select name="sort_by" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-700">
                            <option value="newest" {{ request()->query('sort_by') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request()->query('sort_by') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="pending" {{ request()->query('sort_by') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ request()->query('sort_by') == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="proof" {{ request()->query('sort_by') == 'proof' ? 'selected' : '' }}>Tanpa Bukti</option>
                        </select>

                        <button type="submit" class="px-4 py-2 bg-indigo-700 text-white rounded-lg hover:bg-indigo-800">
                            Filter
                        </button>
                    </form>
                </div>

                <!-- Table -->
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="border-b">
                            <th class="px-4 py-2 text-left">Nama Donatur</th>
                            <th class="px-4 py-2 text-left">Tanggal</th>
                            <th class="px-4 py-2 text-left">Jumlah Donasi</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donaturs as $donatur)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $donatur->name }}</td>
                            <td class="px-4 py-2">{{ $donatur->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($donatur->total_amount, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">
                                @if($donatur->is_paid)
                                    <span class="w-fit text-xs font-bold py-1 px-2 rounded-lg bg-green-300 text-green-700">
                                        PAID
                                    </span>
                                @else
                                    <span class="w-fit text-xs font-bold py-1 px-2 rounded-lg bg-orange-300 text-orange-700">
                                        PENDING
                                    </span>
                                    @if(is_null($donatur->proof))
                                        <span class="w-fit text-xs font-bold py-1 px-2 ml-2 rounded-lg bg-red-300 text-red-700">
                                            TANPA BUKTI
                                        </span>
                                    @endif
                                @endif
                            </td>

                            <td class="px-4 py-2 flex gap-3">
                                <a href="{{ route('admin.donaturs.show', $donatur) }}" class="px-4 py-2 bg-indigo-700 text-white rounded-lg hover:bg-indigo-800">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-2 text-center">
                                Belum ada donatur saat ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-4 bg-white">
                    {{ $donaturs->links('pagination::tailwind-custom') }} <!-- Pagination links -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
