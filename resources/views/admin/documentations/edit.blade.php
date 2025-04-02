<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Dokumentasi') }}
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
                
                <form method="POST" action="{{ route('admin.documentations.update', $documentation) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Field: Title -->
                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" 
                        value="{{ $documentation->title }}" required autofocus autocomplete="title" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                    <x-input-label for="category_id" :value="__('Kategori')" />
                    <select name="category_id" id="category_id" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                        <option value="{{$documentation->category_id}}">{{ $documentation->category->name ?? 'Kategori tidak ditemukan' }}</option>
                        @foreach($categories as $category)
                            @if($category->type == 'documentations' && $documentation->id != $documentation->category_id)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    </div>


                    <div class="mt-4">
                        <x-input-label for="youtube" :value="__('Link Youtube')" />
                        <x-text-input id="youtube" class="block mt-1 w-full" type="url" name="youtube" 
                        value="{{ $documentation->youtube }}" autofocus autocomplete="youtube" />
                        <x-input-error :messages="$errors->get('youtube')" class="mt-2" />
                    </div>

                    <!-- Field: Caption -->
                    <div class="mt-4">
                        <x-input-label for="caption" :value="__('Caption')" />
                        <textarea name="caption" id="caption" cols="30" rows="5" class="border border-slate-300 rounded-xl w-full">{{ $documentation->caption }}</textarea>
                        <x-input-error :messages="$errors->get('caption')" class="mt-2" />
                    </div>

                    <!-- Field: Status (Draft/Published) -->
                    <div class="mt-4">
                        <x-input-label for="status" :value="__('Status')" />
                        <select name="status" id="status" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="0" {{ !$documentation->status ? 'selected' : '' }}>Draft</option>
                            <option value="1" {{ $documentation->status ? 'selected' : '' }}>Published</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="slider" :value="__('Tampilkan Pada Slider Website?')" />
                        <select name="slider" id="slider" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="1" {{ !$documentation->slider ? 'selected' : '' }}>Tampilkan</option>
                            <option value="0" {{ $documentation->slider ? 'selected' : '' }}>Jangan Tampilkan</option>
                        </select>
                        <x-input-error :messages="$errors->get('slider')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Update Dokumentasi
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
