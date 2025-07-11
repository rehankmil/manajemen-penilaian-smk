<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
    Authentication
*/
Route::get('/', [AuthController::class, 'index'])->name('login')->middleware('guest:admin,guru,murid');
Route::post('/login', [AuthController::class, 'verify'])->name('auth.verify');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/*
    Admin
*/
Route::group(['middleware'=>'auth:admin'], function()
{
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('guru', App\Http\Controllers\Admin\GuruController::class);
    Route::resource('murid', App\Http\Controllers\Admin\MuridController::class);
    Route::resource('mapel', App\Http\Controllers\Admin\MapelController::class);
    Route::resource('kelas', App\Http\Controllers\Admin\KelasController::class)->parameters([
        'kelas' => 'kelas'
    ]);
    Route::resource('nilai', App\Http\Controllers\Admin\NilaiController::class);
    Route::get('/get-guru-by-mapel', [App\Http\Controllers\Admin\NilaiController::class, 'getGuruByMapel'])->name('get.guru.by.mapel');
    Route::get('/get-murid-by-kelas', [App\Http\Controllers\Admin\NilaiController::class, 'getMuridByKelas'])->name('get.murid.by.kelas');
});

/*
Guru
*/
Route::group(['middleware'=>'auth:guru'], function()
{
    Route::get('/dashboard-g', [App\Http\Controllers\Guru\DashboardController::class, 'index'])->name('guru.dashboard');
    Route::get('/profil-g', [App\Http\Controllers\Guru\ProfilController::class, 'index'])->name('guru.profil');
    Route::get('/profil-g/ubah', [App\Http\Controllers\Guru\ProfilController::class, 'edit'])->name('guru.profil.ubah');
    Route::match(array('PUT', 'PATCH'), '/profil-g/update', [App\Http\Controllers\Guru\ProfilController::class, 'update'])->name('guru.profil.update');
    Route::get('/penilaian', [App\Http\Controllers\Guru\PenilaianController::class, 'index'])->name('guru.penilaian');
    Route::get('/penilaian/kelas/{kelasId}/murid', [App\Http\Controllers\Guru\PenilaianController::class, 'daftarMurid'])->name('guru.penilaian.daftar-murid');
    Route::get('/penilaian/{muridId}/form-nilai', [App\Http\Controllers\Guru\PenilaianController::class, 'formNilai'])->name('guru.penilaian.form-nilai');
    Route::post('/penilaian/store', [App\Http\Controllers\Guru\PenilaianController::class, 'store'])->name('guru.penilaian.store-nilai');
    Route::get('/penilaian/{muridId}/murid', [App\Http\Controllers\Guru\PenilaianController::class, 'daftarNilai'])->name('guru.penilaian.daftar-nilai');
    Route::get('/penilaian/{nilaiId}/edit', [App\Http\Controllers\Guru\PenilaianController::class, 'edit'])->name('guru.penilaian.edit-nilai');
    Route::put('/penilaian/{nilaiId}/update', [App\Http\Controllers\Guru\PenilaianController::class, 'update'])->name('guru.penilaian.update-nilai');
    Route::delete('/penilaian/{nilaiId}/destroy', [App\Http\Controllers\Guru\PenilaianController::class, 'destroy'])->name('guru.penilaian.destroy-nilai');
});

/*
Murid
*/
Route::group(['middleware'=>'auth:murid'], function()
{
    Route::get('/dashboard-m', [App\Http\Controllers\Murid\DashboardController::class, 'index'])->name('murid.dashboard');
    Route::get('/profil-m', [App\Http\Controllers\Murid\ProfilController::class, 'index'])->name('murid.profil');
    Route::get('/profil-m/ubah', [App\Http\Controllers\Murid\ProfilController::class, 'edit'])->name('murid.profil.ubah');
    Route::match(array('PUT', 'PATCH'), '/profil-m/update', [App\Http\Controllers\Murid\ProfilController::class, 'update'])->name('murid.profil.update');
    Route::get('/nilai-m', [App\Http\Controllers\Murid\NilaiController::class, 'index'])->name('murid.nilai');
    Route::get('/{siswa_id}/nilai/pdf', [App\Http\Controllers\Murid\NilaiController::class, 'generatePDF'])->name('murid.nilai.pdf');
});