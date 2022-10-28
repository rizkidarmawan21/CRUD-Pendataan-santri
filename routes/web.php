<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\DataSantriController;
use App\Http\Controllers\DetailSantriController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PerizinanController;

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
    return view('auth.login');
})->middleware('guest');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::middleware(['administrator'])->group(function () {
    Route::resource('users', UserController::class)
        ->middleware(['auth', 'administrator']);

    Route::resource('gedung', GedungController::class)
        ->middleware('auth');
});

Route::get('/exportexcel', [DataSantriController::class, 'exportexcel'])->name('exportexcel');
Route::get('/import', function () {
    return view('data.import');
});


Route::post('import', [DataSantriController::class, 'import'])->name('import');
Route::get('download', [DataSantriController::class, 'download'])->name('download');
Route::resource('datasantri', DataSantriController::class)
    ->middleware('auth');



Route::post('detail-santri', [DetailSantriController::class, 'store'])->middleware('auth')->name('detail.santri');
Route::post('detail-santri/{id}', [DetailSantriController::class, 'destroy'])->middleware('auth')->name('detail.santri.delete');

Route::get('kamar/santri/{detailsantri}/edit', [DetailSantriController::class, 'edit'])->middleware('auth')->name('detail.santri.edit');
Route::put('kamar/santri/{detailsantri}/update', [DetailSantriController::class, 'update'])->middleware('auth')->name('detail.santri.update');
Route::get('kamar/santri', [KamarController::class, 'kamarSantri'])->middleware('auth')->name('kamar.santri');
Route::resource('kamar', KamarController::class)->middleware(['auth','administrator']);

Route::post('perizinan/{perizinan}/verify', [PerizinanController::class, 'verify'])->middleware(['auth', 'adminPerizinan'])->name('perizinan.verify');
Route::post('perizinan/{perizinan}/back', [PerizinanController::class, 'back'])->middleware('auth')->name('perizinan.back');
Route::get('perizinan/{id}/surekom', [PerizinanController::class, 'suratPengantar'])->middleware('auth')->name('perizinan.surekom');
Route::get('perizinan/{id}/suizin', [PerizinanController::class, 'suratIzin'])->middleware(['auth', 'adminPerizinan'])->name('perizinan.suizin');
Route::resource('perizinan', PerizinanController::class)->middleware('auth');


// Error handling page
Route::get('error/403', function () {
    return view('error.403');
})->name('error-403');

Auth::routes();
