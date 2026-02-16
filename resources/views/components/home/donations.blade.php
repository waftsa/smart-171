@props(['donations'])

<!-- Donations Section -->
<section id="donations" class="py-12 relative bg-cover bg-center opacity-0 translate-y-10 transition-all duration-1000">
    <div class="absolute inset-0 bg-[#1D4161]"></div> <!-- Blue overlay with 25% opacity -->
    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <h1 class="text-5xl font-extrabold text-center mb-4 text-gray-100 underline  decoration-[#e16976] underline-offset-4">Smart Campaign</h1>
        <br><br>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($donations->sortByDesc('created_at')->take(3) as $donation)

                <div class="bg-white p-4 shadow-md rounded-md transform transition duration-300 hover:scale-105">
                    <img src="{{ $donation->thumbnail }}" 
                        alt="{{ $donation->name }}" 
                        width="600"
                        height="400"
                        loading="lazy"
                        class="w-full h-36 object-cover rounded-t-md">
                    <br>
                    <h3 class="mt-2 font-bold text-xl text-center">{{ $donation->name }}</h3>
                    <hr class="my-4">
                    <!-- Terkumpul dan Target di baris atas -->
                    <div class="flex justify-between items-center mb-4">
                        <!-- Terkumpul Section - Left -->
                        <div class="flex flex-col items-start">
                            <p class="text-slate-500 text-sm">
                                 <strong class="text-[#1D4161] text-m">Rp {{ number_format($donation->donaturs->sum('total_amount'), 0, ',', '.') }}</strong> 
                                 terkumpul dari Rp {{ number_format($donation->target_amount, 0, ',', '.') }}
                            </p>
                            
                        </div>
                    </div>

                    <!-- Progress Bar di baris bawah -->
                    <div class="flex justify-between items-center">
                        <div class="w-full rounded-full h-2.5 bg-slate-300">
                            <div class="bg-[#1D4161] h-2.5 rounded-full" style="width: {{ ($donation->donaturs->sum('total_amount') / $donation->target_amount) * 100 }}%"></div>
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex flex-col items-start">
                            <p class="text-slate-500 text-sm">Tersisa 
                                 <strong class="text-[#e16976] text-m">Rp {{ number_format($donation->target_amount - $donation->donaturs->sum('total_amount'), 0, ',', '.') }}</strong> 
                            </p>   
                        </div>
                    </div>
                    
                    <div class="mt-4 text-center">
                        <a href="{{ route('donations.donate', $donation) }}" class="inline-block bg-[#1D4161] text-white py-2 px-6 rounded-lg hover:bg-[#163D51]">
                        Beri Donasi Sekarang
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-6 text-center">
            <a href="{{ route('donations.list') }}" class="text-white font-semibold">Lihat Donasi Lainnya</a>
        </div>
    </div>
</section>

