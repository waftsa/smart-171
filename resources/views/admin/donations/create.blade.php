<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
</head>
<body>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Donation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">

                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="py-3 w-full rounded-3xl bg-red-500 text-white">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
                
                <form method="POST" action="{{route('admin.donations.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Nama Program')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="thumbnail_text" :value="__('Sub Nama Program')" />
                        <x-text-input id="thumbnail_text" class="block mt-1 w-full" type="text" name="thumbnail_text" :value="old('thumbnail_text')" required autofocus autocomplete="thumbnail_text" />
                        <p class="text-gray-600">Text ini ditampilkan pada slider</p>
                        <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                        <x-text-input id="thumbnail" class="block mt-1 w-full" type="file" name="thumbnail" required autofocus autocomplete="thumbnail" />
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                    </div>

                    <input type="hidden" name="thumbnail_url" id="thumbnail_url">
                    <input type="hidden" name="thumbnail_public_id" id="thumbnail_public_id">

                    <div class="mt-4">
                        <x-input-label for="target_amount" :value="__('Target Amount')" />
                        <x-text-input id="target_amount" class="block mt-1 w-full" type="number" name="target_amount" :value="old('target_amount')" required autofocus autocomplete="target_amount" />
                        <x-input-error :messages="$errors->get('target_amount')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="code" :value="__('Kode Unik')" />
                        <x-text-input id="code" class="block mt-1 w-full" type="number" name="code" :value="old('code')" required autofocus autocomplete="code" />
                        <p class="text-gray-600">Masukkan kode unik saja tanpa menyertakan 0 dibelakangnya (contoh : 9 bukan 09)</p>
                        <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="rekening" :value="__('Nomor Rekening')" />
                        <select name="rekening" id="rekening" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="campaign" selected>Campaign (7-666-171-661)</option>
                            <option value="kurban">Kurban (7-333-171-338)</option>
                        </select>
                    </div>


                    <div class="mt-4">
                        <x-input-label for="about" :value="__('Deskripsi Program')" />
                        <div id="quill-editor" class="block mt-1 w-full rounded-b-lg"></div>
                        <input hidden name="about" id="about" cols="30" rows="5" class="border border-slate-300 rounded-xl w-full">{{ old('about') }}</input>
                        <x-input-error :messages="$errors->get('about')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                    <x-input-label for="category_id" :value="__('Kategori')" />
                    <select name="category_id" id="category_id" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            @if($category->type == 'donations')
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
                            Add New Donation
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
        var editor = new Quill('#quill-editor', {
            theme: 'snow',
            modules: {
                toolbar: [['bold', 'italic', 'underline'], ['link'], [{ list: 'ordered'}, { list: 'bullet' }], ['blockquote']]
            }
        });

        var quillEditor = document.getElementById('about');

        // Sync content from editor to hidden input
        editor.on('text-change', function(){
            quillEditor.value = editor.root.innerHTML;
        });

        // Sync hidden input back to editor (if necessary)
        quillEditor.addEventListener('input', function(){
            editor.root.innerHTML = quillEditor.value;
        });

        // Populate editor with old value if present
        if (quillEditor.value) {
            editor.root.innerHTML = quillEditor.value;
        }
    });

    document.querySelector('#thumbnail').addEventListener('change', async (e) => {
        const file = e.target.files[0];
        if (!file) return;

        const sig = await fetch('/cloudinary-signature').then(r => r.json());

        const formData = new FormData();
        formData.append('file', file);
        formData.append('timestamp', sig.timestamp);
        formData.append('api_key', sig.api_key);
        formData.append('signature', sig.signature);
        formData.append('folder', 'donations/thumbnails');

        const result = await fetch(
            `https://api.cloudinary.com/v1_1/${sig.cloud_name}/image/upload`,
            {
                method: 'POST',
                body: formData
            }
        );

        const data = await result.json();

        document.getElementById('thumbnail_url').value = data.secure_url;
        document.getElementById('thumbnail_public_id').value = data.public_id;

        console.log("Uploaded:", data.secure_url);

        alert('Thumbnail berhasil diupload!');
    });

    document.querySelector('form').addEventListener('submit', function(e){
        if (!document.getElementById('thumbnail_url').value) {
            e.preventDefault();
            alert("Upload thumbnail dulu sebelum submit!");
        }
    });

    cloudinary.uploader.upload(file, function(res) {
        document.getElementById('thumbnail_url').value = res.secure_url;
        document.getElementById('thumbnail_public_id').value = res.public_id;
    });


    document.querySelector('#thumbnail').addEventListener('change', () => {
        console.log("File selected!");
    });



</script>
</html>
