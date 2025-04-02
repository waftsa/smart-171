@php
    // Konfigurasi nama halaman sesuai route
    $breadcrumbs = [
        'dashboard' => 'Dashboard',
        'admin.articles.index' => 'Smart News',
        'admin.donations.index' => 'Kelola Donasi',
        'admin.documentations.index' => 'Dokumentasi',
        'admin.donaturs.index' => 'List Donatur',
        'admin.sliders.index' => 'Slider',
        'admin.services.index' => 'Customer Service',
        // Tambahkan sesuai kebutuhan
    ];

    // Ambil route saat ini
    $currentRoute = Route::currentRouteName();
    $currentPage = $breadcrumbs[$currentRoute] ?? 'Page';
@endphp

<!-- Breadcrumb -->
<div class="fixed w-full h-16 flex items-center px-4 border-b bg-white"> 
<ol class="flex space-x-2 text-sm text-gray-600">
    <li>
        <a href="{{ route('dashboard')}}" class="hover:strong">Dashboard</a>
    </li>
    @if ($currentPage !== 'Dashboard')
        <li> / </li>
        <li class="font-semibold">{{ $currentPage }}</li>
    @endif
</ol>
</div>
