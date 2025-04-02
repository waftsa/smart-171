<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dokumentasi Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">

                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="py-3 w-full rounded-3xl bg-red-500 text-white mb-3">
                            {{$error}}
                        </div>
                    @endforeach
                @endif
                
                <form method="POST" action="{{route('admin.documentations.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <x-input-label for="title" :value="__('Judul')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                    <x-input-label for="category_id" :value="__('Kategori')" />
                    <select name="category_id" id="category_id" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            @if($category->type == 'documentations')
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    </div>

                   
                    <div class="mt-4">
                        <x-input-label for="youtube" :value="__('Link YouTube')" />
                        <x-text-input id="youtube" class="block mt-1 w-full" type="url" name="youtube" :value="old('youtube')" required autofocus/>
                        <x-input-error :messages="$errors->get('youtube')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="caption" :value="__('Caption')" />
                        <textarea name="caption" id="caption" cols="30" rows="5" class="border border-slate-300 rounded-xl w-full">{{ old('caption') }}</textarea>
                        <x-input-error :messages="$errors->get('caption')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="slider" :value="__('Tampilkan Pada Slider Website?')" />
                        <select name="slider" id="slider" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="1">Tampilkan</option>
                            <option value="0">Jangan tampilkan</option>
                        </select>
                        <x-input-error :messages="$errors->get('slider')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Tambahkan Dokumentasi
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
