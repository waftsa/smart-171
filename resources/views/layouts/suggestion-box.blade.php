<!-- Floating Suggestion Box -->
<div id="suggestion-box" class="fixed bottom-6 right-6">
    <!-- Tombol untuk membuka kotak saran -->
    <button id="suggestion-btn" class="bg-[#e16976] text-white p-3 rounded-full shadow-lg hover:bg-[#c85664] transition">
        💬
    </button>

    <!-- Modal Form Saran -->
    <div id="suggestion-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg w-96 shadow-lg relative">
            <!-- Tombol Tutup (X) di pojok kanan atas -->
            <button id="close-btn" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                ✖
            </button>

            <h2 class="text-lg font-bold text-gray-700 mb-4">Kotak Saran</h2>

            <form action="{{ route('contact-us.send') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Nama -->
                <div>
                    <label for="name" class="block text-gray-700 font-medium">Nama Anda</label>
                    <input type="text" id="name" name="name" placeholder="Masukkan nama Anda" required
                        class="w-full p-3 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                </div>

                <!-- Kontak -->
                <div>
                    <label for="contact" class="block text-gray-700 font-medium">Email atau No Telp</label>
                    <input type="text" id="contact" name="contact" placeholder="Masukkan email atau nomor telepon" required
                        class="w-full p-3 border border-gray-300 rounded-md focus:ring focus:ring-blue-300">
                </div>

                <!-- Pesan -->
                <div>
                    <label for="message" class="block text-gray-700 font-medium">Pesan Anda</label>
                    <textarea id="message" name="message" placeholder="Tulis pesan Anda di sini..." required
                        class="w-full p-3 border border-gray-300 rounded-md focus:ring focus:ring-blue-300"></textarea>
                </div>

                <!-- Tombol Kirim & Batal -->
                <div class="flex justify-between">
                    <button type="button" id="cancel-btn" class="bg-gray-400 text-white py-2 px-4 rounded-md hover:bg-gray-500 transition">
                        Batal
                    </button>

                    <button type="submit" class="bg-[#1D4161] text-white py-2 px-4 rounded-md hover:bg-opacity-80 transition">
                        Kirim Pesan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- JavaScript untuk Modal -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const suggestionBtn = document.getElementById("suggestion-btn");
        const modal = document.getElementById("suggestion-modal");
        const closeBtn = document.getElementById("close-btn");
        const cancelBtn = document.getElementById("cancel-btn");

        // Buka modal ketika tombol diklik
        suggestionBtn.addEventListener("click", () => {
            modal.classList.remove("hidden");
        });

        // Tutup modal ketika tombol ✖ atau Batal diklik
        closeBtn.addEventListener("click", () => {
            modal.classList.add("hidden");
        });

        cancelBtn.addEventListener("click", () => {
            modal.classList.add("hidden");
        });
    });
</script>
