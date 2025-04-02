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
            {{ __('Edit Donation') }}
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
                
                <form method="POST" action="{{ route('admin.donations.update', $donation) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" 
                        value="{{ $donation->name }}" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                        <img src="{{ Storage::url($donation->thumbnail) }}" alt="" class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <x-text-input id="thumbnail" class="block mt-1 w-full" type="file" name="thumbnail" autofocus autocomplete="thumbnail" />
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="target_amount" :value="__('Target Amount')" />
                        <x-text-input id="target_amount" class="block mt-1 w-full" type="number" name="target_amount" 
                        value="{{ $donation->target_amount }}" required autofocus autocomplete="target_amount" />
                        <x-input-error :messages="$errors->get('target_amount')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="code" :value="__('Kode Unik')" />
                        <x-text-input id="code" class="block mt-1 w-full" type="number" name="code" 
                        value="{{ $donation->code }}" required autofocus autocomplete="code" />
                        <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="about" :value="__('Deksripsi Program')" />
                        <div id="quill-editor" class="block mt-1 w-full rounded-b-lg">{!! $donation->about !!}</div>
                        <input hidden name="about" id="about" cols="30" rows="5" class="border border-slate-300 rounded-xl w-full" value="{{ $article->about }}"></input>
                    </div>

                    <div class="mt-4">
                    <x-input-label for="category_id" :value="__('Kategori')" />
                    <select name="category_id" id="category_id" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                        <option value="{{$donation->category_id}}">{{ $donation->category->name ?? 'Kategori tidak ditemukan' }}</option>
                        @foreach($categories as $category)
                            @if($category->type == 'donations' && $donation->id != $donation->category_id)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="status" :value="__('Status')" />
                        <select name="status" id="status" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="0" {{ !$donation->status ? 'selected' : '' }}>Draft</option>
                            <option value="1" {{ $donation->status ? 'selected' : '' }}>Published</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="slider" :value="__('Tampilkan Pada Slider Website?')" />
                        <select name="slider" id="slider" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="1" {{ !$donation->slider ? 'selected' : '' }}>Tampilkan</option>
                            <option value="0" {{ $donation->slider ? 'selected' : '' }}>Jangan Tampilkan</option>
                        </select>
                        <x-input-error :messages="$errors->get('slider')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Update Donation
                        </button>
                    </div>
                </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

</body>

<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function(){
        if(document.getElementById('about')){
            var editor = new Quill('#quill-editor', {
                theme: 'snow'
            });

            var quillEditor = document.getElementById(
                'about'
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
