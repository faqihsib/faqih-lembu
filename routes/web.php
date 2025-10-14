<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/pcr', function () {
    return 'Selamat Datang di Website Kampus PCR!'; //basic route
});

Route::get('/mahasiswa', function () {
    return 'Halo Mahasiswa';  //basic route
})->name('mahasiswa.show');   //-> named route

Route::get('/nama/{param1}', function ($param1) {  //route parameter harus berisi
    return 'Nama saya: '.$param1;
});

Route::get('/nim/{param1?}', function ($param1 = '') {  //route parameter default (bisa kosong)
    return 'saya: '.$param1;
});

Route::get('/mahasiswa/{param1}', [MahasiswaController::class,'show']);  //route ke mahasiswa controller

Route::get('/about', function () {
    return view('home');
});

Route::get('/matakuliah/{param1}/{param2?}', [MatakuliahController::class,'index']);

Route::get('/home', [HomeController::class,'index'])->name('home');


Route::get('/pegawai', [PegawaiController::class, 'index']);

Route::post('question/store', [QuestionController::class, 'store'])
	->name('question.store');

Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');


//route pelanggan
Route::resource('pelanggan', PelangganController::class);
