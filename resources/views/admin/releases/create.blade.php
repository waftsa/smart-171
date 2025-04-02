<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">

</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Smart Release Baru') }}
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
                
                <form method="POST" action="{{route('admin.releases.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <x-input-label for="title" :value="__('Judul')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="summary" :value="__('Summary')" />
                        <x-text-input id="summary" class="block mt-1 w-full h-auto" type="text" name="summary" :value="old('summary')" required autofocus />
                        <x-input-error :messages="$errors->get('summary')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="cover" :value="__('Cover')" />
                        <x-text-input id="cover" class="block mt-1 w-full" type="file" name="cover" required />
                        <x-input-error :messages="$errors->get('cover')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="content" :value="__('Content')" />
                        <div id="quill-editor" class="block mt-1 w-full rounded-b-lg"></div>
                        <input hidden name="content" id="content" cols="30" rows="5" class="border border-slate-300 rounded-xl w-full">{{ old('content') }}</input>
                        <!-- <input type="hidden" name="content" id="content"> -->
                        <x-input-error :messages="$errors->get('cover')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                    <x-input-label for="category_id" :value="__('Kategori')" />
                    <select name="category_id" id="category_id" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            @if($category->type == 'releases')
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    </div>

                    <div class="mt-4">
                        <input type="checkbox" id="slider" name="slider" class="mr-2" value="1">
                        <label for="slider" class="text-indigo-950 text-m">Tampilkan pada slider homapage</label>
                        <x-input-error :messages="$errors->get('slider')" class="mt-2" />
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
<script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function(){
        if(document.getElementById('content')){
            var editor = new Quill('#quill-editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ header: [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline'],
                        ['link', 'blockquote', 'code-block'],
                        [{ list: 'ordered' }, { list: 'bullet' }],
                        [{ color: [] }, { background: [] }],
                        ['clean']
                    ]
                }
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