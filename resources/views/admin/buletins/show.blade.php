
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

                @if($buletin->status)
                <span class="text-white font-bold bg-green-500 rounded-2xl w-fit p-5">
                    Buletin telah dipublikasikan
                </span>
                @else
                <div class="flex flex-row justify-between">
                    <span class="text-white font-bold bg-yellow-500 rounded-2xl w-fit p-5">
                        Buletin masih dalam status draft
                    </span>
                    <form action="{{ route('admin.buletins.publish', $buletin) }}" method="POST">
                        @csrf
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Publish
                        </button>
                    </form>
                </div>
                @endif

                <hr>

                <div class="flex flex-row justify-between items-center align-middle">
                    <div class="flex flex-col">
                    <p class="text-slate-500 text-sm">Judul</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{ $buletin->title }}</h3>
                    </div> 
                    <div>
                        <p class="text-slate-500 text-sm">Dibuat oleh</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{ $buletin->publisher }}</h3>
                    </div>
                    <div>
                        <p class="text-slate-500 text-sm">Tanggal Dibuat</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{ $buletin->created_at->format('d M Y') }}</h3>
                    </div>  
                </div>

                <hr class="my-3">
                <div class="flex flex-row justify-between items-center align-middle">
                                   
                    <div x-data="{ open: false }" class="flex flex-col items-center">
                        <!-- Cover Buletin -->
                        <img  width="100px"
                            src="https://res.cloudinary.com/dyotormgm/image/upload/pg_1/{{ $buletin->file_public_id }}.jpg"
                            alt="Cover Buletin"
                            class="rounded-xl shadow-md hover:shadow-xl transition cursor-pointer"
                            @click="open = true"
                        />

                        <span class="mt-2 font-semibold text-indigo-800 text-center">{{ $buletin->title }}</span>

                        <!-- Modal (Popup PDF) -->
                        <div 
                            x-show="open" 
                            x-cloak
                            class="fixed inset-0 bg-black/60 flex items-center justify-center z-50"
                        >
                            <div class="bg-white rounded-xl w-11/12 md:w-3/4 h-[90vh] pt-10 p-4 relative shadow-2xl">
                                <button 
                                    @click="open = false"
                                    class="absolute top-3 right-3 bg-red-600 text-white px-3 py-1 rounded-full font-bold hover:bg-red-700 transition"
                                >
                                    ✕
                                </button>

                                <!-- PDF Viewer -->
                                <iframe 
                                    src="https://res.cloudinary.com/dyotormgm/image/upload/{{ $buletin->file_public_id }}.pdf" 
                                    width="100%" 
                                    height="100%" 
                                    style="border:none;"
                                ></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- div ends here -->

                <hr class="my-2">
                <div class="flex flex-row items-center gap-x-3">
                        <a href="{{ route('admin.buletins.edit', $buletin) }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Edit
                        </a>
                        <form action="{{ route('admin.buletins.destroy', $buletin) }}" method="POST">
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


