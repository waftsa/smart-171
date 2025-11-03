<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
</head>
<body>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Artikel') }}
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
                
                <form method="POST" action="{{ route('admin.articles.update', $buletin) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Field: Title -->
                    <div>
                        <x-input-label for="title" :value="__('Judul')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" 
                        value="{{ $buletin->title }}" required autofocus autocomplete="title" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="publisher" :value="__('Penerbit')" />
                        <x-text-input id="publisher" class="block mt-1 w-full" type="text" name="publisher" 
                        value="{{ $buletin->publisher }}" required autofocus autocomplete="publisher" />
                        <x-input-error :messages="$errors->get('publisher')" class="mt-2" />
                    </div>

                    <!-- Field: content -->
                    <div class="mt-4">
                        <x-input-label for="file" :value="__('File Buletin')" />
                        <img src="{{ $buletin->file }}" alt="file" class="rounded-2xl object-file w-[120px] h-[90px]">
                        <x-text-input id="file" class="block mt-1 w-full" type="file" name="file" autofocus autocomplete="file" />
                        <x-input-error :messages="$errors->get('file')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="status" :value="__('Status')" />
                        <select name="status" id="status" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="0" {{ !$buletin->status ? 'selected' : '' }}>Draft</option>
                            <option value="1" {{ $buletin->status ? 'selected' : '' }}>Published</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    <!-- Field: Status (Draft/Published) -->

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Update Artikel
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</x-app-layout>

</body>


</html>