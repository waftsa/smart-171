<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BuletinController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReleaseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserArticleController;
use App\Http\Controllers\UserDocumentationController;
use App\Http\Controllers\UserDonationController;
use App\Http\Controllers\UserReleaseController;
use App\Http\Controllers\UserBuletinController;
use App\Http\Controllers\UserReportController;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Route;

// Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/privacy-policy', 'terms.privacy')->name('privacy');
Route::view('/refund-policy', 'terms.refund')->name('refund');
Route::view('/terms-conditions', 'terms.terms')->name('terms');


// Route untuk Pengguna (Tanpa Autentikasi)
Route::prefix('/')->group(function () {
    // route tentang kami 
    Route::get('about', [HomeController::class, 'about'])->name('about'); 

    //route pesan dan saran 
    Route::get('services', [ServiceController::class, 'index'])->name('contact-us');
    Route::post('services', [ServiceController::class, 'store'])->name('contact-us.send');

    // Route ke OTA 
    Route::get('orang-tua-asuh', [HomeController::class, 'ota'])->name('ota.list');
    Route::get('orang-tua-asuh/daftar-paket-umum-orang-tua-asuh', [HomeController::class, 'paketUmum'])->name('ota.form.umum');
    Route::get('orang-tua-asuh/daftar-paket-patungan-orang-tua-asuh', [HomeController::class, 'paketPatungan'])->name('ota.form.patungan');
    Route::get('orang-tua-asuh/daftar-paket-patungan-sebatang-kara-orang-tua-asuh', [HomeController::class, 'paketPatungan2'])->name('ota.form.patungan2');

    // Route Donasi
    Route::get('smartcampaign', [UserDonationController::class, 'index'])->name('donations.list');
    Route::get('smartcampaign/{donation:slug}', [UserDonationController::class, 'show'])->name('donations.show');
    Route::get('smartcampaign/category/{category:slug}', [UserDonationController::class, 'category'])->name('donations.category');
    Route::get('smartcampaign/{donation:slug}/donate', [UserDonationController::class, 'showDonate'])->name('donations.donate');
    Route::post('smartcampaign/{donation:slug}/donate', [UserDonationController::class, 'store'])->name('donations.store');
    Route::get('smartcampaign/{donation}/donate/confirmation/{donatur}', [UserDonationController::class, 'showConfirmation'])->name('donations.confirmation');
    Route::post('smartcampaign/{donation}/donate/confirmation/{donatur}', [UserDonationController::class, 'submitConfirmation'])->name('donations.confirmation');
    Route::get('smartcampaign/{donation}/success/{donatur}', [UserDonationController::class, 'success'])->name('donations.success');


    // Route Dokumentasi
    Route::get('documentations', [UserDocumentationController::class, 'index'])->name('documentations.list');
    Route::get('documentations/{documentation:slug}', [UserDocumentationController::class, 'show'])->name('documentations.show');

    // Route Artikel
    Route::get('smartnews', [UserArticleController::class, 'index'])->name('articles.list');
    Route::get('smartnews/filter', [UserArticleController::class, 'filter'])->name('articles.filter');
    Route::get('smartnews/{article:slug}', [UserArticleController::class, 'show'])->name('articles.show');

    Route::get('smartreleases', [UserReleaseController::class, 'index'])->name('releases.list');
    Route::get('smartreleases/filter', [UserReleaseController::class, 'filter'])->name('releases.filter');
    Route::get('smartreleases/{release:slug}', [UserReleaseController::class, 'show'])->name('releases.show');

    Route::get('smart-bulletins', [UserBuletinController::class, 'index'])->name('buletins.list');
    Route::get('smart-bulletins/filter', [UserBuletinController::class, 'filter'])->name('buletins.filter');
    Route::get('smart-bulletins/{buletin:slug}', [UserBuletinController::class, 'show'])->name('buletins.show');

    Route::get('report/flipbook/{slug}/{token}', [UserReportController::class, 'showFlipbook'])->name('reports.show');
    Route::get('reports/pdf/{slug}/{token}', [UserReportController::class, 'showPdf'])->name('reports.pdf');
});

// Route Dashboard dan Profil untuk Pengguna dengan Autentikasi
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route Admin untuk CRUD Donatur, Donasi, Artikel, Dokumentasi
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Route Donatur
    Route::resource('donaturs', DonaturController::class);
    Route::get('donaturs', [DonaturController::class, 'index'])->name('donaturs.index');
    Route::get('donaturs/filter', [DonaturController::class, 'filter'])->name('donaturs.filter');
    Route::get('donaturs/{donatur}', [DonaturController::class, 'show'])->name('donaturs.show');
    Route::post('donaturs/{donatur}', [DonaturController::class, 'show'])->name('donaturs.show');

    // Route Donasi
    Route::resource('donations', DonationController::class)->except(['index']);
    Route::get('donations', [DonationController::class, 'index'])->name('donations.index');
    Route::post('donations/{donation}/publish', [DonationController::class, 'publish'])->name('donations.publish');

    // Route Artikel
    Route::resource('articles', ArticleController::class)->except(['index']);
    Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::post('articles/{article}/publish', [ArticleController::class, 'publish'])->name('articles.publish');

    // Route Smart Release
    Route::resource('releases', ReleaseController::class)->except(['index']);
    Route::get('releases', [ReleaseController::class, 'index'])->name('releases.index');
    Route::post('releases/{release}/publish', [ReleaseController::class, 'publish'])->name('releases.publish');

    // Route Dokumentasi
    Route::resource('documentations', DocumentationController::class)->except(['index']);
    Route::get('documentations', [DocumentationController::class, 'index'])->name('documentations.index');
    Route::post('documentations/{documentation}/publish', [DocumentationController::class, 'publish'])->name('documentations.publish');

    // Route Category
    Route::resource('categories', CategoryController::class)->except(['index']);
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');

    // Route Customer Service 
    Route::get('services', [ServiceController::class, 'view'])->name('services.index');
    Route::get('services/{service}', [ServiceController::class, 'show'])->name('services.show');
    Route::delete('services/{service}', [ServiceController::class, 'destroy'])->name('services.delete');
    
    // Route Slider
    Route::get('sliders', [SliderController::class, 'index'])->name('sliders.index');
    Route::delete('sliders/{type}/{id}', [SliderController::class, 'destroy'])->name('sliders.destroy');
    Route::delete('sliders/bulk-delete', [SliderController::class, 'bulkDelete'])->name('sliders.bulkDelete');

    // Route Buletins
    Route::resource('bulletins', BuletinController::class)->except(['index']);
    Route::get('bulletins', [BuletinController::class, 'index'])->name('bulletins.index');
    Route::post('bulletins/{bulletin}/publish', [BuletinController::class, 'publish'])->name('bulletins.publish');

    // Route report
    Route::resource('reports', ReportController::class)->except(['index']);
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');

    // Route::get('/cloudinary-signature', function () {
    //     $timestamp = time();
    //     $signature = Cloudinary::signParameters(
    //         ['timestamp' => $timestamp]
    //     );

    //     return [
    //         'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
    //         'api_key' => env('CLOUDINARY_API_KEY'),
    //         'timestamp' => $timestamp,
    //         'signature' => $signature
    //     ];
    // });

});

require __DIR__.'/auth.php';
