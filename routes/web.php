<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PenyakitController;
use App\Http\Controllers\Admin\GejalaController;
use App\Http\Controllers\Admin\PengetahuanController;
use App\Http\Controllers\Admin\RiwayatController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Pakar\DashboardController as PakarDashboardController;
use App\Http\Controllers\Pakar\PenyakitController as PakarPenyakitController;
use App\Http\Controllers\Pakar\GejalaController as PakarGejalaController;
use App\Http\Controllers\Pakar\PengetahuanController as PakarPengetahuanController;
use App\Http\Controllers\Pakar\RiwayatController as PakarRiwayatController;
use App\Http\Controllers\Pakar\BobotController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Petugas\RiwayatController as PetugasRiwayatController;
use App\Http\Controllers\User\RiwayatController as UserRiwayatController;
use App\Http\Controllers\Petugas\DataController;

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
    return view('welcome');
});

// Rute untuk halaman Form Konsultasi
Route::get('/konsultasi', [ConsultationController::class, 'index'])->name('konsultasi.form');

// Rute untuk memproses data dari Form ke Hasil Diagnosa
Route::post('/konsultasi', [ConsultationController::class, 'process'])->name('konsultasi.process');

Route::get('/informasi/penyakit', [ConsultationController::class, 'penyakit'])->name('informasi.penyakit');
Route::get('/informasi/panduan', [ConsultationController::class, 'panduan'])->name('informasi.panduan');
Route::get('/informasi/penyakit/{id}', [ConsultationController::class, 'detailPenyakit'])->name('informasi.penyakit.detail');

// --- Rute Autentikasi (Login & Logout) ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

// Rute Pendaftaran Peternak
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/konsultasi/detail/{id}', [ConsultationController::class, 'detailPublik'])->name('konsultasi.detail-publik');



// Rute untuk ADMIN
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Dashboard & Riwayat
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('admin.riwayat.index');
    Route::get('/riwayat/{id}', [RiwayatController::class, 'show'])->name('admin.riwayat.detail');
    Route::delete('/riwayat/{id}', [RiwayatController::class, 'destroy'])->name('admin.riwayat.destroy');

    // Rute CRUD Penyakit (Tanpa awalan admin/ di dalam resource)
    Route::resource('penyakit', PenyakitController::class)->names([
        'index'   => 'admin.penyakit.index',
        'create'  => 'admin.penyakit.create',
        'store'   => 'admin.penyakit.store',
        'edit'    => 'admin.penyakit.edit',
        'update'  => 'admin.penyakit.update',
        'destroy' => 'admin.penyakit.destroy',
    ]);

    // Rute CRUD Gejala
    Route::resource('gejala', GejalaController::class)->names([
        'index'   => 'admin.gejala.index',
        'create'  => 'admin.gejala.create',
        'store'   => 'admin.gejala.store',
        'edit'    => 'admin.gejala.edit',
        'update'  => 'admin.gejala.update',
        'destroy' => 'admin.gejala.destroy',
    ]);

    // Rute CRUD Pengetahuan
    Route::resource('pengetahuan', PengetahuanController::class)->names([
        'index'   => 'admin.pengetahuan.index',
        'create'  => 'admin.pengetahuan.create',
        'store'   => 'admin.pengetahuan.store',
        'edit'    => 'admin.pengetahuan.edit',
        'update'  => 'admin.pengetahuan.update',
        'destroy' => 'admin.pengetahuan.destroy',
    ]);

        Route::resource('artikel', ArtikelController::class)->names([
        'index'   => 'admin.artikel.index',
        'create'  => 'admin.artikel.create',
        'store'   => 'admin.artikel.store',
        'edit'    => 'admin.artikel.edit',
        'update'  => 'admin.artikel.update',
        'destroy' => 'admin.artikel.destroy',
    ]);

    // Rute Laporan Konsultasi
    Route::get('/laporan', [LaporanController::class, 'index'])->name('admin.laporan.index');
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('admin.laporan.cetak');

    // Rute Kelola Pengguna
    Route::resource('users', UserController::class)->names([
        'index'   => 'admin.users.index',
        'create'  => 'admin.users.create',
        'store'   => 'admin.users.store',
        'edit'    => 'admin.users.edit',
        'update'  => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
});

    // PAKAR
Route::middleware(['auth', 'role:pakar'])->prefix('pakar')->group(function () {
        Route::get('/dashboard', [PakarDashboardController::class, 'index'])->name('pakar.dashboard');
        Route::get('/riwayat', [PakarRiwayatController::class, 'index'])->name('pakar.riwayat.index');
        Route::get('/riwayat/{id}', [PakarRiwayatController::class, 'show'])->name('pakar.riwayat.detail');
        Route::delete('/riwayat/{id}', [PakarRiwayatController::class, 'destroy'])->name('pakar.riwayat.destroy');

    Route::resource('penyakit', PakarPenyakitController::class)->names([
            'index'   => 'pakar.penyakit.index',
            'create'  => 'pakar.penyakit.create',
            'store'   => 'pakar.penyakit.store',
            'edit'    => 'pakar.penyakit.edit',
            'update'  => 'pakar.penyakit.update',
            'destroy' => 'pakar.penyakit.destroy',
        ]);

    Route::resource('gejala', PakarGejalaController::class)->names([
        'index'   => 'pakar.gejala.index',
        'create'  => 'pakar.gejala.create',
        'store'   => 'pakar.gejala.store',
        'edit'    => 'pakar.gejala.edit',
        'update'  => 'pakar.gejala.update',
        'destroy' => 'pakar.gejala.destroy',
    ]);

     Route::resource('pengetahuan', PakarPengetahuanController::class)->names([
        'index'   => 'pakar.pengetahuan.index',
        'create'  => 'pakar.pengetahuan.create',
        'store'   => 'pakar.pengetahuan.store',
        'edit'    => 'pakar.pengetahuan.edit',
        'update'  => 'pakar.pengetahuan.update',
        'destroy' => 'pakar.pengetahuan.destroy',
    ]);

    Route::resource('bobot', BobotController::class)->names([
        'index'   => 'pakar.bobot.index',
        'create'  => 'pakar.bobot.create',
        'store'   => 'pakar.bobot.store',
        'edit'    => 'pakar.bobot.edit',
        'update'  => 'pakar.bobot.update',
        'destroy' => 'pakar.bobot.destroy',
    ]);
    
});

Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->group(function () {
    Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('petugas.dashboard');
    Route::get('/konsultasi-sapi', [ConsultationController::class, 'konsultasi'])->name('petugas.konsultasi');
    Route::get('/riwayat', [ConsultationController::class, 'riwayatSaya'])->name('petugas.riwayat');
    Route::get('/data-gejala-penyakit', [DataController::class, 'index'])->name('petugas.referensi');
});

Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/riwayat', [UserRiwayatController::class, 'index'])->name('user.riwayat.index');
    Route::get('/riwayat/{id}', [UserRiwayatController::class, 'show'])->name('user.riwayat.detail');
    Route::delete('/riwayat/{id}', [UserRiwayatController::class, 'destroy'])->name('user.riwayat.destroy');

    Route::get('/konsultasi-sapi', [ConsultationController::class, 'konsultasi'])->name('user.konsultasi');
    Route::get('/user/riwayat', [ConsultationController::class, 'riwayatSaya'])->name('riwayat.saya');
    Route::get('/informasi-penyakit', [ConsultationController::class, 'informasi'])->name('user.informasi');
    Route::get('/informasi/penyakit/{id}', [ConsultationController::class, 'detailPenyakitUser'])->name('informasi.penyakit.detail.user');
    Route::get('/riwayat/{id}', [UserRiwayatController::class, 'show'])->name('user.riwayat.detail');
});