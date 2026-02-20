<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Report') }}
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
                
                <form method="POST" action="{{ route('admin.reports.update', $buletin) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Field: Title -->
                    <div>
                        <x-input-label for="name" :value="__('Nama Orang Tua Asuh')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" 
                        value="{{ $report->name }}" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="code" :value="__('Kode Unik OTA')" />
                        <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" 
                        value="{{ $report->code }}" required autofocus autocomplete="code" />
                        <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    </div>

                    <!-- Field: content -->
                    <div class="mt-4">
                        <x-input-label for="path_file" :value="__('File Report')" />
                        <img src="{{ $buletin->path_file }}" alt="path_file" class="rounded-2xl object-path_file w-[120px] h-[90px]">
                        <x-text-input id="path_file" class="block mt-1 w-full" type="path_file" name="path_file" autofocus autocomplete="path_file" />
                        <x-input-error :messages="$errors->get('path_file')" class="mt-2" />
                    </div>


                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Update Report
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</x-app-layout>
