<x-app-layout>
    <div class="bg-[#1D4161]">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="absolute top-0 left-0 w-full h-56 bg-gradient-to-b from-[#1D4161] to-transparent pointer-events-none z-10"></div>  

            <div class="relative">                
                <!-- Thumbnail Image -->
                <img src="{{ $donation->thumbnail }}" alt="Donation Thumbnail" class="w-full h-auto sm:h-42 object-cover rounded-b-3xl shadow-lg mb-[-25px]">
            </div>
            <div class="bg-white overflow-hidden shadow-sm p-5 space-y-6">
                
                <!-- Donation Program Info -->
                <div class="flex flex-col items-center mb-6">
                  
                    <div class="text-center">
                        <p class="text- text-gray-900">Anda akan berdonasi dalam program:</p>
                        <h3 class="text-xl font-semibold text-indigo-950">{{ $donation->name }}</h3>
                    </div>
                </div>

                
                <!-- Donation Form -->
                <form action="{{ route('donations.store', $donation) }}" method="POST" >
                    @csrf
                    <div class="mb-6">
                        <p class="text-m text-gray-900 mb-2">Pilih Nominal Donasi</p>
                        <div class="grid grid-cols-2 sm:grid-cols-3 w-full mx-auto justify-center gap-3 p-2">

                        <label for="amount15k" class="flex flex-col gap-4 p-4 rounded-lg border-1 border-gray-700 items-center cursor-pointer transition-transform transform sm:scale-100 scale-90">
                            <input type="radio" name="total_amount" id="amount15k" value="10000" class="hidden peer" >
                                <div class="w-8 h-8 sm:w-10 sm:h-10 flex shrink-0 overflow-hidden">
                                    <img src="{{ asset('icons/cool.svg') }}" alt="icon">
                                </div>
                                <span class="font-bold text-sm sm:text-m peer-checked:text-[#e16976]">Rp 10.000</span>
                            </label>

                        <label for="amount20k" class="flex flex-col gap-4 p-4 rounded-lg border-1 border-gray-700 items-center cursor-pointer transition-transform transform sm:scale-100 scale-90">
                            <input type="radio" name="total_amount" id="amount20k" value="20000" class="hidden peer" >
                                <div class="w-8 h-8 sm:w-10 sm:h-10 flex shrink-0 overflow-hidden">
                                    <img src="{{ asset('icons/beaming.svg') }}" alt="icon">
                                </div>
                                <span class="font-bold text-sm sm:text-m peer-checked:text-[#e16976]">Rp 20.000</span>
                            </label>

                        <label for="amount50k" class="flex flex-col gap-4 p-4 rounded-lg border-1 border-gray-700 items-center cursor-pointer transition-transform transform sm:scale-100 scale-90">
                            <input type="radio" name="total_amount" id="amount50k" value="50000" class="hidden peer" >
                                <div class="w-8 h-8 sm:w-10 sm:h-10 flex shrink-0 overflow-hidden">
                                    <img src="{{ asset('icons/love.svg') }}" alt="icon">
                                </div>
                                <span class="font-bold text-sm sm:text-m peer-checked:text-[#e16976]">Rp 50.000</span>
                            </label>

                        <label for="amount100k" class="flex flex-col gap-4 p-4 rounded-lg border-1 border-gray-700 items-center cursor-pointer transition-transform transform sm:scale-100 scale-90">
                            <input type="radio" name="total_amount" id="amount100k" value="100000" class="hidden peer" >
                                <div class="w-8 h-8 sm:w-10 sm:h-10 flex shrink-0 overflow-hidden">
                                    <img src="{{ asset('icons/grin.svg') }}" alt="icon">
                                </div>
                                <span class="font-bold text-sm sm:text-m peer-checked:text-[#e16976]">Rp 100.000</span>
                            </label>

                        <label for="amount150k" class="flex flex-col gap-4 p-4 rounded-lg border-1 border-gray-700 items-center cursor-pointer transition-transform transform sm:scale-100 scale-90">
                            <input type="radio" name="total_amount" id="amount150k" value="150000" class="hidden peer" >
                                <div class="w-8 h-8 sm:w-10 sm:h-10 flex shrink-0 overflow-hidden">
                                    <img src="{{ asset('icons/shock.svg') }}" alt="icon">
                                </div>
                                <span class="font-bold text-sm sm:text-m peer-checked:text-[#e16976]">Rp 150.000</span>
                            </label>

                            <label for="amount200k" class="flex flex-col gap-4 p-4 rounded-lg border-1 border-gray-700 items-center cursor-pointer transition-transform transform sm:scale-100 scale-90">
                                <input type="radio" id="amount200k" name="total_amount" value="200000"id="amount1m" class="hidden peer" >
                                <div class="w-8 h-8 sm:w-10 sm:h-10 flex shrink-0 overfl ow-hidden">
                                    <img src="{{ asset('icons/privacy.svg') }}" alt="icon">
                                </div>
                                <span class="font-bold text-sm sm:text-m peer-checked:text-[#e16976]">Rp 200.000</span>
                            </label>

                        </div>
                    </div>
                    
                    <!-- Custom Nominal Input -->
                    <div class="flex flex-col mb-4">
                        <label for="customNominal" class="text-gray-900 text-sm mb-1">Atau Masukkan Nominal (min. Rp 10.000):</label>
                        <input type="number" id="customNominal" name="total_amount" 
                            class="border rounded-md p-2 focus:ring-2 focus:ring-blue-500 disabled:border-gray-300 disabled:bg-gray-100" 
                            min="10000" placeholder="Masukkan Nominal">
                    </div>

                    <div class="flex flex-col mb-4">
                        <div class="relative">
                            <button id="paymentMethodBtn" type="button" class="w-full py-2 px-4 bg-white border-gray-700 border-1 rounded-md text-left flex items-center justify-between focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                <span id="selectedPaymentMethod">Pilih Metode Pembayaran</span>
                                <span>&#9662;</span>
                            </button>
                            
                            <!-- Pop-up for Payment Options -->
                            <div id="paymentOptions" class="hidden absolute top-full mt-2 w-full bg-white border rounded-md shadow-lg z-10">
                            <ul class="text-slate-700">
                                <li class="flex items-center justify-between px-4 py-2 cursor-pointer hover:bg-slate-100" onclick="selectPaymentMethod('Bank BSI (Transfer Bank)')">
                                    Bank BSI (Transfer Bank)
                                    <img src="{{asset('images/bsi-logo.png')}}" alt="BSI Logo" class="w-12 h-auto">
                                </li>
                                <li class="flex items-center justify-between px-4 py-2 cursor-pointer hover:bg-slate-100" onclick="selectPaymentMethod('Scan QRCode / Qris')">
                                    Scan QRCode / Qris
                                    <img src="{{asset('images/qris-logo.png')}}" alt="QRIS Logo" class="w-12 h-auto">
                                </li>
                            </ul>
                        </div>

                        </div>
                    </div>

  
                    <div class="flex flex-col mb-4">
                        <label for="name" class="text-gray-900 text-sm">Nama Donatur</label>
                        <input type="text" name="name" id="name" 
                            class="border-gray-700 border-1 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <!-- Toggle for Anonymous Donation -->
                    <div class="flex items-center mb-4">
                        <input type="checkbox" id="anonim" name="anonim" class="mr-2" value="1">
                        <label for="anonim" class="text-gray-900 text-m">Tampilkan sebagai Hamba Allah</label>
                    </div>

                    <!-- Email or Phone -->
                    <div class="flex flex-col mb-4">
                        <label for="email_or_phone" class="text-gray-900 text-sm">No Telepon</label>
                        <input type="text" name="email" id="email_or_phone" 
                            class="border-gray-700 border-1 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    
                    <!-- Message or Prayer -->
                    <div class="flex flex-col mb-4">
                        <label for="notes" class="text-gray-900 text-sm">Tuliskan pesan atau doa disini (opsional)</label>
                        <textarea name="notes" id="notes" rows="4" 
                            class="border-gray-700 border-1 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>


                    <input type="hidden" name="donation_id" id="donation_id" value="{{ $donation->id}}">
                    <input type="hidden" name="payment_method" id="paymentMethodInput">

                    <!-- Donate Button -->
                    <button type="submit" class="w-full py-2 bg-[#1D4161] text-white font-bold rounded-md">Donasi Sekarang</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const paymentMethodBtn = document.getElementById('paymentMethodBtn');
        const paymentOptions = document.getElementById('paymentOptions');
        const selectedPaymentMethod = document.getElementById('selectedPaymentMethod');
        const paymentMethodInput = document.getElementById('paymentMethodInput');

        // Toggle display of payment options when clicking the button
        paymentMethodBtn.addEventListener('click', () => {
            paymentOptions.classList.toggle('hidden');
        });

        // Set selected payment method and close the options list
        function selectPaymentMethod(method) {
            selectedPaymentMethod.textContent = method;
            paymentMethodInput.value = method;
            paymentOptions.classList.add('hidden');
        }

        // Close payment options if clicked outside
        document.addEventListener('click', (event) => {
            if (!paymentMethodBtn.contains(event.target) && !paymentOptions.contains(event.target)) {
                paymentOptions.classList.add('hidden');
            }
        });


        // Disable or Enable Custom Nominal Input based on radio button selection
        const radioButtons = document.querySelectorAll('input[name="total_amount"]');
        const customNominalInput = document.getElementById('customNominal');

        function updateRequiredAttributes() {
            const anyRadioChecked = Array.from(radioButtons).some(radio => radio.checked);
            
            if (anyRadioChecked) {
                customNominalInput.required = false; // Disable required pada custom nominal
            } else {
                customNominalInput.required = true; // Enable required pada custom nominal
            }
        }
        
        radioButtons.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.checked) {
                    customNominalInput.disabled = true; // Disable custom nominal jika radio dipilih
                } else {
                    customNominalInput.disabled = false; // Enable custom nominal jika radio tidak dipilih
                }
                updateRequiredAttributes();
            });
        });

        customNominalInput.addEventListener('input', () => {
            if (customNominalInput.value !== "") {
                radioButtons.forEach(radio => {
                    radio.checked = false; // Uncheck semua radio jika custom nominal diisi
                });
            }
            updateRequiredAttributes();
        });

        // Inisialisasi
        updateRequiredAttributes();

        

    </script>
</x-app-layout>
