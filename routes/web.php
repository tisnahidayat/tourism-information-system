<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Frontend\HotelController;
use App\Http\Controllers\Fronted\CommentController;
use App\Http\Controllers\Frontend\KontakController;
use App\Http\Controllers\frontend\ReviewController;
use App\Http\Controllers\Frontend\WisataController;
use App\Http\Controllers\Frontend\KulinerController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\Auth\LoginController;
use App\Http\Controllers\Frontend\SeniBudayaController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Admin\Blog\DashboardPostController;
use App\Http\Controllers\Admin\Hotel\DashboardHotelController;
use App\Http\Controllers\Admin\Kontak\DashboardKontakController;
use App\Http\Controllers\Admin\Wisata\DashboardWisataController;
use App\Http\Controllers\Admin\Kuliner\DashboardKulinerController;
use App\Http\Controllers\Admin\Pengguna\DashboardPenggunaControler;
use App\Http\Controllers\Admin\Kategori\DashboardKategoriController;
use App\Http\Controllers\Admin\SeniBudaya\DashboardSeniBudayaController;
use App\Http\Controllers\Frontend\BlogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|   
*/

//Beranda
Route::get('/', [DashboardController::class, 'index'])->name('beranda');

//Profil
Route::get('/profil', [DashboardController::class, 'profil'])->name('profil');

//Wisata
Route::get('/wisata', [WisataController::class, 'wisata'])->name('wisata');
Route::post('/wisata', [WisataController::class, 'wisata'])->name('wisata');
Route::get('/wisata/{wisata:slug}', [WisataController::class, 'detail'])->name('wisata');
Route::get('/pilih-destinasi/{id}', [WisataController::class, 'pilihDestinasi']);

//Autentikasi
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

//Hotel
Route::get('/hotel', [HotelController::class, 'index'])->name('hotel');
Route::get('/hotel/{hotel:slug}', [HotelController::class, 'detail'])->name('hotel');
Route::post('/hotel', [HotelController::class, 'index']);
Route::get('/topkomentar', [HotelController::class, 'topkomentar'])->name('hotel');

//Kontak
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'store']);

// Seni dan Budaya
Route::get('/senibudaya', [SeniBudayaController::class, 'index'])->name('wisata');
Route::get('/senibudaya/{senibudaya:slug}', [SeniBudayaController::class, 'detail'])->name('wisata');

//Kuliner
Route::get('/kuliner', [KulinerController::class, 'index'])->name('wisata');
Route::get('/kuliner/{kuliner:slug}', [KulinerController::class, 'detail'])->name('wisata');

//Blog
Route::get('/blog', [BlogController::class, 'index'])->name('wisata');
Route::get('/blog/{blog:slug}', [BlogController::class, 'detail'])->name('wisata');

//Review Wisata
Route::middleware(['auth'])->group(function () {
    Route::get('/review/{id_wisata}', [ReviewController::class, 'create']);
    Route::post('/review', [ReviewController::class, 'store']);
    Route::delete('/review/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');
});

//Komentar Hotel
Route::middleware(['auth'])->group(function () {
    Route::get('/komentar/{id_hotel}', [CommentController::class, 'create']);
    Route::post('/komentar', [CommentController::class, 'store']);
    Route::delete('/komentar/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');
});


Route::middleware(['auth', 'user_access:admin', 'record.visit'])->group(function () {
    //Beranda
    Route::get('/dashboard', [DashboardAdminController::class, 'index']);

    //Wisata
    Route::get('/dashboard/wisata/checkSlug', [DashboardWisataController::class, 'checkSlug']);
    Route::resource('/dashboard/wisata', DashboardWisataController::class);

    //Kategori
    Route::get('/dashboard/kategori/checkSlug', [DashboardKategoriController::class, 'checkSlug']);
    Route::resource('/dashboard/kategori', DashboardKategoriController::class);

    //Hotel
    Route::get('/dashboard/hotel/checkSlug', [DashboardHotelController::class, 'checkSlug']);
    Route::resource('/dashboard/hotel', DashboardHotelController::class);

    //Pengguna
    Route::resource('/dashboard/pengguna', DashboardPenggunaControler::class);

    //Seni & Budaya
    Route::get('/dashboard/senibudaya/checkSlug', [DashboardHotelController::class, 'checkSlug']);
    Route::resource('/dashboard/senibudaya', DashboardSeniBudayaController::class);

    //Kuliner
    Route::get('/dashboard/kuliner/checkSlug', [DashboardKulinerController::class, 'checkSlug']);
    Route::resource('/dashboard/kuliner', DashboardKulinerController::class);

    //Blog Wisata
    Route::get('/dashboard/posting/checkSlug', [DashboardPostController::class, 'checkSlug']);
    Route::resource('/dashboard/posting', DashboardPostController::class);

    //Kritik dan Saran
    Route::resource('/dashboard/kontak', DashboardKontakController::class)->except(['show', 'create', 'update', 'edit', 'store']);
});
