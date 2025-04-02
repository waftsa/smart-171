<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Category') }}
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
                
                <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mt-4">
                        <x-input-label for="name" :value="__('Nama Kategori')" />
                        <x-text-input 
                            id="name" 
                            class="block mt-1 w-full" 
                            type="text" 
                            name="name" 
                            value="{{ old('name', $category->name) }}" 
                            required 
                            autofocus 
                        />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="icon" :value="__('Icon')" />
                        @if($category->icon)
                            <img src="{{ $category->icon }}" 
                                alt="Category Icon" 
                                class="rounded-2xl object-cover w-[120px] h-[90px]">
                        @endif
                        <x-text-input 
                            id="icon" 
                            class="block mt-1 w-full" 
                            type="file" 
                            name="icon" 
                        />
                        <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="type" :value="__('Tipe Kategori')" />
                        <select 
                            name="type" 
                            id="type" 
                            class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="donations" {{ $category->type == 'donations' ? 'selected' : '' }}>
                                Donasi / Campaign
                            </option>
                            <option value="articles" {{ $category->type == 'articles' ? 'selected' : '' }}>
                                Smart News
                            </option>
                            <option value="releases" {{ $category->type == 'releases' ? 'selected' : '' }}>
                                Smart Release
                            </option>
                            <option value="documentations" {{ $category->type == 'documentations' ? 'selected' : '' }}>
                                Dokumentasi
                            </option>
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Update Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
