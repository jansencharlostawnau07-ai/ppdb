<?php

use App\Http\Controllers\AdminPpdbController;
use App\Http\Controllers\PpdbController;
use Illuminate\Support\Facades\Route;

// PPDB Publik (standalone, tanpa web sekolah)
Route::get('/', [PpdbController::class, 'index'])->name('ppdb.home');
Route::get('/biaya', [PpdbController::class, 'biaya'])->name('ppdb.biaya');
Route::get('/beasiswa', [PpdbController::class, 'beasiswa'])->name('ppdb.beasiswa');
Route::get('/panduan', [PpdbController::class, 'panduan'])->name('ppdb.panduan');
Route::get('/daftar', [PpdbController::class, 'create'])->name('ppdb.daftar');
Route::post('/daftar', [PpdbController::class, 'store'])
    ->middleware('throttle:10,1')->name('ppdb.store');
Route::get('/sukses/{no}', [PpdbController::class, 'sukses'])->name('ppdb.sukses');
Route::get('/kartu/{no}', [PpdbController::class, 'kartu'])->name('ppdb.kartu');
Route::get('/faq', [PpdbController::class, 'faq'])->name('ppdb.faq');
Route::get('/cek-status', [PpdbController::class, 'cekForm'])->name('ppdb.cek.form');
Route::post('/cek-status', [PpdbController::class, 'cek'])
    ->middleware('throttle:20,1')->name('ppdb.cek');

// Admin PPDB
Route::get('/admin/login', [AdminPpdbController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [AdminPpdbController::class, 'login'])
    ->middleware('throttle:5,1')->name('admin.login.post');

Route::middleware(['auth', 'ppdb.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminPpdbController::class, 'dashboard'])->name('dashboard');
    Route::get('/pendaftar/{pendaftar}', [AdminPpdbController::class, 'show'])->name('show');
    Route::patch('/pendaftar/{pendaftar}/status', [AdminPpdbController::class, 'updateStatus'])->name('status');
    Route::delete('/pendaftar/{pendaftar}', [AdminPpdbController::class, 'destroy'])->name('destroy');
    Route::get('/export-csv', [AdminPpdbController::class, 'export'])->name('export');
    Route::post('/logout', [AdminPpdbController::class, 'logout'])->name('logout');
});
