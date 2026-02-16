<x-app-layout>
<x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Slider
        </h2>
    </div>
</x-slot>

<div class="py-10">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="bg-white shadow-sm sm:rounded-lg p-6">

{{-- Counter Per Type --}}
<div class="mb-4 text-sm text-gray-600">
    Articles: {{ $sliders->where('type','smartnews')->count() }}/2 |
    Donations: {{ $sliders->where('type','smartcampaign')->count() }}/2 |
    Releases: {{ $sliders->where('type','smartreleases')->count() }}/2 |
    Documentations: {{ $sliders->where('type','documentations')->count() }}/2
</div>

<form action="{{ route('admin.sliders.bulkDelete') }}" method="POST">
@csrf
@method('DELETE')

<table class="min-w-full table-auto">
<thead>
<tr class="border-b">
    <th class="px-4 py-2">
        <input type="checkbox" id="selectAll">
    </th>
    <th class="px-4 py-2 text-left">Thumbnail</th>
    <th class="px-4 py-2 text-left">Judul / Nama</th>
    <th class="px-4 py-2 text-left">Type</th>
    <th class="px-4 py-2 text-left">About / Summary</th>
    <th class="px-4 py-2 text-left">Aksi</th>
</tr>
</thead>

<tbody>
@forelse ($sliders as $slider)
<tr class="border-b">
<td class="px-4 py-2">
    <input type="checkbox" 
        name="selected[]" 
        value="{{ $slider->type }}|{{ $slider->id }}"
        class="rowCheckbox">
</td>

<td class="px-4 py-2">
@php
    $youtubeLink = $slider->youtube ?? null;
    if ($youtubeLink && preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/|.*v=))([\w-]+)/', $youtubeLink, $matches)) {
        $videoId = $matches[1];
        $thumbnailUrl = "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg";
    } else {
        $thumbnailUrl = null;
    }
@endphp

@if ($thumbnailUrl)
    <img src="{{ $thumbnailUrl }}" class="w-[120px] h-[90px] object-cover rounded-lg">
@else
    <img src="{{ Storage::url($slider->cover ?? $slider->thumbnail) }}" 
         class="w-[120px] h-[90px] object-cover rounded-lg">
@endif
</td>

<td class="px-4 py-2">
    {{ $slider->title ?? $slider->name }}
</td>

<td class="px-4 py-2">
    {{ ucfirst($slider->type) }}
</td>

<td class="px-4 py-2">
    {{ Str::limit($slider->about ?? $slider->summary ?? $slider->caption, 100) }}
</td>

<td class="px-4 py-2">
    <form action="{{ route('admin.sliders.destroy', ['type' => $slider->type, 'id' => $slider->id]) }}" method="POST" onsubmit="return confirm('Hapus slider ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
            Hapus
        </button>
    </form>
</td>
</tr>
@empty
<tr>
<td colspan="6" class="text-center py-4 text-gray-500">
    Tidak ada data slider.
</td>
</tr>
@endforelse
</tbody>
</table>

<div class="mt-4">
    <button type="submit"
        onclick="return confirm('Hapus semua slider terpilih?')"
        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
        Delete Selected
    </button>
</div>

</form>
</div>
</div>
</div>

<script>
document.getElementById('selectAll').addEventListener('click', function() {
    document.querySelectorAll('.rowCheckbox').forEach(cb => {
        cb.checked = this.checked;
    });
});
</script>

</x-app-layout>
