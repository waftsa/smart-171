<x-app-layout>
<div class="bg-[#1D4161]">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="absolute top-0 left-0 w-full h-56 bg-gradient-to-b from-[#1D4161] to-transparent pointer-events-none z-10"></div>  

        <div class="relative">
            <!-- Thumbnail Image -->
            <img src="{{ asset('images/donation.jpg') }}" alt="Donation Thumbnail" class="w-full h-auto sm:h-42 object-cover rounded-b-3xl shadow-lg mb-[-25px]">
        </div>


            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
            <h2 class="text-3xl font-bold text-[#1D4161] mb-4 text-center underline  decoration-[#e16976] underline-offset-4">{{ $category->name }}</h2>
            <!-- Donasi Lainnya -->
            <div id="donation-list">
                <h2 class="text-xl font-bold text-[#1D4161] mb-4">Donasi </h2>
                
                <!-- Grid hanya memiliki 1 kolom -->
                <div class="grid grid-cols-1 gap-6">
                    @foreach ($donations as $donation)
                    <a href="{{ route('donations.show', $donation)}}">
                        <div class="bg-white p-4 rounded-lg border border-gray-300 hover:shadow-lg flex items-center">
                            <img src="{{ $donation->thumbnail }}" 
                                alt="{{ $donation->name }}" 
                                class="w-32 h-24 object-cover rounded-lg mr-4">
                            <div class="flex-1">
                                <h3 class="font-semibold mb-2">{{ $donation->name }}</h3>
                                <p class="text-gray-600 text-sm mb-1">
                                    <strong class="text-[#1D4161]">Rp {{ number_format($donation->donaturs->sum('total_amount'), 0, ',', '.') }} </strong>
                                    Terkumpul
                                </p>
                                <div class="w-full bg-slate-300 h-2 rounded-full">
                                    <div class="bg-[#1D4161] h-2 rounded-full" style="width: {{ $donation->percentage ?? 0 }}%"></div>
                                </div>
                                <p class="text-gray-600 text-xs m-2">
                                    Tersisa <strong class="text-[#e16976]">Rp {{ number_format($donation->target_amount - $donation->donaturs->sum('total_amount'), 0, ',', '.') }}</strong>
                                </p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                
            </div>


        </div>
    </div>
</div>
</x-app-layout>
