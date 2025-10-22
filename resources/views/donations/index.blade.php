<x-app-layout>
<div class="bg-[#1D4161]">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="absolute top-0 left-0 w-full h-56 bg-gradient-to-b from-[#1D4161] to-transparent pointer-events-none z-10"></div>  

        <div class="relative mt-18">
                <!-- Thumbnail Image -->
                <img src="{{ asset('images/donation.jpg') }}" alt="Donation Thumbnail" class="w-full h-auto md:h-64 sm:h-42 object-cover rounded-b-3xl shadow-lg mb-[-25px]">
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">

            <!-- 3 Donasi Terbaru -->
            <div class="mb-10">
                <h2 class="text-2xl font-bold text-[#1D4161] mb-4">Donasi Terbaru</h2>
                <div class="flex gap-3 overflow-x-auto px-2 scrollbar-hide">
                    @foreach ($donations->sortByDesc('created_at')->take(3) as $donation)
                        <div class="flex-shrink-0 bg-white p-1 rounded-lg border border-gray-300 hover:shadow-lg flex flex-col w-64">
                            <a href="{{ route('donations.show', $donation)}}">
                            <img src="{{ $donation->thumbnail }}" alt="{{ $donation->name }}" class="w-full h-32 object-cover rounded-lg mb-4">
                            
                            <div class="p-2">
                            <h3 class="font-semibold mb-2 text-left">{{ $donation->name }}</h3>
                            @if($donation->has_finished)
                            <p class="text-gray-600 text-sm mb-2 text-left">
                                <strong class="text-[#1D4161]">Rp {{ number_format($donation->donaturs->sum('total_amount'), 0, ',', '.') }}</strong> Terkumpul
                            </p>
                            <div class="w-full bg-slate-300 h-2 rounded-full mb-2">
                                <div class="bg-[#e16976] h-2 rounded-full" style="width: {{ $donation->percentage ?? 0 }}%"></div>
                            </div>
                            <p class="text-gray-600 text-xs text-left">
                                <strong class="text-[#e16976]">Campaign ini sudah mencapai target</strong>
                            </p>                       
                            @else
                            <p class="text-gray-600 text-sm mb-2 text-left">
                                <strong class="text-[#1D4161]">Rp {{ number_format($donation->donaturs->sum('total_amount'), 0, ',', '.') }}</strong> Terkumpul
                            </p>
                            <div class="w-full bg-slate-300 h-2 rounded-full mb-2">
                                <div class="bg-[#1D4161] h-2 rounded-full" style="width: {{ $donation->percentage ?? 0 }}%"></div>
                            </div>
                            <p class="text-gray-600 text-xs text-left">
                                Tersisa <strong class="text-[#e16976]">Rp {{ number_format($donation->target_amount - $donation->donaturs->sum('total_amount'), 0, ',', '.') }}</strong>
                            </p>
                            @endif
                            </a>
                            
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Kategori Donasi -->
            <div class="mb-10">
                <h2 class="text-2xl font-bold text-[#1D4161] mb-2">Kategori Donasi</h2>
                <div class="flex gap-4 overflow-x-auto px-4 sm:grid sm:grid-cols-4 sm:gap-6 sm:overflow-visible">
                    @foreach ($categories as $category)
                        <a href="{{ route('donations.category', $category->slug)}}" 
                            
                            class="flex flex-col items-center flex-shrink-0 rounded-xl w-20 sm:w-24 h-auto sm:h-auto p-2 text-center ">
                            <img src="{{ $category->icon }}" 
                                alt="{{ $category->name }}" 
                                class="w-16 sm:w-20 h-16 sm:h-20 rounded-full object-cover mb-2 hover:scale-105 transition-transform duration-300">
                            <span class="text-xs sm:text-sm text-gray-600 max-w-[90px] sm:max-w-full">
                                {{ $category->name }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Donasi Lainnya -->
            <div id="donation-list">
                <h2 class="text-2xl font-bold text-[#1D4161] mb-4">Donasi Lainnya</h2>
                <!-- Grid hanya memiliki 1 kolom -->
                <div class="grid grid-cols-1 gap-3">
                    @foreach ($donations as $donation)
                    <a href="{{ route('donations.show', $donation)}}">
                        <div class="bg-white p-1 rounded-lg border border-gray-300 hover:shadow-lg flex items-center">
                            <img src="{{ $donation->thumbnail }}" 
                                alt="{{ $donation->name }}" 
                                class="w-32 h-24 object-cover rounded-lg mr-4">
                            <div class="flex-1 p-1">
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
                <div class="mt-6">
                    {{ $donations->links('pagination::tailwind-custom') }}
                </div>
            </div>


        </div>
    </div>
</div>
</x-app-layout>
