<section id="countUp" class="absolute top-[520px] left-0 right-0 z-10">
    <script type="module" src="https://cdn.jsdelivr.net/npm/countup.js@2.6.2/dist/countUp.min.js"></script>

    <div class="flex justify-center">
        <div class="bg-white rounded-lg shadow-lg w-max">
            <div class="grid grid-cols-3 sm:grid-cols-3 gap-2">

                <!-- Programs -->
                <div class="text-[#1D4161] p-4 text-center" id="programs">
                    <h3 class="text-xs sm:text-sm md:text-md font-semibold">Program Donasi</h3>
                    <p class="mt-2 text-sm sm:text-base md:text-xl">
                        <span id="programs-count">0</span><span class="text-xs align-top ml-1 text-gray-500">++</span>
                    </p>
                </div>

                <!-- Orang Tua Asuh -->
                <div class="text-[#1D4161] p-4 text-center" id="ortu-asuh">
                    <h3 class="text-xs sm:text-sm md:text-md font-semibold">Anak Asuh Yatim Gaza</h3>
                    <p class="mt-2 text-sm sm:text-base md:text-xl">
                        <span id="ortu-asuh-count">0</span><span class="text-xs align-top ml-1 text-gray-500">++</span>
                    </p>
                </div>

                <!-- Jumlah Donasi -->
                <div class="text-[#1D4161] p-4 text-center" id="donation">
                    <h3 class="text-xs sm:text-sm md:text-md font-semibold">Penerima Manfaat</h3>
                    <p class="mt-2 text-sm sm:text-base md:text-xl">
                        <span id="donation-count">0</span><span class="text-xs align-top ml-1 text-gray-500">++</span>
                    </p>
                </div>

            </div>
        </div>
    </div>

    <!-- Pakai script JS kamu di bawah ini -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function startCountUp(elementId, startVal, endVal, decimals, duration) {
                const countUp = new CountUp(elementId, startVal, endVal, decimals, duration);
                if (!countUp.error) {
                    countUp.start();
                } else {
                    console.error(countUp.error);
                }
            }

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        if (entry.target.id === "programs") {
                            startCountUp('programs-count', 0, 50, 0, 2.5);
                        } else if (entry.target.id === "ortu-asuh") {
                            startCountUp('ortu-asuh-count', 0, 3000, 0, 2.5);
                        } else if (entry.target.id === "donation") {
                            startCountUp('donation-count', 0, 10000, 0, 2.5);
                        }
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            observer.observe(document.getElementById('programs'));
            observer.observe(document.getElementById('ortu-asuh'));
            observer.observe(document.getElementById('donation'));
        });
    </script>
</section>
