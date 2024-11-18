<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SewarumahkacaController;
use App\Http\Controllers\MasterrumahkacaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {


    return view('dashboard');
})->middleware('auth');


Route::prefix('dashboard')->middleware(['auth:sanctum'])->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Master Data
    Route::resource('masterrumahkaca', MasterrumahkacaController::class);

    // Data Tables Surat
    Route::resource('sewarumahkaca', SewarumahkacaController::class);

    // Report
    Route::get('laporannya/laporansewarumahkaca', [SewarumahkacaController::class, 'cetakbarangpertanggal'])->name('laporansewarumahkaca');
    Route::get('laporansewarumahkaca', [SewarumahkacaController::class, 'filterdatebarang'])->name('laporansewarumahkaca');
    Route::get('laporansewarumahkacapdf/filter={filter}', [SewarumahkacaController::class, 'laporansewarumahkacapdf'])->name('laporansewarumahkacapdf');




    // Verifikasi Di Master Data surat
    // Route::put('/items/{id}/verify', [MasteranggotaController::class, 'verify'])->name('items.verify');






// Data Tables Report Report
// Route::get('suratdisposisipdf', [SuratdisposisiController::class, 'suratdisposisipdf'])->name('suratdisposisipdf');

// Rute untuk menampilkan laporan anggota
// Route::get('laporannya/laporananggota', [MasteranggotaController::class, 'perkelas'])->name('laporananggota');

// Rute untuk mengekspor PDF
// Route::get('/perkelaspdf', [MasteranggotaController::class, 'cetakPerkelasPdf'])->name('laporananggotapdf');

// Recap Laporan Tampilan
// Route::get('laporannya/laporanpeminjaman', [SuratdisposisiController::class, 'cetakpertanggalpengembalian'])->name('laporanpeminjaman');

// Filtering
// Route::get('laporanpeminjaman', [SuratdisposisiController::class, 'filterdatebarang'])->name('laporanpeminjaman');


// Filter Laporan
// Route::get('laporandendapdf/filter={filter}', [SuratdisposisiController::class, 'laporandendapdf'])->name('laporandendapdf');


});



// Login Register
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/loginuser', [LoginController::class, 'loginuser'])->name('loginuser');








