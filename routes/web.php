<?php

use App\Http\Controllers\AdminPpdbController;
use App\Http\Controllers\ApplicantAuthController;
use App\Http\Controllers\PpdbController;
use Illuminate\Support\Facades\Route;

// PPDB Publik (standalone, tanpa web sekolah)
Route::get('/', [PpdbController::class, 'index'])->name('ppdb.home');
Route::get('/biaya', [PpdbController::class, 'biaya'])->name('ppdb.biaya');
Route::get('/beasiswa', [PpdbController::class, 'beasiswa'])->name('ppdb.beasiswa');
Route::get('/panduan', [PpdbController::class, 'panduan'])->name('ppdb.panduan');
Route::get('/sukses/{no}', [PpdbController::class, 'sukses'])
    ->middleware('throttle:60,1')->name('ppdb.sukses');
Route::get('/kartu/{no}', [PpdbController::class, 'kartu'])
    ->middleware('throttle:60,1')->name('ppdb.kartu');
Route::get('/kwitansi/{no}', [PpdbController::class, 'kwitansi'])
    ->middleware('throttle:60,1')->name('ppdb.kwitansi');
Route::get('/faq', [PpdbController::class, 'faq'])->name('ppdb.faq');
Route::get('/cek-status', [PpdbController::class, 'cekForm'])->name('ppdb.cek.form');
Route::post('/cek-status', [PpdbController::class, 'cek'])
    ->middleware('throttle:20,1')->name('ppdb.cek');

// Admin PPDB
Route::get('/admin/login', [AdminPpdbController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [AdminPpdbController::class, 'login'])
    ->middleware('throttle:5,1')->name('admin.login.post');

// Login Google (Socialite)
Route::get('/auth/google', [AdminPpdbController::class, 'redirectToGoogle'])->name('admin.google');
Route::get('/auth/google/callback', [AdminPpdbController::class, 'handleGoogleCallback'])->name('admin.google.callback');

Route::middleware(['auth', 'ppdb.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminPpdbController::class, 'dashboard'])->name('dashboard');
    Route::get('/pendaftar/{pendaftar}', [AdminPpdbController::class, 'show'])->name('show');
    Route::get('/pendaftar/{pendaftar}/edit', [AdminPpdbController::class, 'edit'])->name('edit');
    Route::put('/pendaftar/{pendaftar}', [AdminPpdbController::class, 'update'])->name('update');
    Route::patch('/pendaftar/{pendaftar}/status', [AdminPpdbController::class, 'updateStatus'])->name('status');
    Route::delete('/pendaftar/{pendaftar}', [AdminPpdbController::class, 'destroy'])->name('destroy');
    Route::get('/export-csv', [AdminPpdbController::class, 'export'])->name('export');
    Route::post('/logout', [AdminPpdbController::class, 'logout'])->name('logout');
});

// Auth pendaftar (Google)
Route::get('/masuk', [ApplicantAuthController::class, 'loginForm'])->name('ppdb.login');
Route::get('/auth/google/pendaftar', [ApplicantAuthController::class, 'redirectToGoogle'])->name('ppdb.auth.google');
Route::get('/auth/google/pendaftar/callback', [ApplicantAuthController::class, 'handleGoogleCallback'])->name('ppdb.auth.google.callback');
Route::post('/keluar', [ApplicantAuthController::class, 'logout'])->middleware('auth')->name('ppdb.logout');

// PPDB Publik — Multi-step form (wajib "Google" di awal; pura-pura/demo jika OAuth belum dikonfigurasi)
Route::middleware(['auth', 'ppdb.applicant'])->group(function () {
    Route::get('/daftar/submit', [PpdbController::class, 'daftarSubmitForm'])->name('ppdb.daftar.submit.form');
    Route::post('/daftar/submit', [PpdbController::class, 'daftarSubmit'])->name('ppdb.daftar.submit');
    Route::get('/daftar/{step?}', [PpdbController::class, 'daftarStep'])->where('step', '[1-4]')->name('ppdb.daftar');
    Route::post('/daftar/{step}', [PpdbController::class, 'daftarStoreStep'])->where('step', '[1-4]')->name('ppdb.daftar.step');
});


