<!-- Floating Suggestion Box -->
<div id="join-us" class="fixed bottom-24 right-4 flex flex-col items-center">
    <!-- Teks "Join Us!" -->
    <span id="join-text" class="bg-white text-[#1D4161] px-2 py-1 rounded-full shadow-md text-sm font-semibold transition-opacity duration-500">
        Join Us!
    </span>

    <!-- Tombol Telegram -->
    <a href="https://t.me/smartsatutujuan" target="_blank"
        class="bg-white text-[#1D4161] p-3 rounded-full shadow-lg hover:bg-gray-100 transition flex items-center justify-center">
        <!-- Logo Telegram -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 24 24">
            <path
                d="M21.96 2.73a1.2 1.2 0 00-1.27-.19L2.76 9.49c-1.04.43-1.04 1.12 0 1.56l5.47 1.68 2.06 6.57c.17.53.43.64.79.39l3.01-2.55 4.15 3.2c.71.56 1.31.27 1.5-.66L22.9 3.85a1.24 1.24 0 00-.94-1.12zM17.4 18.2l-3.86-2.98a.72.72.72 0 00-.93.03l-2.7 2.27-1.64-5.23 9.75-6.15-6.9 6.46a.59.59 0 00.33 1l2.64.48 3.31 5.06z">
            </path>
        </svg>
    </a>
</div>

<script>
    // Sembunyikan teks "Join Us!" setelah 3 detik
    setTimeout(() => {
        document.getElementById("join-text").classList.add("opacity-0");
    }, 3000);
</script>
