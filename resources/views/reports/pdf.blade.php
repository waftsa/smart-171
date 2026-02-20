<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $report->title }}
        </h2>
    </x-slot>

    <iframe 
        src="{{ asset('storage/' . $report->file_path) }}" 
        width="100%" 
        height="800px"
        class="rounded-lg border">
    </iframe>
</x-app-layout>