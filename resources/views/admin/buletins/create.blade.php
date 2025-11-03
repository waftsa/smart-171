<!DOCTYPE html>
<html>

<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Buletin Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">

                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="py-3 w-full rounded-3xl bg-red-500 text-white">
                            {{$error}}
                        </div>
                    @endforeach
                @endif
                
                <form method="POST" action="{{route('admin.buletins.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <x-input-label for="title" :value="__('Judul')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="publisher" :value="__('Publisher')" />
                        <x-text-input id="publisher" class="block mt-1 w-full h-auto" type="text" name="publisher" :value="old('publisher')" required autofocus />
                        <x-input-error :messages="$errors->get('publisher')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="file" :value="__('Upload File Buletin')" />
                        <x-text-input id="file" class="block mt-1 w-full" type="file" name="file" required />
                        <x-input-error :messages="$errors->get('file')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Tambahkan Artikel
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</x-app-layout>

</body>
</html>
