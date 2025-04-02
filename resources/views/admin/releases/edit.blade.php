<!DOCTYPE html>
<html>
<head>

</head>

<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Smart Release') }}
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
                
                <form method="POST" action="{{ route('admin.releases.update', $release) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Field: Title -->
                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" 
                        value="{{ $release->title }}" required autofocus autocomplete="title" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="summary" :value="__('Summary')" />
                        <x-text-input id="summary" class="block mt-1 w-full" type="text" name="summary" 
                        value="{{ $release->summary }}" required autofocus autocomplete="summary" />
                        <x-input-error :messages="$errors->get('summary')" class="mt-2" />
                    </div>

                    <!-- Field: content -->
                    <div class="mt-4">
                        <x-input-label for="cover" :value="__('Cover')" />
                        <img src="{{ $release->cover }}" alt="cover" class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <x-text-input id="cover" class="block mt-1 w-full" type="file" name="cover" autofocus autocomplete="cover" />
                        <x-input-error :messages="$errors->get('cover')" class="mt-2" />
                    </div>

                    <!-- Field: Caption -->
                    <div class="mt-4">
                        <x-input-label for="content" :value="__('Content')" />
                        <div id="quill-editor" class="block mt-1 w-full rounded-b-lg">{!! $release->content !!}</div>
                        <input hidden name="content" id="content" cols="30" rows="5" class="border border-slate-300 rounded-xl w-full" value="{{ $release->content }}"></input>
                    </div>

                    <div class="mt-4">
                    <x-input-label for="category_id" :value="__('Kategori')" />
                    <select name="category_id" id="category_id" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                        <option value="{{$release->category_id}}">{{ $release->category->name ?? 'Kategori tidak ditemukan' }}</option>
                        @foreach($categories as $category)
                            @if($category->type == 'releases' && $category->id != $release->category_id)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="status" :value="__('Status')" />
                        <select name="status" id="status" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="0" {{ !$release->status ? 'selected' : '' }}>Draft</option>
                            <option value="1" {{ $release->status ? 'selected' : '' }}>Published</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="slider" :value="__('Tampilkan Pada Slider Website?')" />
                        <select name="slider" id="slider" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="1" {{ !$release->slider ? 'selected' : '' }}>Tampilkan</option>
                            <option value="0" {{ $release->slider ? 'selected' : '' }}>Jangan Tampilkan</option>
                        </select>
                        <x-input-error :messages="$errors->get('slider')" class="mt-2" />
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

<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function(){
        if(document.getElementById('content')){
            var editor = new Quill('#quill-editor', {
                theme: 'snow'
            });

            var quillEditor = document.getElementById(
                'content'
            );

            editor.on('text-change', function(){
                quillEditor.value = editor.root.innerHTML;
            });
            quillEditor.addEventListener('input', function(){
                editor.root.innerHTML = quillEditor.value;
            });

        }
    });
</script>

</html>