<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kategori Baru') }}
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
                
                <form method="POST" action="{{route('admin.categories.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="mt-4">
                        <x-input-label for="name" :value="__('Nama Kategori')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="icon" :value="__('Icon')" />
                        <x-text-input id="icon" class="block mt-1 w-full" type="file" name="icon" required autofocus autocomplete="icon" />
                        <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="type" :value="__('Tipe Kategori')" />
                        <select name="type" id="type" class="py-3 rounded-lg pl-3 w-full border border-slate-300 focus:outline-indigo-500 focus:ring-2 focus:ring-indigo-200">
                            <option value="" disabled {{ old('type') ? '' : 'selected' }}>Pilih Tipe...</option>
                            <option value="donations" {{ old('type') == 'donations' ? 'selected' : '' }}>Donasi</option>
                            <option value="articles" {{ old('type') == 'articles' ? 'selected' : '' }}>Smart News</option>
                            <option value="releases" {{ old('type') == 'releases' ? 'selected' : '' }}>Smart Release</option>
                            <option value="documentations" {{ old('type') == 'documentations' ? 'selected' : '' }}>Dokumentasi</option>
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Add New Category
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
