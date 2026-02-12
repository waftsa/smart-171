
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Buletin') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">

                <!-- @if($bulletin->status)
                <span class="text-white font-bold bg-green-500 rounded-2xl w-fit p-5">
                    Buletin telah dipublikasikan
                </span>
                @else
                <div class="flex flex-row justify-between">
                    <span class="text-white font-bold bg-yellow-500 rounded-2xl w-fit p-5">
                        Buletin masih dalam status draft
                    </span>
                    <form action="{{ route('admin.bulletins.publish', $bulletin) }}" method="POST">
                        @csrf
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Publish
                        </button>
                    </form>
                </div>
                @endif

                <hr> -->

                <div class="flex flex-row justify-between items-center align-middle">
                    <div class="flex flex-col">
                    <p class="text-slate-500 text-sm">Judul</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{ $bulletin->title }}</h3>
                    </div> 
                    <div>
                        <p class="text-slate-500 text-sm">Dibuat oleh</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{ $bulletin->publisher }}</h3>
                    </div>
                    <div>
                        <p class="text-slate-500 text-sm">Tanggal Dibuat</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{ $bulletin->created_at->format('d M Y') }}</h3>
                    </div>  
                </div>

                <hr class="my-3">
                <div class="flex flex-row justify-between items-center align-middle">
                                   
                    <div x-data="{ open: false }" class="flex flex-col items-center">
                        <!-- Cover Buletin -->
                        <div x-data="{ open: false }" class="flex flex-col items-center">
                        <!-- Cover PDF (placeholder / icon) -->
                        <div
                            class="flex items-center justify-center cursor-pointer hover:shadow-lg transition"
                            @click="open = true"
                        >
                            <canvas
                                id="pdf-{{ $bulletin->id }}"
                                data-pdf="{{ asset('storage/' . $bulletin->file) }}"
                                class="w-[100px] h-[120px] rounded-lg border bg-white"
                            ></canvas>
                        </div>

                        <span class="mt-2 font-semibold text-indigo-800 text-center">
                            {{ $bulletin->title }}
                        </span>

                        <!-- MODAL PDF -->
                        <div
                            x-show="open"
                            x-cloak
                            class="fixed inset-0 bg-black/60 flex items-center justify-center z-50"
                        >
                            <div class="bg-white rounded-xl w-11/12 md:w-4/5 h-[90vh] relative shadow-2xl overflow-hidden">
                                
                                <!-- Close -->
                                <button
                                    @click="open = false"
                                    class="absolute top-3 right-3 bg-red-600 text-white px-3 py-1 rounded-full font-bold z-50"
                                >
                                    ✕
                                </button>

                                <!-- PDF VIEWER -->
                                <iframe
                                    src="{{ asset('storage/' . $bulletin->file) }}"
                                    class="w-full h-full"
                                    style="border:none;"
                                ></iframe>

                            </div>
                        </div>
                    </div>

                    <!-- div ends here -->

                <hr class="my-2">
                <div class="flex flex-row items-center gap-x-3">
                        <a href="{{ route('admin.bulletins.edit', $bulletin) }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Edit
                        </a>
                        <form action="{{ route('admin.bulletins.destroy', $bulletin) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-bold py-4 px-6 bg-red-700 text-white rounded-full">
                                Delete
                            </button>
                        </form>
                    </div>
            </div>
        </div>
    </div>



</x-app-layout>


