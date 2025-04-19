<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Donation Details') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">

                @if($donation->is_active)
                <span class="text-white font-bold bg-green-500 rounded-2xl w-fit p-5">
                    Donation campaign is active and can receive donations
                </span>
                
                @else
                <div class="flex flex-row justify-between">
                    <span class="text-white font-bold bg-red-500 rounded-2xl w-fit p-5">
                        Donation campaign is not active
                    </span>
                    <form action="{{ route('admin.donations.publish', $donation) }}" method="POST">
                            @csrf
                            <button type="submit" class="font-bold py-2 px-3 bg-indigo-700 text-white rounded-lg">
                                Activate
                            </button>
                        </form>
                </div>
                @endif
                
                @if($donation->has_finished)
                <span class="text-white font-bold bg-red-500 rounded-2xl w-fit p-5">
                    Donation sudah mencapai target
                </span>
                @endif

                <hr>

                <div class="item-card flex flex-row gap-y-10 justify-between items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{ $donation->thumbnail }}" alt="" class="rounded-2xl object-cover w-[200px] h-[150px]">
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $donation->name }}</h3>
                        </div>
                    </div>
                    <div class="flex flex-row items-center gap-x-3">
                        <a href="{{ route('admin.donations.edit', $donation) }}" class="font-bold py-2 px-3 bg-indigo-700 text-white rounded-lg">
                            Edit
                        </a>
                        <form action="{{ route('admin.donations.destroy', $donation) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-bold py-2 px-3 bg-red-700 text-white rounded-lg">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

                <hr class="my-5">
                <div class="flex flex-row justify-between items-center">
                    <div>
                        <h3 class="text-indigo-950 text-xl font-bold">Rp {{ number_format($totalDonations, 0, ',', '.') }}</h3>
                        <p class="text-slate-500 text-sm">Funded</p>
                    </div>
                    <div class="w-[400px] rounded-lg h-2.5 bg-slate-300">
                        <div class="bg-indigo-600 h-2.5 rounded-lg" style="width: {{ $percentage }}%"></div>
                    </div>
                    <div>
                        <h3 class="text-indigo-950 text-xl font-bold">Rp {{ number_format($donation->target_amount, 0, ',', '.') }}</h3>
                        <p class="text-slate-500 text-sm">Goal</p>
                    </div>
                </div>

                <hr class="my-5">
                <div class="flex flex-col gap-4">
                    <div>
                        <h3 class="text-indigo-950 text-xl font-bold">Sub Judul Program</h3>
                        <p class="text-slate-500 text-sm">{{$donation->thumbnail_text}}</p>
                    </div>
                    <div>
                        <h3 class="text-indigo-950 text-xl font-bold">About</h3>
                        <p class="text-slate-500 text-sm">{!! $donation->about !!}</p>
                    </div>
                </div>

                <hr class="my-5">
                <div class="flex flex-row justify-between items-center">
                    <div>
                        <h3 class="text-indigo-950 text-xl font-bold">Kode Unik</h3>
                        <p class="text-slate-800 text-lg">{{$donation->code}}</p>
                    </div>
                    <div>
                        <h3 class="text-indigo-950 text-xl font-bold">Total Donaturs</h3>
                        <p class="text-slate-800 text-lg">{{ $donation->donaturs->count() }}</p>
                    </div>
                    <div>
                    <h3 class="text-indigo-950 text-xl font-bold mb-2">Slider Homepage</h3>
                        @if($donation->slider)
                            <span class="w-fit text-sm font-bold py-2 px-3 rounded-lg bg-blue-500 text-white">
                            Tampilkan pada slider
                            </span>                                                                                                                
                            @else                      
                            <span class="w-fit text-sm font-bold py-2 px-3 rounded-lg bg-orange-500 text-white">
                            Tidak ditampilkan pada slider
                            </span>
                            @endif
                    </div>
                </div>

                <hr class="my-5">

                <div class="flex flex-row justify-between items-center">
                    <div class="flex flex-col">
                        <h3 class="text-indigo-950 text-xl font-bold">Donaturs</h3>
                    </div>
                </div>

                @forelse($donation->donaturs as $donatur)
                <div class="item-card flex flex-row gap-y-10 justify-between items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-m font-bold">{{ $donatur->name }}</h3>
                            <p class="text-slate-600 text-sm">Rp {{ number_format($donatur->total_amount, 0, ',', '.') }}</p>
                            <p class="text-slate-500 text-sm">"{{ $donatur->notes }}"</p>
                        </div>
                        
                    </div>
                    <a href="{{ route('admin.donaturs.show', $donatur) }}" class="text-m text-blue-500">Detail Donatur</a>
                </div>
                @empty
                <p>There are no donations yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
