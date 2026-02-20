
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Report OTA') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                <div class="flex flex-row justify-between items-center align-middle">
                    <div class="flex flex-col">
                    <p class="text-slate-500 text-sm">Nama OTA</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{ $report->name }}</h3>
                    </div> 
                    <div>
                        <p class="text-slate-500 text-sm">Kode Unik OTA</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{ $report->code }}</h3>
                    </div>
                    <div>
                        <p class="text-slate-500 text-sm">Tanggal Dibuat</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{ $report->created_at->format('d M Y') }}</h3>
                    </div>  
                </div>

                <hr class="my-3">
                <div class="flex flex-row justify-between items-center align-middle">
                                   
              
                    <!-- PDF Preview -->
                    <div x-data="{ open: false }" class="flex flex-col items-center">
                        
                        <div
                            class="flex items-center justify-center cursor-pointer hover:shadow-lg transition"
                            @click="open = true"
                        >
                            <canvas
                                id="pdf-{{ $report->id }}"
                                data-pdf="{{ asset('storage/' . $report->file_path) }}"
                                class="w-[120px] h-[150px] rounded-lg border bg-white"
                            ></canvas>
                        </div>

                        <span class="mt-2 font-semibold text-indigo-800 text-center">
                            {{ $report->name }}
                        </span>

                        <!-- MODAL -->
                        <div
                            x-show="open"
                            x-cloak
                            class="fixed inset-0 bg-black/60 flex items-center justify-center z-50"
                        >
                            <div class="bg-white rounded-xl w-11/12 md:w-4/5 h-[90vh] relative shadow-2xl overflow-hidden">
                                
                                <button
                                    @click="open = false"
                                    class="absolute top-3 right-3 bg-red-600 text-white px-3 py-1 rounded-full font-bold z-50"
                                >
                                    ✕
                                </button>

                                <iframe
                                    src="{{ asset('storage/' . $report->file_path) }}"
                                    class="w-full h-full"
                                    style="border:none;"
                                ></iframe>

                            </div>
                        </div>
                    </div>

                    <!-- PDF LINK SECTION -->
                    <div 
                        x-data="{ copied: false }" 
                        class="flex flex-col gap-3 bg-gray-50 p-5 rounded-xl border w-full max-w-md"
                    >
                        <h4 class="font-bold text-indigo-900 text-lg">
                            Link PDF
                        </h4>

                        @php
                            $pdfUrl = route('reports.pdf', [
                                'slug' => $report->slug,
                                'token' => $report->token
                            ]);
                        @endphp

                        <div class="flex items-center gap-2">
                            <input 
                                type="text"
                                value="{{ $pdfUrl }}"
                                readonly
                                class="w-full px-3 py-2 border rounded-lg text-sm bg-white"
                                id="flipbook-link"
                            >

                            <button
                                @click="
                                    navigator.clipboard.writeText('{{ $pdfUrl }}');
                                    copied = true;
                                    setTimeout(() => copied = false, 2000);
                                "
                                class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition"
                            >
                                Salin
                            </button>
                        </div>

                        <span 
                            x-show="copied" 
                            x-transition
                            class="text-green-600 text-sm font-semibold"
                        >
                            Link berhasil disalin!
                        </span>

                        <a 
                            href="{{ $pdfUrl }}" 
                            target="_blank"
                            class="text-indigo-700 font-semibold hover:underline text-sm"
                        >
                            Buka PDF →
                        </a>
                    </div>


                    <!-- FLIPBOOK LINK SECTION -->
                    <div 
                        x-data="{ copied: false }" 
                        class="flex flex-col gap-3 bg-gray-50 p-5 rounded-xl border w-full max-w-md"
                    >
                        <h4 class="font-bold text-indigo-900 text-lg">
                            Link Flipbook
                        </h4>

                        @php
                            $flipbookUrl = route('reports.show', [
                                'slug' => $report->slug,
                                'token' => $report->token
                            ]);
                        @endphp

                        <div class="flex items-center gap-2">
                            <input 
                                type="text"
                                value="{{ $flipbookUrl }}"
                                readonly
                                class="w-full px-3 py-2 border rounded-lg text-sm bg-white"
                                id="flipbook-link"
                            >

                            <button
                                @click="
                                    navigator.clipboard.writeText('{{ $flipbookUrl }}');
                                    copied = true;
                                    setTimeout(() => copied = false, 2000);
                                "
                                class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition"
                            >
                                Salin
                            </button>
                        </div>

                        <span 
                            x-show="copied" 
                            x-transition
                            class="text-green-600 text-sm font-semibold"
                        >
                            Link berhasil disalin!
                        </span>

                        <a 
                            href="{{ $flipbookUrl }}" 
                            target="_blank"
                            class="text-indigo-700 font-semibold hover:underline text-sm"
                        >
                            Buka Flipbook →
                        </a>
                    </div>

                </div>

                <hr class="my-2">
                <div class="flex flex-row items-center gap-x-3">
                        <a href="{{ route('admin.reports.edit', $report) }}" class="font-bold py-2 px-3 bg-indigo-700 text-white rounded-lg">
                            Edit
                        </a>
                        <form action="{{ route('admin.reports.destroy', $report) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-bold py-2 px-3 bg-red-700 text-white rounded-lg">
                                Delete
                            </button>
                        </form>
                    </div>
            </div>
        </div>
    </div>



</x-app-layout>


