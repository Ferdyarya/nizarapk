<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterderetController;
use App\Http\Controllers\MasternokursiController;
use App\Http\Controllers\MasterpegawaiController;
use App\Http\Controllers\SewarumahkacaController;
use App\Http\Controllers\RawatrumahkacaController;
use App\Http\Controllers\MasterrumahkacaController;
use App\Http\Controllers\PembangunanrumahkacaController;
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
    Route::resource('masterpegawai', MasterpegawaiController::class);
    Route::resource('masterderetkursi', MasterderetController::class);
    Route::resource('masternokursi', MasternokursiController::class);

    // Data Tables Surat
    Route::resource('sewarumahkaca', SewarumahkacaController::class);
    Route::resource('rawatrumahkaca', RawatrumahkacaController::class);
    Route::resource('pembangunanrumahkaca', PembangunanrumahkacaController::class);

    // Report
    // Sewa Rumah Kaca
    Route::get('laporannya/laporansewarumahkaca', [SewarumahkacaController::class, 'cetakbarangpertanggal'])->name('laporansewarumahkaca');
    Route::get('laporansewarumahkaca', [SewarumahkacaController::class, 'filterdatebarang'])->name('laporansewarumahkaca');
    Route::get('laporansewarumahkacapdf/filter={filter}', [SewarumahkacaController::class, 'laporansewarumahkacapdf'])->name('laporansewarumahkacapdf');

    Route::get('laporannya/pernama', [SewarumahkacaController::class, 'pernama'])->name('pernama');
    Route::get('/pernamapdf', [SewarumahkacaController::class, 'cetakPernamaPdf'])->name('pernamapdf');

    // Rawat Rumah Kaca
    Route::get('laporannya/laporanrawatrumahkaca', [RawatrumahkacaController::class, 'cetakbarangpertanggal'])->name('laporanrawatrumahkaca');
    Route::get('laporanrawatrumahkaca', [RawatrumahkacaController::class, 'filterdatebarang'])->name('laporanrawatrumahkaca');
    Route::get('laporanrawatrumahkacapdf/filter={filter}', [RawatrumahkacaController::class, 'laporanrawatrumahkacapdf'])->name('laporanrawatrumahkacapdf');

    // Pembangunan Rumah Kaca
    Route::get('laporannya/laporanpembangunanrumahkaca', [PembangunanrumahkacaController::class, 'cetakbarangpertanggal'])->name('laporanpembangunanrumahkaca');
    Route::get('laporanpembangunanrumahkaca', [PembangunanrumahkacaController::class, 'filterdatebarang'])->name('laporanpembangunanrumahkaca');
    Route::get('laporanpembangunanrumahkacapdf/filter={filter}', [PembangunanrumahkacaController::class, 'laporanpembangunanrumahkacapdf'])->name('laporanpembangunanrumahkacapdf');

    Route::put('/rawatrumahkaca/{id}/status', [RawatrumahkacaController::class, 'updateStatus'])->name('updateStatus');
    Route::put('/pembangunanrumahkaca/{id}/status', [PembangunanrumahkacaController::class, 'updateStatus'])->name('updateStatus');
    // Pembangunan Rumah Kaca



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








