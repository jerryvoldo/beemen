<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\DaftarController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/form', [FormController::class, 'index'])->middleware(['auth'])->name('form');
Route::get('/form/spb', [FormController::class, 'viewspb'])->middleware(['auth'])->name('form.spb');
Route::get('/form/sbbk', [FormController::class, 'viewsbbk'])->middleware(['auth'])->name('form.sbbk');
Route::get('/daftar/ajus', [DaftarController::class, 'viewajus'])->middleware(['auth'])->name('daftar.ajus');
Route::get('/daftar/stok', [DaftarController::class, 'viewstok'])->middleware(['auth'])->name('daftar.stok');
Route::get('/daftar/ajus/{nomor_spb}', [DaftarController::class, 'show'])->middleware(['auth'])->name('daftar.ajus.spb');
Route::get('/daftar/ajus/realisasi/{nomor_spb}', [DaftarController::class, 'realisasispb'])->middleware(['auth'])->name('daftar.ajus.realisasi');
Route::get('/daftar/ajus/sbbk/view/{nomor_spb}', [DaftarController::class, 'viewsbbk'])->middleware(['auth'])->name('daftar.ajus.sbbk.view');


Route::post('/form/storesbb', [FormController::class, 'storesbb'])->middleware(['auth'])->name('form.storesbb');
Route::post('/form/storeallsbb', [FormController::class, 'storeallsbb'])->middleware(['auth'])->name('form.storeallsbb');
Route::post('/form/spb/delete', [FormController::class, 'deleteItem'])->middleware(['auth'])->name('form.deleteItem');
Route::post('/daftar/ajus/approval', [DaftarController::class, 'updateSpbIsApproved'])->middleware(['auth'])->name('daftar.ajus.approval');
Route::post('/daftar/ajus/realisasi', [DaftarController::class, 'storerealisasispb'])->middleware(['auth'])->name('daftar.ajus.realisasi.store');
Route::post('/daftar/ajus/sbbk', [DaftarController::class, 'buatsbbk'])->middleware(['auth'])->name('daftar.ajus.sbbk.buatsbbk');


require __DIR__.'/auth.php';
