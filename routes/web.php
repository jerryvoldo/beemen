<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

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
Route::post('/form/storesbb', [FormController::class, 'storesbb'])->middleware(['auth'])->name('form.storesbb');

require __DIR__.'/auth.php';
