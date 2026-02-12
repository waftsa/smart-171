<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        

        @hasSection('meta')
            @yield('meta')
        @endif



        <title>{{ config('app.name', 'SMART171') }}</title>

        <!-- Fonts -->
         <!-- Preconnect ke Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <!-- Menggunakan font  -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

        <!-- Link CSS Select2 -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <!-- Script Select2 -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="//unpkg.com/alpinejs" defer></script>

        <!-- quilleditor -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
        
        <!-- pdf  -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
        <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc =
        "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js";

        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll("canvas[data-pdf]").forEach(canvas => {
                const pdfUrl = canvas.dataset.pdf;

                pdfjsLib.getDocument(pdfUrl).promise
                    .then(pdf => pdf.getPage(1))
                    .then(page => {
                        const ctx = canvas.getContext("2d");
                        const viewport = page.getViewport({ scale: 0.3 });
                        canvas.width = viewport.width;
                        canvas.height = viewport.height;

                        page.render({ canvasContext: ctx, viewport });
                    })
                    .catch(() => {
                        canvas.outerHTML = `
                            <div class="w-[120px] h-[90px] flex items-center justify-center border rounded text-xs text-gray-500">
                                PDF
                            </div>
                        `;
                    });
            });
        });
        </script>

    
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        
        @auth
        <div class="flex bg-[#ccddee]">
            <aside class="w-56 bg-white h-screen z-10">
            @include('layouts.sidebar')
            </aside>

            <main class="flex-1 z-0">
                @include('layouts.breadcrumb')
                <div class="mt-16">
                {{ $slot }}
                </div>
            </main>
        </div>
        @endauth

        @guest
        @if(!Route::is('donations.confirmation') && !Route::is('donations.success'))
            <nav id="navbar" class="w-full z-50">
                @if(Route::is('donations.*'))
                    @include('layouts.nav-donation')
                @else
                    @include('layouts.navigation')
                @endif
            </nav>
        @endif

        <div class="min-h-screen bg-[#ccddee] @if(Route::is('donations.*')) donation-page @endif">
            <main>
                {{ $slot }} 
                @include('layouts.join-us')
                @include('layouts.suggestion-box')
            </main>

            @if(!Route::is('donations.*')) {{-- Footer hanya muncul di halaman non-donations --}}
                @include('layouts.footer')
            @endif
        </div>
    @endguest

    </body>
</html>
