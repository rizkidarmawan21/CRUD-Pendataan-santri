<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\DataSantriController;
use App\Http\Controllers\KamarController;

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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::resource('users', UserController::class)
    ->middleware('auth');

Route::get('/exportexcel', [DataSantriController::class, 'exportexcel'])->name('exportexcel');
Route::get('/import', function () {
    return view('data.import');
});

Route::post('import', [DataSantriController::class, 'import'])->name('import');
Route::get('download', [DataSantriController::class, 'download'])->name('download');
Route::resource('datasantri', DataSantriController::class)
    ->middleware('auth');

Route::resource('gedung', GedungController::class)
    ->middleware('auth');
Route::get('kamar/santri',[KamarController::class,'kamarSantri'])->middleware('auth')->name('kamar.santri');
Route::resource('kamar', KamarController::class)->middleware('auth');
