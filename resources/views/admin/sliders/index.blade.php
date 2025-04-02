<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Slider') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="borber-b">
                            <th class="px-4 py-2 text-left">Thumbnail</th>
                            <th class="px-4 py-2 text-left">Judul / Nama</th>
                            <th class="px-4 py-2 text-left">Type</th>
                            <th class="px-4 py-2 text-left">About / Summary</th>
                            <th class="px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sliders as $slider)
                            <tr class="borber-b">
                                <!-- Thumbnail -->
                                <td class="px-4 py-2">
                                    @php
                                        $youtubeLink = $slider->youtube;
                                        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/|.*v=))([\w-]+)/', $youtubeLink, $matches)) {
                                            $videoId = $matches[1];
                                            $thumbnailUrl = "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg";
                                        } else {
                                            $thumbnailUrl = null;
                                        }
                                    @endphp
                                    @if ($thumbnailUrl)
                                        <img src="{{ $thumbnailUrl }}" alt="Thumbnail" class="w-[120px] h-[90px] object-cover rounded-lg">
                                    @else
                                        <img src="{{ Storage::url($slider->cover ?? $slider->thumbnail) }}" alt="Default Thumbnail" class="w-[120px] h-[90px] object-cover rounded-lg">
                                    @endif
                                </td>
                                <!-- Judul / Nama -->
                                <td class="px-4 py-2">
                                    {{ $slider->title ?? $slider->name }}
                                </td>
                                <!-- Type -->
                                <td class="px-4 py-2 ">
                                    {{ ucfirst($slider->type) }}
                                </td>
                                <!-- About / Summary -->
                                <td class="px-4 py-2">
                                    {{ Str::limit($slider->about ?? $slider->summary ?? $slider->caption, 100, '...') }}
                                </td>
                                <!-- Aksi -->
                                <td class="px-4 py-2">
                                    <form action="{{ route('admin.sliders.destroy', ['type' => $slider->type, 'id' => $slider->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dari slider?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-500">
                                    Tidak ada data slider saat ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
