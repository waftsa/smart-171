<x-app-layout>
    <div class="py-10">
    <div class="max-w-3xl mx-auto text-center px-4">
        <h2 class="text-4xl font-semibold mb-4">Pesan dan Saran untuk SMART171</h2>
        <form action="{{ route('contact-us.send')}}" method="POST" class="space-y-4">
            @csrf
            <input type="text" name="name" placeholder="Nama Anda" required class="w-full p-3 border border-gray-300 rounded-md">
            <input type="text" name="contact" placeholder="Email atau No Telp" required class="w-full p-3 border border-gray-300 rounded-md">
            <textarea name="message" placeholder="Pesan Anda" required class="w-full p-3 border border-gray-300 rounded-md"></textarea>
            <button type="submit" class="bg-[#1D4161] text-white py-2 px-4 rounded-md hover:bg-opacity-80">Kirim Pesan</button>
        </form>
    </div>
    </div>
</x-app-layout>